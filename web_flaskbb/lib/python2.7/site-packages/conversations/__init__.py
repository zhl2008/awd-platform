# -*- coding: utf-8 -*-
"""
    conversations
    ~~~~~~~~~~~~~

    A conversations Plugin for FlaskBB.

    :copyright: (c) 2018 by Peter Justin.
    :license: BSD License, see LICENSE for more details.
"""
import os

from flask_login import current_user
from pluggy import HookimplMarker

from flaskbb.utils.helpers import real, render_template

from .utils import get_latest_messages, get_unread_count
from .views import conversations_bp


__version__ = "1.0.2"


hookimpl = HookimplMarker("flaskbb")


# connect the hooks
def flaskbb_load_migrations():
    return os.path.join(os.path.dirname(__file__), "migrations")


def flaskbb_load_translations():
    return os.path.join(os.path.dirname(__file__), "translations")


def flaskbb_load_blueprints(app):
    app.register_blueprint(conversations_bp, url_prefix="/conversations")


def flaskbb_tpl_user_nav_loggedin_before():
    return render_template(
        "_inject_navlink.html",
        unread_messages=get_latest_messages(real(current_user)),
        unread_count=get_unread_count(real(current_user))
    )


@hookimpl(trylast=True)
def flaskbb_tpl_profile_sidebar_stats(user):
    return render_template(
        "_inject_new_message_button.html",
        user=user
    )


@hookimpl(trylast=True)
def flaskbb_tpl_post_author_info_after(user, post):
    return render_template(
        "_inject_new_message_link.html",
        user=user,
        post=post
    )
