# -*- coding: utf-8 -*-
"""
    flask_babelplus.utils
    ~~~~~~~~~~~~~~~~~~~~~

    This module contains some utilities that are useful
    while working with Babel.

    :copyright: (c) 2013 by Armin Ronacher, Daniel Neuhäuser and contributors.
    :license: BSD, see LICENSE for more details.
"""
from datetime import datetime
from contextlib import contextmanager
from babel import dates, numbers
from flask import current_app, has_request_context, request
try:
    from pytz.gae import pytz
except ImportError:
    from pytz import timezone, UTC
else:  # pragma: no cover
    timezone = pytz.timezone
    UTC = pytz.UTC

from ._compat import string_types


def get_state(app=None, silent=False):
    """Gets the application-specific babel data.

    :param app: The Flask application. Defaults to the current app.
    :param silent: If set to True, it will return ``None`` instead of raising
                   a ``RuntimeError``.
    """
    if app is None:
        app = current_app

    if silent and (not app or 'babel' not in app.extensions):
        return None

    if 'babel' not in app.extensions:
        raise RuntimeError("The babel extension was not registered to the "
                           "current application. Please make sure to call "
                           "init_app() first.")

    return app.extensions['babel']


def get_locale():
    """Returns the locale that should be used for this request as
    `babel.Locale` object.  This returns `None` if used outside of
    a request.
    """
    ctx = _get_current_context()
    if ctx is None:
        # outside of an request context
        return None

    locale = getattr(ctx, 'babel_locale', None)
    state = get_state()
    # no locale found on current request context
    if locale is None:
        if state.babel.locale_selector_func is not None:
            locale = state.babel.load_locale(
                state.babel.locale_selector_func()
            )
        else:
            locale = state.babel.default_locale

        # set the locale for the current request
        ctx.babel_locale = locale

    return locale


def get_timezone():
    """Returns the timezone that should be used for this request as
    `pytz.timezone` object.  This returns `None` if used outside of
    a request.
    """
    ctx = _get_current_context()
    if ctx is None:
        # outside of an request context
        return None

    tzinfo = getattr(ctx, 'babel_tzinfo', None)
    state = get_state()
    if tzinfo is None:
        if state.babel.timezone_selector_func is not None:
            rv = state.babel.timezone_selector_func()
            if rv is None:
                tzinfo = state.babel.default_timezone
            else:
                if isinstance(rv, string_types):
                    tzinfo = timezone(rv)
                else:
                    tzinfo = rv
        else:
            tzinfo = state.babel.default_timezone
        ctx.babel_tzinfo = tzinfo
    return tzinfo


def refresh():
    """Refreshes the cached timezones and locale information.  This can
    be used to switch a translation between a request and if you want
    the changes to take place immediately, not just with the next request::

        user.timezone = request.form['timezone']
        user.locale = request.form['locale']
        refresh()
        flash(gettext('Language was changed'))

    Without that refresh, the :func:`~flask.flash` function would probably
    return English text and a now German page.
    """
    ctx = _get_current_context()
    for key in ('babel_locale', 'babel_tzinfo'):
        if hasattr(ctx, key):
            delattr(ctx, key)


@contextmanager
def force_locale(locale):
    """Temporarily overrides the currently selected locale.
    Sometimes it is useful to switch the current locale to
    different one, do some tasks and then revert back to the
    original one. For example, if the user uses German on the
    web site, but you want to send them an email in English,
    you can use this function as a context manager::

        with force_locale('en_US'):
            send_email(gettext('Hello!'), ...)

    :param locale: The locale to temporary switch to (ex: 'en_US').
    """
    ctx = _get_current_context()
    if ctx is None:
        yield
        return

    state = get_state()

    orig_locale_selector_func = state.babel.locale_selector_func
    orig_attrs = {}
    for key in ('babel_translations', 'babel_locale'):
        orig_attrs[key] = getattr(ctx, key, None)

    try:
        state.babel.locale_selector_func = lambda: locale
        for key in orig_attrs:
            setattr(ctx, key, None)
        yield
    finally:
        state.babel.locale_selector_func = orig_locale_selector_func
        for key, value in orig_attrs.items():
            setattr(ctx, key, value)


def _get_format(key, format=None):
    """A small helper for the datetime formatting functions.  Looks up
    format defaults for different kinds.
    """
    state = get_state()
    if format is None:
        format = state.babel.date_formats[key]
    if format in ('short', 'medium', 'full', 'long'):
        rv = state.babel.date_formats['%s.%s' % (key, format)]
        if rv is not None:
            format = rv
    return format


def to_user_timezone(datetime):
    """Convert a datetime object to the user's timezone.  This automatically
    happens on all date formatting unless rebasing is disabled.  If you need
    to convert a :class:`datetime.datetime` object at any time to the user's
    timezone (as returned by :func:`get_timezone` this function can be used).
    """
    if datetime.tzinfo is None:
        datetime = datetime.replace(tzinfo=UTC)
    tzinfo = get_timezone()
    return tzinfo.normalize(datetime.astimezone(tzinfo))


