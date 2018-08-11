"""Integration with Flask-Script::

    from flask_alembic import alembic_script
    manager.add_command('db', alembic_script)

\\
"""

from flask_script import Manager
from flask_alembic.cli import base

manager = Manager(help='Perform database migrations.', description='Perform database migrations.')


@manager.command
def mkdir():
    """Make migration directory."""

    base.mkdir()


@manager.option('-v', '--verbose', action='store_true')
def current(verbose):
    """Show current revisions."""

    base.current(verbose)


@manager.command
@manager.option('--resolve-dependencies', action='store_true', help='Treat dependencies as down revisions.')
@manager.option('-v', '--verbose', action='store_true')
def heads(resolve_dependencies, verbose):
    """Show latest revisions."""

    base.heads(resolve_dependencies, verbose)


@manager.command
@manager.option('-v', '--verbose', action='count', help='Specify up to three times for extra output.')
def branches(verbose):
    """Show branch points."""

    base.branches(verbose)


@manager.option('--start', default='base', help='Show since this revision.')
@manager.option('--end', default='heads', help='Show until this revision.')
@manager.option('-v', '--verbose', action='store_true')
def log(start, end, verbose):
    """Show revision log."""

    base.log(start, end, verbose)


@manager.option('revisions', nargs='+')
def show(revisions):
    """Show the given revisions."""

    base.show(revisions)


@manager.option('target', nargs='?', default='heads')
def stamp(target):
    """Set current revision."""

    base.stamp(target)


@manager.option('target', nargs='?', default='heads')
def upgrade(target):
    """Run upgrade migrations."""

    base.upgrade(target)


@manager.option('target', nargs='?', default='1')
def downgrade(target):
    """Run downgrade migrations."""

    base.downgrade(target)


@manager.option('message')
@manager.option('--empty', action='store_true', help='Create empty script.')
@manager.option('-b', '--branch', default='default', help='Use this independent branch name.')
@manager.option('-p', '--parent', default='head', type=str.split, help='Parent revision(s) of this revision.')
@manager.option('--splice', action='store_true', help='Allow non-head parent revision.')
@manager.option('-d', '--depend', type=str.split, help='Revision(s) this revision depends on.')
@manager.option('-l', '--label', type=str.split, help='Label(s) to apply to the revision.')
@manager.option('--path', help='Where to store the revision.')
def revision(message, empty, branch, parent, splice, depend, label, path):
    """Create new migration."""

    base.revision(message, empty, branch, parent, splice, depend, label, path)


@manager.option('revisions', nargs='*')
@manager.option('-m', '--message')
@manager.option('-l', '--label', type=str.split, help='Label(s) to apply to the revision.')
def merge(revisions, message, label):
    """Create merge revision."""

    base.merge(revisions, message, label)
