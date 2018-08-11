"""
flask_alembic
-------------

.. autoclass:: flask_alembic.Alembic
    :members:
    :member-order: bysource

.. automodule:: flask_alembic.cli
    :members:
"""

from flask_alembic.extension import Alembic

try:
    from flask_alembic.cli.click import cli as alembic_click
except ImportError:
    alembic_click = None

try:
    from flask_alembic.cli.script import manager as alembic_script
except ImportError:
    alembic_script = None
