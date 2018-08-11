# -*- coding: utf-8 -*-
"""
Flask-Themes2
=============

This provides infrastructure for theming support in your Flask applications.
It takes care of:

- Loading themes
- Rendering their templates
- Serving their static media
- Letting themes reference their templates and static media

:copyright: 2013 Christopher Carter, 2012 Drew Lustro,
            2010 Matthew "LeafStorm" Frazier
:license:   MIT/X11, see LICENSE for details
"""
from __future__ import with_statement

## Yarg, here be pirates!
from operator import attrgetter
import itertools
import os
import re

from flask import (send_from_directory, render_template, json,
                   abort, url_for, Blueprint)
# Support >= Flask 0.9
try:
    from flask import _app_ctx_stack as stack
except ImportError:
    from flask import _request_ctx_stack as stack

from jinja2 import contextfunction
from jinja2.loaders import FileSystemLoader, BaseLoader, TemplateNotFound
from werkzeug import cached_property

from ._compat import text_type, iteritems, itervalues


__version__ = '0.1.4'


DOCTYPES = 'html4 html5 xhtml'.split()
IDENTIFIER = re.compile(r'^[a-zA-Z_][a-zA-Z0-9_]*$')

containable = lambda i: i if hasattr(i, '__contains__') else tuple(i)


def starchain(i):
    return itertools.chain(*i)


def active_theme(ctx):
    if '_theme' in ctx:
        return ctx['_theme']
    elif ctx.name.startswith('_themes/'):
        return ctx.name[8:].split('/', 1)[0]
    else:
        raise RuntimeError("Could not find the active theme")


@contextfunction
def global_theme_template(ctx, templatename, fallback=True):
    theme = active_theme(ctx)
    templatepath = '_themes/{}/{}'.format(theme, templatename)
    if (not fallback) or template_exists(templatepath):
        return templatepath
    else:
        return templatename


@contextfunction
def global_theme_static(ctx, filename, external=False):
    theme = active_theme(ctx)
    return static_file_url(theme, filename, external)


@contextfunction
def global_theme_get_info(ctx, attribute_name, fallback=''):
    theme = get_theme(active_theme(ctx))
    try:
        info = getattr(theme, attribute_name)
        if info is None:
            raise AttributeError("Got None for getattr(theme, '{0}')".
                                 format(attribute_name))
        return info
    except AttributeError:
        pass
    return theme.options.get(attribute_name, fallback)


def static_file_url(theme, filename, external=False):
    """
    This is a shortcut for getting the URL of a static file in a theme.

    :param theme: A `Theme` instance or identifier.
    :param filename: The name of the file.
    :param external: Whether the link should be external or not. Defaults to
                     `False`.
    """
    from flask import current_app as app

    if isinstance(theme, Theme):
        theme = theme.identifier

    theme_obj = get_theme(theme)

    if app.theme_manager.static_folder:
        return url_for('_themes.static', filename=theme + '/' + filename,
                       _external=external)
    else:
        return url_for('_themes.static', themeid=theme, filename=filename,
                       _external=external)


def render_theme_template(theme, template_name, _fallback=True, **context):
    """
    This renders a template from the given theme. For example::

        return render_theme_template(g.user.theme, 'index.html', posts=posts)

    If `_fallback` is True and the template does not exist within the theme,
    it will fall back on trying to render the template using the application's
    normal templates. (The "active theme" will still be set, though, so you
    can try to extend or include other templates from the theme.)

    :param theme: Either the identifier of the theme to use, or an actual
                  `Theme` instance.
    :param template_name: The name of the template to render.
    :param _fallback: Whether to fall back to the default
    """
    if isinstance(theme, Theme):
        theme = theme.identifier
    context['_theme'] = theme
    try:
        return render_template('_themes/%s/%s' % (theme, template_name),
                               **context)
    except TemplateNotFound:
        if _fallback:
            return render_template(template_name, **context)
        else:
            raise

### convenience #########################################################


def get_theme(ident):
    """
    This gets the theme with the given identifier from the current app's
    theme manager.

    :param ident: The theme identifier.
    """
    ctx = stack.top
    return ctx.app.theme_manager.themes[ident]


def get_themes_list():
    """
    This returns a list of all the themes in the current app's theme manager,
    sorted by identifier.
    """
    ctx = stack.top
    return list(ctx.app.theme_manager.list_themes())


def static(themeid, filename):
    try:
        ctx = stack.top
        theme = ctx.app.theme_manager.themes[themeid]
    except KeyError:
        abort(404)
    return send_from_directory(theme.static_path, filename)


def template_exists(templatename):
    ctx = stack.top
    return templatename in containable(ctx.app.jinja_env.list_templates())

### loaders #############################################################


def list_folders(path):
    """
    This is a helper function that only returns the directories in a given
    folder.

    :param path: The path to list directories in.
    """
    return (name for name in os.listdir(path)
            if os.path.isdir(os.path.join(path, name)))