def to_utc(datetime):
    """Convert a datetime object to UTC and drop tzinfo.  This is the
    opposite operation to :func:`to_user_timezone`.
    """
    if datetime.tzinfo is None:
        datetime = get_timezone().localize(datetime)
    return datetime.astimezone(UTC).replace(tzinfo=None)


def format_datetime(datetime=None, format=None, rebase=True):
    """Return a date formatted according to the given pattern.  If no
    :class:`~datetime.datetime` object is passed, the current time is
    assumed.  By default rebasing happens which causes the object to
    be converted to the users's timezone (as returned by
    :func:`to_user_timezone`).  This function formats both date and
    time.

    The format parameter can either be ``'short'``, ``'medium'``,
    ``'long'`` or ``'full'`` (in which cause the language's default for
    that setting is used, or the default from the :attr:`Babel.date_formats`
    mapping is used) or a format string as documented by Babel.

    This function is also available in the template context as filter
    named `datetimeformat`.
    """
    format = _get_format('datetime', format)
    return _date_format(dates.format_datetime, datetime, format, rebase)


def format_date(date=None, format=None, rebase=True):
    """Return a date formatted according to the given pattern.  If no
    :class:`~datetime.datetime` or :class:`~datetime.date` object is passed,
    the current time is assumed.  By default rebasing happens which causes
    the object to be converted to the users's timezone (as returned by
    :func:`to_user_timezone`).  This function only formats the date part
    of a :class:`~datetime.datetime` object.

    The format parameter can either be ``'short'``, ``'medium'``,
    ``'long'`` or ``'full'`` (in which cause the language's default for
    that setting is used, or the default from the :attr:`Babel.date_formats`
    mapping is used) or a format string as documented by Babel.

    This function is also available in the template context as filter
    named `dateformat`.
    """
    if rebase and isinstance(date, datetime):
        date = to_user_timezone(date)
    format = _get_format('date', format)
    return _date_format(dates.format_date, date, format, rebase)


def format_time(time=None, format=None, rebase=True):
    """Return a time formatted according to the given pattern.  If no
    :class:`~datetime.datetime` object is passed, the current time is
    assumed.  By default rebasing happens which causes the object to
    be converted to the users's timezone (as returned by
    :func:`to_user_timezone`).  This function formats both date and
    time.

    The format parameter can either be ``'short'``, ``'medium'``,
    ``'long'`` or ``'full'`` (in which cause the language's default for
    that setting is used, or the default from the :attr:`Babel.date_formats`
    mapping is used) or a format string as documented by Babel.

    This function is also available in the template context as filter
    named `timeformat`.
    """
    format = _get_format('time', format)
    return _date_format(dates.format_time, time, format, rebase)


def format_timedelta(datetime_or_timedelta, granularity='second',
                     add_direction=False, threshold=0.85):
    """Format the elapsed time from the given date to now or the given
    timedelta.
    This function is also available in the template context as filter
    named `timedeltaformat`.
    """
    if isinstance(datetime_or_timedelta, datetime):
        datetime_or_timedelta = datetime.utcnow() - datetime_or_timedelta
    return dates.format_timedelta(
        datetime_or_timedelta,
        granularity,
        threshold=threshold,
        add_direction=add_direction,
        locale=get_locale()
    )


def _date_format(formatter, obj, format, rebase, **extra):
    """Internal helper that formats the date."""
    locale = get_locale()
    extra = {}
    if formatter is not dates.format_date and rebase:
        extra['tzinfo'] = get_timezone()
    return formatter(obj, format, locale=locale, **extra)


def format_number(number):
    """Return the given number formatted for the locale in request

    :param number: the number to format
    :return: the formatted number
    :rtype: unicode
    """
    locale = get_locale()
    return numbers.format_number(number, locale=locale)


def format_decimal(number, format=None):
    """Return the given decimal number formatted for the locale in request

    :param number: the number to format
    :param format: the format to use
    :return: the formatted number
    :rtype: unicode
    """
    locale = get_locale()
    return numbers.format_decimal(number, format=format, locale=locale)


def format_currency(number, currency, format=None, currency_digits=True,
                    format_type='standard'):
    """Return the given number formatted for the locale in request
    :param number: the number to format
    :param currency: the currency code
    :param format: the format to use
    :param currency_digits: use the currency’s number of decimal digits
                            [default: True]
    :param format_type: the currency format type to use
                        [default: standard]
    :return: the formatted number
    :rtype: unicode
    """
    locale = get_locale()
    return numbers.format_currency(
        number,
        currency,
        format=format,
        locale=locale,
        currency_digits=currency_digits,
        format_type=format_type
    )


def format_percent(number, format=None):
    """Return formatted percent value for the locale in request

    :param number: the number to format
    :param format: the format to use
    :return: the formatted percent number
    :rtype: unicode
    """
    locale = get_locale()
    return numbers.format_percent(number, format=format, locale=locale)


def format_scientific(number, format=None):
    """Return value formatted in scientific notation for the locale in request

    :param number: the number to format
    :param format: the format to use
    :return: the formatted percent number
    :rtype: unicode
    """
    locale = get_locale()
    return numbers.format_scientific(number, format=format, locale=locale)


def _get_current_context():
    """Returns the current request."""
    if has_request_context():
        return request

    if current_app:
        return current_app
