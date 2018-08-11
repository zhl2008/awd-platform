"""Base functions that write information to the terminal."""

from flask import current_app


def get_alembic():
    """Get the alembic extension for the current app."""

    return current_app.extensions['alembic']


def mkdir():
    """Create the migration directory if it does not exist."""

    get_alembic().mkdir()


def current(verbose=False):
    """Show the list of current revisions."""

    a = get_alembic()
    print_stdout = a.config.print_stdout

    for r in a.current():
        if r is None:
            print_stdout(None)
        else:
            print_stdout(r.cmd_format(verbose, include_branches=True, include_doc=True, include_parents=True, tree_indicators=True))


def heads(resolve_dependencies=False, verbose=False):
    """Show the list of revisions that have no child revisions."""

    a = get_alembic()
    print_stdout = a.config.print_stdout

    for r in a.heads(resolve_dependencies):
        print_stdout(r.cmd_format(verbose, include_branches=True, include_doc=True, include_parents=True, tree_indicators=True))


def branches(verbose=False):
    """Show the list of revisions that have more than one next revision."""

    a = get_alembic()
    print_stdout = a.config.print_stdout
    get_revision = a.script_directory.get_revision

    for r in a.branches():
        print_stdout(r.cmd_format(verbose, include_branches=True, include_doc=True, include_parents=True, tree_indicators=True))

        for nr in r.nextrev:
            nr = get_revision(nr)
            print_stdout('    -> {0}'.format(nr.cmd_format(False, include_branches=True, include_doc=True, include_parents=True, tree_indicators=True)))


def log(start='base', end='heads', verbose=False):
    """Show the list of revisions in the order they will run."""

    a = get_alembic()
    print_stdout = a.config.print_stdout

    for r in a.log(start, end):
        print_stdout(r.cmd_format(verbose, include_branches=True, include_doc=True, include_parents=True, tree_indicators=True))


def show(revisions):
    """Show the given revisions."""

    a = get_alembic()
    print_stdout = a.config.print_stdout

    for r in a.script_directory.get_revisions(revisions):
        print_stdout(r.cmd_format(True))


def stamp(target='heads'):
    """Set the current revision without running migrations."""

    get_alembic().stamp(target)


def upgrade(target='heads'):
    """Run migrations to upgrade the database."""

    get_alembic().upgrade(target)


def downgrade(target=-1):
    """Run migration to downgrade the database."""

    get_alembic().downgrade(target)


def revision(message, empty=False, branch='default', parent='head', splice=False, depend=None, label=None, path=None):
    """Generate a new revision."""

    get_alembic().revision(message, empty, branch, parent, splice, depend, label, path)


def merge(revisions, message=None, label=None):
    """Generate a merge revision."""

    get_alembic().merge(revisions, message, label)