def load_themes_from(path):
    """
    This is used by the default loaders. You give it a path, and it will find
    valid themes and yield them one by one.

    :param path: The path to search for themes in.
    """
    for basename in (b for b in list_folders(path) if IDENTIFIER.match(b)):
        try:
            t = Theme(os.path.join(path, basename))
        except:
            pass
        else:
            if t.identifier == basename:
                yield t


def packaged_themes_loader(app):
    """
    This theme will find themes that are shipped with the application. It will
    look in the application's root path for a ``themes`` directory - for
    example, the ``someapp`` package can ship themes in the directory
    ``someapp/themes/``.
    """
    themes_path = os.path.join(app.root_path, 'themes')
    if os.path.exists(themes_path):
        return load_themes_from(themes_path)
    else:
        return ()


def theme_paths_loader(app):
    """
    This checks the app's `THEME_PATHS` configuration variable to find
    directories that contain themes. The theme's identifier must match the
    name of its directory.
    """
    theme_paths = app.config.get('THEME_PATHS', ())

    if isinstance(theme_paths, text_type):
        theme_paths = [p.strip() for p in theme_paths.split(';')]
    return starchain(
        load_themes_from(path) for path in theme_paths
    )


class ThemeTemplateLoader(BaseLoader):
    """
    This is a template loader that loads templates from the current app's
    loaded themes.
    """
    def __init__(self, as_blueprint=False):
        self.as_blueprint = as_blueprint
        BaseLoader.__init__(self)

    def get_source(self, environment, template):
        if self.as_blueprint and template.startswith("_themes/"):
            template = template[8:]
        try:
            themename, templatename = template.split('/', 1)
            ctx = stack.top
            theme = ctx.app.theme_manager.themes[themename]
        except (ValueError, KeyError):
            raise TemplateNotFound(template)
        try:
            return theme.jinja_loader.get_source(environment, templatename)
        except TemplateNotFound:
            raise TemplateNotFound(template)

    def list_templates(self):
        res = []
        ctx = stack.top
        fmt = '_themes/%s/%s'
        for ident, theme in iteritems(ctx.app.theme_manager.themes):
            res.extend((fmt % (ident, t))
                       for t in theme.jinja_loader.list_templates())
        return res

#########################################################################

themes_blueprint = Blueprint('_themes', __name__)
themes_blueprint.jinja_loader = ThemeTemplateLoader(True)


class Themes:
    """
    This is the main class you will use to interact
    with Flask-Themes2 on your app.

    It really only implements the bare minimum, the rest
    is passed through to other methods and classes.
    """

    def __init__(self, app=None, **kwargs):
        """
        If given an app, this will simply call init_themes,
        and pass through all kwargs to init_themes,
        making it super easy.

        :param app: the `~flask.Flask` instance to setup themes for.
        :param \*\*kwargs: keyword args to pass through to init_themes
        """
        if app is not None:
            self._app = app
            self.init_themes(self._app, **kwargs)
        else:
            self._app = None

    def init_themes(self, app, loaders=None, app_identifier=None,
                    manager_cls=None, theme_url_prefix="/_themes",
                    static_folder=None):
        """This sets up the theme infrastructure by adding a `ThemeManager`
        to the given app and registering the module/blueprint containing the
        views and templates needed.

        :param app: The `~flask.Flask` instance to set up themes for.
        :param loaders: An iterable of loaders to use. It defaults to
                        `packaged_themes_loader` and `theme_paths_loader`.
        :param app_identifier: The application identifier to use. If not given,
                               it defaults to the app's import name.
        :param manager_cls: If you need a custom manager class, you can pass it
                            in here.
        :param theme_url_prefix: The prefix to use for the URLs on the themes
                                 module. (Defaults to ``/_themes``.)
        """
        if app_identifier is None:
            app_identifier = app.import_name
        if manager_cls is None:
            manager_cls = ThemeManager
        manager_cls(app, app_identifier, loaders=loaders, static_folder=static_folder)

        app.jinja_env.globals['theme'] = global_theme_template
        app.jinja_env.globals['theme_static'] = global_theme_static
        app.jinja_env.globals['theme_get_info'] = global_theme_get_info

        if static_folder:
            themes_blueprint.static_folder = static_folder
            themes_blueprint.static_url_path = app.static_url_path + theme_url_prefix
        else:
            themes_blueprint.url_prefix = theme_url_prefix
            themes_blueprint.add_url_rule('/<themeid>/<path:filename>', 'static', view_func=static)


        app.register_blueprint(themes_blueprint)


