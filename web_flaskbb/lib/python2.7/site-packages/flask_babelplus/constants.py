# -*- coding: utf-8 -*-
"""
    flask_babelplus.constants
    ~~~~~~~~~~~~~~~~~~~~~~~~~

    This module contains the constants that are used in this
    extension.

    :copyright: (c) 2013 by Armin Ronacher, Daniel Neuhäuser and contributors.
    :license: BSD, see LICENSE for more details.
"""
from werkzeug import ImmutableDict

DEFAULT_LOCALE = "en"
DEFAULT_TIMEZONE = "UTC"
DEFAULT_DATE_FORMATS = ImmutableDict({
    'time': 'medium',
    'date': 'medium',
    'datetime': 'medium',
    'time.short': None,
    'time.medium': None,
    'time.full': None,
    'time.long': None,
    'date.short': None,
    'date.medium': None,
    'date.full': None,
    'date.long': None,
    'datetime.short': None,
    'datetime.medium': None,
    'datetime.full': None,
    'datetime.long': None,
})
