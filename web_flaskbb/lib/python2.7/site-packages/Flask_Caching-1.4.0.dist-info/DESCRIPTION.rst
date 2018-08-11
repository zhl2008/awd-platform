
Flask-Caching
=============

Adds easy cache support to Flask.

Setup
-----

The Cache Extension can either be initialized directly:

.. code:: python

    from flask import Flask
    from flask_caching import Cache

    app = Flask(__name__)
    # For more configuration options, check out the documentation
    cache = Cache(app, config={'CACHE_TYPE': 'simple'})

Or through the factory method:

.. code:: python

    cache = Cache(config={'CACHE_TYPE': 'simple'})

    app = Flask(__name__)
    cache.init_app(app)

Links
=====

* `Documentation <https://pythonhosted.org/Flask-Caching/>`_
* `Source Code <https://github.com/sh4nks/flask-caching>`_
* `Issues <https://github.com/sh4nks/flask-caching/issues>`_
* `original Flask-Cache Extension <https://github.com/thadeusb/flask-cache>`_



