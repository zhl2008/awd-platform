
Flask-BabelPlus
---------------

Adds i18n/l10n support to Flask applications with the help of the
`Babel`_ library.

This is a fork of Flask-BabelEx which in turn is a fork of the official
Flask-Babel extension. It is API compatible with both forks.

It comes with following additional features:

1. It is possible to use multiple language catalogs in one Flask application;
2. Localization domains: your extension can package localization file(s) and
   use them if necessary;
3. Does not reload localizations for each request.

The main difference to Flask-BabelEx is, that you can pass arguments to the
``init_app`` method as well.

.. code:: python

    # Flask-BabelPlus with custom domain
    babel.init_app(app=app, default_domain=FlaskBBDomain(app))


Links
`````

* `Documentation <http://packages.python.org/Flask-BabelPlus>`_
* `Flask-BabelEx <https://github.com/mrjoes/flask-babelex>`_
* `original Flask-Babel <https://pypi.python.org/pypi/Flask-Babel>`_.

.. _Babel: https://github.com/python-babel/babel



