import logging
import os
import shutil
import sys

from alembic import util, autogenerate
from alembic.config import Config
from alembic.operations import Operations
from alembic.runtime.environment import EnvironmentContext
from alembic.script import ScriptDirectory
from alembic.script.revision import ResolutionError
from flask import current_app

from flask_alembic._compat import string_types, logger_has_handlers


class Alembic(object):
    """Provide an Alembic environment and migration API.

    If instantiated without an app instance, :meth:`init_app` is used to register an app at a later time.

    Configures basic logging to ``stderr`` for the ``sqlalchemy`` and
    ``alembic`` loggers if they do not already have handlers.

    :param app: call ``init_app`` on this app
    :param run_mkdir: whether to run :meth:`mkdir` during ``init_app``
    :param command_name: register a Click command with this name during ``init_app``, or skip if ``False``
    """

    def __init__(self, app=None, run_mkdir=True, command_name='db'):
        self._cache = {}
        self.run_mkdir = run_mkdir
        self.command_name = command_name

        # add logging handler if not configured
        console_handler = logging.StreamHandler(sys.stderr)
        console_handler.formatter = logging.Formatter(
            fmt='%(levelname)-5.5s [%(name)s] %(message)s',
            datefmt='%H:%M:%S'
        )

        sqlalchemy_logger = logging.getLogger('sqlalchemy')
        alembic_logger = logging.getLogger('alembic')

        if not logger_has_handlers(sqlalchemy_logger):
            sqlalchemy_logger.setLevel(logging.WARNING)
            sqlalchemy_logger.addHandler(console_handler)

        # alembic adds a null handler, remove it
        if len(alembic_logger.handlers) == 1 and isinstance(alembic_logger.handlers[0], logging.NullHandler):
            alembic_logger.removeHandler(alembic_logger.handlers[0])

        if not logger_has_handlers(alembic_logger):
            alembic_logger.setLevel(logging.INFO)
            alembic_logger.addHandler(console_handler)

        if app is not None:
            self.init_app(app, run_mkdir)

    def init_app(self, app, run_mkdir=None, command_name=None):
        """Register this extension on an app.  Will automatically set up migration directory by default.

        Keyword arguments on this method override those set during :meth:`__init__` if not ``None``.

        :param app: app to register
        :param run_mkdir: whether to run :meth:`mkdir`
        :param command_name: register a Click command with this name, or skip if ``False``
        """

        app.extensions['alembic'] = self

        config = app.config.setdefault('ALEMBIC', {})
        config.setdefault('script_location', 'migrations')
        config.setdefault('version_locations', [])
        app.config.setdefault('ALEMBIC_CONTEXT', {})

        self._cache[app] = {}

        app.teardown_appcontext(self._clear_cache)

        if run_mkdir or (run_mkdir is None and self.run_mkdir):
            with app.app_context():
                self.mkdir()

        if (command_name or (command_name is None and self.command_name)) and hasattr(app, 'cli'):
            from flask_alembic import alembic_click
            app.cli.add_command(alembic_click, command_name or self.command_name)

    def _clear_cache(self, exc=None):
        """Clear the cached objects for the given app.

        This is called automatically during app context teardown.

        :param exc: exception from teardown handler
        """

        cache = self._get_cache()

        if 'context' in cache:
            cache['context'].connection.close()

        cache.clear()

    def _get_cache(self):
        """Get the cache for the current app."""

        return self._cache[current_app._get_current_object()]

    def rev_id(self):
        """Generate a unique id for a revision.

        By default this uses :func:`alembic.util.rev_id`.
        Override this method, or assign a static method, to change this.

        For example, to use the current timestamp::

            alembic = Alembic(app)
            alembic.rev_id = lambda: datetime.utcnow().timestamp()
        """

        return util.rev_id()

    @property
    def config(self):
        """Get the Alembic :class:`~alembic.config.Config` for the current app."""

        cache = self._get_cache()

        if 'config' not in cache:
            cache['config'] = c = Config()

            script_location = current_app.config['ALEMBIC']['script_location']

            if not os.path.isabs(script_location) and ':' not in script_location:
                script_location = os.path.join(current_app.root_path, script_location)

            version_locations = [script_location]

            for item in current_app.config['ALEMBIC']['version_locations']:
                version_location = item if isinstance(item, string_types) else item[1]

                if not os.path.isabs(version_location) and ':' not in version_location:
                    version_location = os.path.join(current_app.root_path, version_location)

                version_locations.append(version_location)

            c.set_main_option('script_location', script_location)
            c.set_main_option('version_locations', ','.join(version_locations))

            for key, value in current_app.config['ALEMBIC'].items():
                if key in ('script_location', 'version_locations'):
                    continue

                c.set_main_option(key, value)

        return cache['config']

    @property
    def script_directory(self):
        """Get the Alembic :class:`~alembic.script.ScriptDirectory` for the current app."""

        cache = self._get_cache()

        if 'script' not in cache:
            cache['script'] = ScriptDirectory.from_config(self.config)

        return cache['script']

    @property
    def environment_context(self):
        """Get the Alembic :class:`~alembic.runtime.environment.EnvironmentContext` for the current app."""

        cache = self._get_cache()

        if 'env' not in cache:
            cache['env'] = EnvironmentContext(self.config, self.script_directory)

        return cache['env']

    @property
    def migration_context(self):
        """Get the Alembic :class:`~alembic.runtime.migration.MigrationContext` for the current app.

        Accessing this property opens a database connection but can't close it automatically.
        Make sure to call ``migration_context.connection.close()`` when you're done.
        """

        cache = self._get_cache()

        if 'context' not in cache:
            db = current_app.extensions['sqlalchemy'].db
            env = self.environment_context
            conn = db.engine.connect()
            env.configure(
                connection=conn, target_metadata=db.metadata,
                **current_app.config['ALEMBIC_CONTEXT']
            )
            cache['context'] = env.get_context()

        return cache['context']

    @property
    def op(self):
        """Get the Alembic :class:`~alembic.operations.Operations` context for the current app.

        Accessing this property opens a database connection but can't close it automatically.
        Make sure to call ``migration_context.connection.close()`` when you're done.
        """

        cache = self._get_cache()

        if 'op' not in cache:
            cache['op'] = Operations(self.migration_context)

        return cache['op']

    def run_migrations(self, fn, **kwargs):
        """Configure an Alembic :class:`~alembic.runtime.migration.MigrationContext` to run migrations for the given function.

        This takes the place of Alembic's env.py file, specifically the ``run_migrations_online`` function.

        :param fn: use this function to control what migrations are run
        :param kwargs: extra arguments passed to ``upgrade`` or ``downgrade`` in each revision
        """

        db = current_app.extensions['sqlalchemy'].db
        env = self.environment_context

        with db.engine.connect() as connection:
            env.configure(
                connection=connection, target_metadata=db.metadata, fn=fn,
                **current_app.config['ALEMBIC_CONTEXT']
            )

            with env.begin_transaction():
                env.run_migrations(**kwargs)

    def mkdir(self):
        """Create the script directory and template."""

        script_dir = self.config.get_main_option('script_location')
        template_src = os.path.join(self.config.get_template_directory(), 'generic', 'script.py.mako')
        template_dest = os.path.join(script_dir, 'script.py.mako')

        if not os.access(template_src, os.F_OK):
            raise util.CommandError('Template {0} does not exist'.format(template_src))

        if not os.access(script_dir, os.F_OK):
            os.makedirs(script_dir)

        if not os.access(template_dest, os.F_OK):
            shutil.copy(template_src, template_dest)

        for version_location in self.script_directory._version_locations:
            if not os.access(version_location, os.F_OK):
                os.makedirs(version_location)

    def current(self):
        """Get the list of current revisions."""

        return self.script_directory.get_revisions(self.migration_context.get_current_heads())

    def heads(self, resolve_dependencies=False):
        """Get the list of revisions that have no child revisions.

        :param resolve_dependencies: treat dependencies as down revisions
        """

        if resolve_dependencies:
            return self.script_directory.get_revisions('heads')

        return self.script_directory.get_revisions(self.script_directory.get_heads())

    def branches(self):
        """Get the list of revisions that have more than one next revision."""

        return [revision for revision in self.script_directory.walk_revisions() if revision.is_branch_point]

    def log(self, start='base', end='heads'):
        """Get the list of revisions in the order they will run.

        :param start: only get since this revision
        :param end: only get until this revision
        """

        if start is None:
            start = 'base'
        elif start == 'current':
            start = [r.revision for r in self.current()]
        else:
            start = getattr(start, 'revision', start)

        if end is None:
            end = 'heads'
        elif end == 'current':
            end = [r.revision for r in self.current()]
        else:
            end = getattr(end, 'revision', end)

        return list(self.script_directory.walk_revisions(start, end))

    def stamp(self, target='heads'):
        """Set the current database revision without running migrations.

        :param target: revision to set to, default 'heads'
        """

        target = 'heads' if target is None else getattr(target, 'revision', target)

        def do_stamp(revision, context):
            return self.script_directory._stamp_revs(target, revision)

        self.run_migrations(do_stamp)

    def upgrade(self, target='heads'):
        """Run migrations to upgrade database.

        :param target: revision to go to, default 'heads'
        """

        target = 'heads' if target is None else getattr(target, 'revision', target)
        target = str(target)

        def do_upgrade(revision, context):
            return self.script_directory._upgrade_revs(target, revision)

        self.run_migrations(do_upgrade)

    def downgrade(self, target=-1):
        """Run migrations to downgrade database.

        :param target: revision to go down to, default -1
        """

        try:
            target = int(target)
        except ValueError:
            target = getattr(target, 'revision', target)
        else:
            if target > 0:
                target = -target

        target = str(target)

        def do_downgrade(revision, context):
            return self.script_directory._downgrade_revs(target, revision)

        self.run_migrations(do_downgrade)

    def revision(self, message, empty=False, branch='default', parent='head', splice=False, depend=None, label=None, path=None):
        """Create a new revision.  By default, auto-generate operations by comparing models and database.

        :param message: description of revision
        :param empty: don't auto-generate operations
        :param branch: use this independent branch name
        :param parent: parent revision(s) of this revision
        :param splice: allow non-head parent revision
        :param depend: revision(s) this revision depends on
        :param label: label(s) to apply to this revision
        :param path: where to store this revision
        :return: list of new revisions
        """

        if parent is None:
            parent = ['head']
        elif isinstance(parent, string_types):
            parent = [parent]
        else:
            parent = [getattr(r, 'revision', r) for r in parent]

        if label is None:
            label = []
        elif isinstance(label, string_types):
            label = [label]
        else:
            label = list(label)

        # manage independent branches
        if branch:
            for i, item in enumerate(parent):
                if item in ('base', 'head'):
                    parent[i] = '{}@{}'.format(branch, item)

            if not path:
                branch_path = dict(item for item in current_app.config['ALEMBIC']['version_locations'] if not isinstance(item, string_types)).get(branch)

                if branch_path:
                    path = branch_path

            try:
                branch_exists = any(r for r in self.script_directory.revision_map.get_revisions(branch) if r is not None)
            except ResolutionError:
                branch_exists = False

            if not branch_exists:
                # label the first revision of a separate branch and start it from base
                label.insert(0, branch)
                parent = ['base']

        if not path:
            path = self.script_directory.dir

        # relative path is relative to app root
        if path and not os.path.isabs(path) and ':' not in path:
            path = os.path.join(current_app.root_path, path)

        revision_context = autogenerate.RevisionContext(
            self.config, self.script_directory, {
                'message': message,
                'sql': False,
                'head': parent,
                'splice': splice,
                'branch_label': label,
                'version_path': path,
                'rev_id': self.rev_id(),
                'depends_on': depend
            }
        )

        def do_revision(revision, context):
            if empty:
                revision_context.run_no_autogenerate(revision, context)
            else:
                revision_context.run_autogenerate(revision, context)

            return []

        if not empty or util.asbool(self.config.get_main_option('revision_environment')):
            self.run_migrations(do_revision)

        return list(revision_context.generate_scripts())

    def merge(self, revisions='heads', message=None, label=None):
        """Create a merge revision.

        :param revisions: revisions to merge
        :param message: description of merge, will default to revisions param
        :param label: label(s) to apply to this revision
        :return: new revision
        """

        if not revisions:
            revisions = ['heads']
        elif isinstance(revisions, string_types):
            revisions = [revisions]
        else:
            revisions = [getattr(r, 'revision', r) for r in revisions]

        if message is None:
            message = 'merge {0}'.format(', '.join(revisions))

        if isinstance(label, string_types):
            label = [label]

        return self.script_directory.generate_revision(
            revid=self.rev_id(),
            message=message,
            head=revisions,
            branch_labels=label,
            config=self.config
        )

    def produce_migrations(self):
        """Generate the :class:`~alembic.autogenerate.MigrationScript` object that would generate a new revision."""

        db = current_app.extensions['sqlalchemy'].db
        return autogenerate.produce_migrations(self.migration_context, db.metadata)

    def compare_metadata(self):
        """Generate a list of operations that would be present in a new revision."""

        db = current_app.extensions['sqlalchemy'].db
        return autogenerate.compare_metadata(self.migration_context, db.metadata)
