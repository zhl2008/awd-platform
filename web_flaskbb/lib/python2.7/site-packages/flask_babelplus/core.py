# -*- coding: utf-8 -*-
"""
    flask_babelplus.babel
    ~~~~~~~~~~~~~~~~~~~~~

    The actual Flask extension.

    :copyright: (c) 2013 by Armin Ronacher, Daniel Neuhäuser and contributors.
    :license: BSD, see LICENSE for more details.
"""
import os
from babel import Locale
try:
    from pytz.gae import pytz
except ImportError:
    from pytz import timezone
else:
    timezone = pytz.timezone  # pragma: no cover

from .constants import DEFAULT_LOCALE, DEFAULT_TIMEZONE,\
    DEFAULT_DATE_FORMATS
from .domain import Domain, get_domain
from .utils import format_datetime, format_date, format_time, \
    format_timedelta, format_number, format_decimal, format_currency, \
    format_percent, format_scientific, get_state


class Babel(object):
    """Central controller class that can be used to configure how
    Flask-Babel behaves.  Each application that wants to use Flask-Babel
    has to create, or run :meth:`init_app` on, an instance of this class
    after the configuration was initialized.
    """

    def __init__(self, app=None, **kwargs):
        """Initializes the Flask-BabelPlus extension.

        :param app: The Flask application.
        :param kwargs: Optional arguments that will be passed to
                       ``init_app``.
        """
        self.app = app
        self.locale_selector_func = None
        self.timezone_selector_func = None

        if app is not None:
            self.init_app(app, **kwargs)

    def init_app(self, app, default_locale=DEFAULT_LOCALE,
                 default_timezone=DEFAULT_TIMEZONE, date_formats=None,
                 configure_jinja=True, default_domain=None):
        """Initializes the Flask-BabelPlus extension.

        :param app: The Flask application.
        :param default_locale: The default locale which should be used.
                               Defaults to 'en'.
        :param default_timezone: The default timezone. Defaults to 'UTC'.
        :param date_formats: A mapping of Babel datetime format strings
        :param configure_jinja: If set to ``True`` some convenient jinja2
                                filters are being added.
        :param default_domain: The default translation domain.
        """
        if default_domain is None:
            default_domain = Domain()

        app.config.setdefault('BABEL_DEFAULT_LOCALE', default_locale)
        app.config.setdefault('BABEL_DEFAULT_TIMEZONE', default_timezone)
        app.config.setdefault('BABEL_CONFIGURE_JINJA', configure_jinja)
        app.config.setdefault('BABEL_DOMAIN', default_domain)

        app.extensions['babel'] = _BabelState(babel=self, app=app,
                                              domain=default_domain)

        #: a mapping of Babel datetime format strings that can be modified
        #: to change the defaults.  If you invoke :func:`format_datetime`
        #: and do not provide any format string Flask-Babel will do the
        #: following things:
        #:
        #: 1.   look up ``date_formats['datetime']``.  By default ``'medium'``
        #:      is returned to enforce medium length datetime formats.
        #: 2.   ``date_formats['datetime.medium'] (if ``'medium'`` was
        #:      returned in step one) is looked up.  If the return value
        #:      is anything but `None` this is used as new format string.
        #:      otherwise the default for that language is used.
        self.date_formats = date_formats or DEFAULT_DATE_FORMATS.copy()

        if configure_jinja:
            app.jinja_env.filters.update(
                datetimeformat=format_datetime,
                dateformat=format_date,
                timeformat=format_time,
                timedeltaformat=format_timedelta,

                numberformat=format_number,
                decimalformat=format_decimal,
                currencyformat=format_currency,
                percentformat=format_percent,
                scientificformat=format_scientific,
            )
            app.jinja_env.add_extension('jinja2.ext.i18n')
            app.jinja_env.install_gettext_callables(
                lambda x: get_domain().get_translations().ugettext(x),
                lambda s, p, n: get_domain().get_translations()
                                            .ungettext(s, p, n),
                newstyle=True
            )

    def localeselector(self, f):
        """Registers a callback function for locale selection.  The default
        behaves as if a function was registered that returns `None` all the
        time.  If `None` is returned, the locale falls back to the one from
        the configuration.

        This has to return the locale as string (eg: ``'de_AT'``, ''`en_US`'')
        """
        self.locale_selector_func = f
        return f

    def timezoneselector(self, f):
        """Registers a callback function for timezone selection.  The default
        behaves as if a function was registered that returns `None` all the
        time.  If `None` is returned, the timezone falls back to the one from
        the configuration.

        This has to return the timezone as string (eg: ``'Europe/Vienna'``)
        """
        self.timezone_selector_func = f
        return f

    def list_translations(self):
        """Returns a list of all the locales translations exist for.  The
        list returned will be filled with actual locale objects and not just
        strings.

        .. versionadded:: 0.6
        """

        # XXX: Wouldn't it be better to list the locales from the domain?
        state = get_state()
        dirname = os.path.join(state.app.root_path, 'translations')
        if not os.path.isdir(dirname):
            return []
        result = []
        for folder in os.listdir(dirname):
            locale_dir = os.path.join(dirname, folder, 'LC_MESSAGES')
            if not os.path.isdir(locale_dir):
                continue
            if filter(lambda x: x.endswith('.mo'), os.listdir(locale_dir)):
                result.append(Locale.parse(folder))
        if not result:
            result.append(Locale.parse(self.default_locale))
        return result

    @property
    def default_locale(self):
        """The default locale from the configuration as instance of a
        `babel.Locale` object.
        """
        state = get_state()
        return self.load_locale(state.app.config['BABEL_DEFAULT_LOCALE'])

    @property
    def default_timezone(self):
        """The default timezone from the configuration as instance of a
        `pytz.timezone` object.
        """
        state = get_state()
        return timezone(state.app.config['BABEL_DEFAULT_TIMEZONE'])

    def load_locale(self, locale):
        """Load locale by name and cache it. Returns instance of a
        `babel.Locale` object.
        """
        state = get_state()
        rv = state.locale_cache.get(locale)
        if rv is None:
            state.locale_cache[locale] = rv = Locale.parse(locale)
        return rv


class _BabelState(object):
    def __init__(self, babel, app, domain):
        self.babel = babel
        self.app = app
        self.domain = domain
        self.locale_cache = {}

    def __repr__(self):
        return '<_BabelState({}, {}, {})>'.format(self.babel, self.app,
                                                  self.domain)