class ThemeManager(object):
    """
    This is responsible for loading and storing all the themes for an
    application. Calling `refresh` will cause it to invoke all of the theme
    loaders.

    A theme loader is simply a callable that takes an app and returns an
    iterable of `Theme` instances. You can implement your own loaders if your
    app has another way to load themes.

    :param app: The app to bind to. (Each instance is only usable for one
                app.)
    :param app_identifier: The value that the info.json's `application` key
                           is required to have. If you require a more complex
                           check, you can subclass and override the
                           `valid_app_id` method.
    :param loaders: An iterable of loaders to use. The defaults are
                    `packaged_themes_loader` and `theme_paths_loader`, in that
                    order.
    """
    def __init__(self, app, app_identifier, loaders=None, static_folder=None):
        self.bind_app(app)
        self.app_identifier = app_identifier
        self.static_folder = static_folder

        self._themes = None

        #: This is a list of the loaders that will be used to load the themes.
        self.loaders = []
        if loaders:
            self.loaders.extend(loaders)
        else:
            self.loaders.extend((packaged_themes_loader, theme_paths_loader))

    @property
    def themes(self):
        """
        This is a dictionary of all the themes that have been loaded. The keys
        are the identifiers and the values are `Theme` objects.
        """
        if self._themes is None:
            self.refresh()
        return self._themes

    def list_themes(self):
        """
        This yields all the `Theme` objects, in sorted order.
        """
        return sorted(itervalues(self.themes), key=attrgetter('identifier'))

    def bind_app(self, app):
        """
        If an app wasn't bound when the manager was created, this will bind
        it. The app must be bound for the loaders to work.

        :param app: A `~flask.Flask` instance.
        """
        self.app = app
        app.theme_manager = self

    def valid_app_id(self, app_identifier):
        """
        This checks whether the application identifier given will work with
        this application. The default implementation checks whether the given
        identifier matches the one given at initialization.

        :param app_identifier: The application identifier to check.
        """
        return self.app_identifier == app_identifier

    def refresh(self):
        """
        This loads all of the themes into the `themes` dictionary. The loaders
        are invoked in the order they are given, so later themes will override
        earlier ones. Any invalid themes found (for example, if the
        application identifier is incorrect) will be skipped.
        """
        self._themes = {}
        for theme in starchain(ldr(self.app) for ldr in self.loaders):
            if self.valid_app_id(theme.application):
                self.themes[theme.identifier] = theme


class Theme(object):
    """
    This contains a theme's metadata.

    :param path: The path to the theme directory.
    """
    def __init__(self, path):
        #: The theme's root path. All the files in the theme are under this
        #: path.
        self.path = os.path.abspath(path)

        with open(os.path.join(self.path, 'info.json')) as fd:
            self.info = i = json.load(fd)

        #: The theme's name, as given in info.json. This is the human
        #: readable name.
        self.name = i['name']

        #: The application identifier given in the theme's info.json. Your
        #: application will probably want to validate it.
        self.application = i['application']

        #: The theme's identifier. This is an actual Python identifier,
        #: and in most situations should match the name of the directory the
        #: theme is in.
        self.identifier = i['identifier']

        #: The human readable description. This is the default (English)
        #: version.
        self.description = i.get('description')

        #: This is a dictionary of localized versions of the description.
        #: The language codes are all lowercase, and the ``en`` key is
        #: preloaded with the base description.
        self.localized_desc = dict(
            (k.split('_', 1)[1].lower(), v) for k, v in i.items()
            if k.startswith('description_')
        )
        self.localized_desc.setdefault('en', self.description)

        #: The author's name, as given in info.json. This may or may not
        #: include their email, so it's best just to display it as-is.
        self.author = i['author']

        #: A short phrase describing the license, like "GPL", "BSD", "Public
        #: Domain", or "Creative Commons BY-SA 3.0".
        self.license = i.get('license')

        #: A URL pointing to the license text online.
        self.license_url = i.get('license_url')

        #: The URL to the theme's or author's Web site.
        self.website = i.get('website')

        #: The theme's preview image, within the static folder.
        self.preview = i.get('preview')

        #: The theme's doctype. This can be ``html4``, ``html5``, or ``xhtml``
        #: with html5 being the default if not specified.
        self.doctype = i.get('doctype', 'html5')

        #: The theme's version string.
        self.version = i.get('version')

        #: Any additional options. These are entirely application-specific,
        #: and may determine other aspects of the application's behavior.
        self.options = i.get('options', {})

    @cached_property
    def static_path(self):
        """
        The absolute path to the theme's static files directory.
        """
        return os.path.join(self.path, 'static')

    @cached_property
    def templates_path(self):
        """
        The absolute path to the theme's templates directory.
        """
        return os.path.join(self.path, 'templates')

    @cached_property
    def license_text(self):
        """
        The contents of the theme's license.txt file, if it exists. This is
        used to display the full license text if necessary. (It is `None` if
        there was not a license.txt.)
        """
        lt_path = os.path.join(self.path, 'license.txt')
        if os.path.exists(lt_path):
            with open(lt_path) as fd:
                return fd.read()
        else:
            return None

    @cached_property
    def jinja_loader(self):
        """
        This is a Jinja2 template loader that loads templates from the theme's
        ``templates`` directory.
        """
        return FileSystemLoader(self.templates_path)
