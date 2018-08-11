# -*- coding: utf-8 -*-
"""
    flask_babelplus.domain
    ~~~~~~~~~~~~~~~~~~~~~~

    Localization domain.

    :copyright: (c) 2013 by Armin Ronacher, Daniel Neuhäuser and contributors.
    :license: BSD, see LICENSE for more details.
"""
import os
from babel import support

from .utils import get_state, get_locale
from .speaklater import LazyString


class Domain(object):
    """Localization domain. By default it will look for tranlations in the
    Flask application directory and "messages" domain - all message
    catalogs should be called ``messages.mo``.
    """

    def __init__(self, dirname=None, domain='messages'):
        self.dirname = dirname
        self.domain = domain

        self.cache = dict()

    def as_default(self):
        """Set this domain as the default one for the current request"""
        get_state().domain = self

    def get_translations_cache(self):
        """Returns a dictionary-like object for translation caching"""
        return self.cache

    def get_translations_path(self, app):
        """Returns the translations directory path. Override if you want
        to implement custom behavior.
        """
        return self.dirname or os.path.join(app.root_path, 'translations')

    def get_translations(self):
        """Returns the correct gettext translations that should be used for
        this request.  This will never fail and return a dummy translation
        object if used outside of the request or if a translation cannot be
        found.
        """
        state = get_state(silent=True)

        if state is None:
            return support.NullTranslations()

        locale = get_locale()
        cache = self.get_translations_cache()

        translations = cache.get(str(locale))
        if translations is None:
            dirname = self.get_translations_path(state.app)
            translations = support.Translations.load(
                dirname,
                locale,
                domain=self.domain
            )
            self.cache[str(locale)] = translations

        return translations

    def gettext(self, string, **variables):
        """Translates a string with the current locale and passes in the
        given keyword arguments as mapping to a string formatting string.

        ::

            gettext(u'Hello World!')
            gettext(u'Hello %(name)s!', name='World')
        """
        t = self.get_translations()
        if variables:
            return t.ugettext(string) % variables
        return t.ugettext(string)

    def ngettext(self, singular, plural, num, **variables):
        """Translates a string with the current locale and passes in the
        given keyword arguments as mapping to a string formatting string.
        The `num` parameter is used to dispatch between singular and various
        plural forms of the message.  It is available in the format string
        as ``%(num)d`` or ``%(num)s``.  The source language should be
        English or a similar language which only has one plural form.

        ::

            ngettext(u'%(num)d Apple', u'%(num)d Apples', num=len(apples))
        """
        variables.setdefault('num', num)
        t = self.get_translations()
        return t.ungettext(singular, plural, num) % variables

    def pgettext(self, context, string, **variables):
        """Like :func:`gettext` but with a context.

        Gettext uses the ``msgctxt`` notation to distinguish different
        contexts for the same ``msgid``

        For example::

            pgettext(u'Button label', 'Log in')

        Learn more about contexts here:
        https://www.gnu.org/software/gettext/manual/html_node/Contexts.html

        .. versionadded:: 0.7
        """
        t = self.get_translations()
        if variables:
            return t.upgettext(context, string) % variables
        return t.upgettext(context, string)

    def npgettext(self, context, singular, plural, num, **variables):
        """Like :func:`ngettext` but with a context.

        .. versionadded:: 0.7
        """
        variables.setdefault('num', num)
        t = self.get_translations()
        return t.unpgettext(context, singular, plural, num) % variables

    def lazy_gettext(self, string, **variables):
        """Like :func:`gettext` but the string returned is lazy which means
        it will be translated when it is used as an actual string.

        Example::

            hello = lazy_gettext(u'Hello World')

            @app.route('/')
            def index():
                return unicode(hello)
        """
        return LazyString(self.gettext, string, **variables)

    def lazy_pgettext(self, context, string, **variables):
        """Like :func:`pgettext` but the string returned is lazy which means
        it will be translated when it is used as an actual string.

        .. versionadded:: 0.7
        """
        return LazyString(self.pgettext, context, string, **variables)


# This is the domain that will be used if there is no request context
# and thus no app.
# It will also use this domain if the app isn't initialized for babel.
# Note that if there is no request context, then the standard
# Domain will use NullTranslations.
domain = Domain()


def get_domain():
    """Return the correct translation domain that is used for this request.
    This will return the default domain
    e.g. "messages" in <approot>/translations" if none is set for this
    request.
    """
    state = get_state(silent=True)
    if state is None:
        return domain

    return state.domain


# Create shortcuts for the default Flask domain
def gettext(*args, **kwargs):
    return get_domain().gettext(*args, **kwargs)
_ = gettext  # noqa


def ngettext(*args, **kwargs):
    return get_domain().ngettext(*args, **kwargs)


def pgettext(*args, **kwargs):
    return get_domain().pgettext(*args, **kwargs)


def npgettext(*args, **kwargs):
    return get_domain().npgettext(*args, **kwargs)


def lazy_gettext(*args, **kwargs):
    return LazyString(gettext, *args, **kwargs)


def lazy_pgettext(*args, **kwargs):
    return LazyString(pgettext, *args, **kwargs)
