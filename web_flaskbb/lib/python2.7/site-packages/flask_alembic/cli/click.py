"""Integration with Click::

    from flask_alembic import alembic_click
    app.cli.add_command(alembic_click, 'db')

This is done automatically by Flask-Alembic if it detects ``app.cli``.

\\
"""

from __future__ import absolute_import
import click
from flask_alembic.cli import base

try:
    from flask.cli import AppGroup
except ImportError:
    from flask_cli import AppGroup


@click.command(cls=AppGroup)
def cli():
    """Perform database migrations."""

    pass


@cli.command()
def mkdir():
    """Make migration directory."""

    base.mkdir()


@cli.command()
@click.option('-v', '--verbose', is_flag=True)
def current(verbose):
    """Show current revision."""

    base.current(verbose)


@cli.command()
@click.option('--resolve-dependencies', is_flag=True, help='Treat dependencies as down revisions.')
@click.option('-v', '--verbose', is_flag=True)
def heads(resolve_dependencies, verbose):
    """Show latest revisions."""

    base.heads(resolve_dependencies, verbose)


@cli.command()
@click.option('-v', '--verbose', is_flag=True)
def branches(verbose):
    """Show branch points."""

    base.branches(verbose)


@cli.command()
@click.option('--start', default='base', help='Show since this revision.')
@click.option('--end', default='heads', help='Show until this revision.')
@click.option('-v', '--verbose', is_flag=True)
def log(start, end, verbose):
    """Show revision log."""

    base.log(start, end, verbose)


@cli.command()
@click.argument('revisions', nargs=-1)
def show(revisions):
    """Show the given revisions."""

    base.show(revisions)


@cli.command()
@click.argument('target', default='heads')
def stamp(target):
    """Set current revision."""

    base.stamp(target)


@cli.command()
@click.argument('target', default='heads')
def upgrade(target):
    """Run upgrade migrations."""

    base.upgrade(target)


@cli.command()
@click.argument('target', default='1')
def downgrade(target):
    """Run downgrade migrations."""

    base.downgrade(target)


@cli.command()
@click.argument('message')
@click.option('--empty', is_flag=True, help='Create empty script.')
@click.option('-b', '--branch', default='default', help='Use this independent branch name.')
@click.option('-p', '--parent', multiple=True, default=['head'], help='Parent revision(s) of this revision.')
@click.option('--splice', is_flag=True, help='Allow non-head parent revision.')
@click.option('-d', '--depend', multiple=True, help='Revision(s) this revision depends on.')
@click.option('-l', '--label', multiple=True, help='Label(s) to apply to the revision.')
@click.option('--path', help='Where to store the revision.')
def revision(message, empty, branch, parent, splice, depend, label, path):
    """Create new migration."""

    base.revision(message, empty, branch, parent, splice, depend, label, path)


@cli.command()
@click.argument('revisions', nargs=-1)
@click.option('-m', '--message')
@click.option('-l', '--label', multiple=True, help='Label(s) to apply to the revision.')
def merge(revisions, message, label):
    """Create merge revision."""

    base.merge(revisions, message, label)
