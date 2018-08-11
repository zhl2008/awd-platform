Flask-Redis
===========

.. image:: https://api.travis-ci.org/underyx/flask-redis.svg?branch=master
   :target: https://travis-ci.org/underyx/flask-redis
   :alt: Test Suite

.. image:: https://coveralls.io/repos/underyx/flask-redis/badge.svg
   :target: https://coveralls.io/github/underyx/flask-redis
   :alt: Test Coverage

.. image:: https://landscape.io/github/underyx/flask-redis/master/landscape.svg
           ?style=flat
   :target: https://landscape.io/github/underyx/flask-redis
   :alt: Code Health

Adds Redis support to Flask.

Built on top of redis-py_.

Contributors
------------

- Rhys Elsmore - @rhyselsmore - https://github.com/rhyselsmore
- Bence Nagy - @underyx - https://github.com/underyx
- Lars Schöning - @lyschoening - https://github.com/lyschoening
- Aaron Tygart - @thekuffs - https://github.com/thekuffs
- Christian Sueiras - @csueiras - https://github.com/csueiras


Installation
------------

.. code-block:: bash

    pip install flask-redis

Or if you *must* use easy_install:

.. code-block:: bash

    alias easy_install="pip install $1"
    easy_install flask-redis


Configuration
-------------

Your configuration should be declared within your Flask config. Set the URL of
your database like this:

.. code-block:: python

    REDIS_URL = "redis://:password@localhost:6379/0"
    # or
    REDIS_URL = "unix://[:password]@/path/to/socket.sock?db=0"


To create the redis instance within your application

.. code-block:: python

    from flask import Flask
    from flask.ext.redis import FlaskRedis

    app = Flask(__name__)
    redis_store = FlaskRedis(app)

or

.. code-block:: python

    from flask import Flask
    from flask.ext.redis import FlaskRedis

    redis_store = FlaskRedis()

    def create_app():
        app = Flask(__name__)
        redis_store.init_app(app)
        return app

or perhaps you want to use the old, plain ``Redis`` class instead of
``StrictRedis``

.. code-block:: python

    from flask import Flask
    from flask.ext.redis import FlaskRedis
    from redis import StrictRedis

    app = Flask(__name__)
    redis_store = FlaskRedis(app, strict=False)

or maybe you want to use
`mockredis <https://github.com/locationlabs/mockredis>`_ to make your unit
tests simpler.  As of ``mockredis`` 2.9.0.10, it does not have the
``from_url()`` classmethod that ``FlaskRedis`` depends on, so we wrap it and add
our own.

.. code-block:: python


    from flask import Flask
    from flask.ext.redis import FlaskRedis
    from mockredis import MockRedis



    class MockRedisWrapper(MockRedis):
        '''A wrapper to add the `from_url` classmethod'''
        @classmethod
        def from_url(cls, *args, **kwargs):
            return cls()

    def create_app():
        app = Flask(__name__)
        if app.testing:
            redis_store = FlaskRedis.from_custom_provider(MockRedisWrapper)
        else:
            redis_store = FlaskRedis()
        redis_store.init_app(app)
        return app

Usage
-----

``FlaskRedis`` proxies attribute access to an underlying Redis connection. So
treat it as if it were a regular ``Redis``
instance.

.. code-block:: python

    from core import redis_store

    @app.route('/')
    def index():
        return redis_store.get('potato', 'Not Set')

**Protip:** The redis-py_ package currently holds the 'redis' namespace, so if
you are looking to make use of it, your Redis object shouldn't be named 'redis'.

For detailed instructions regarding the usage of the client, check the redis-py_
documentation.

Advanced features, such as Lua scripting, pipelines and callbacks are detailed
within the projects README.

Contribute
----------

#. Check for open issues or open a fresh issue to start a discussion around a
   feature idea or a bug. There is a Contributor Friendly tag for issues that
   should be ideal for people who are not very familiar with the codebase yet.
#. Fork `the repository`_ on Github to start making your changes to the
   **master** branch (or branch off of it).
#. Write a test which shows that the bug was fixed or that the feature works as
   expected.
#. Send a pull request and bug the maintainer until it gets merged and
   published.

.. _`the repository`: https://github.com/underyx/flask-redis
.. _redis-py: https://github.com/andymccurdy/redis-py


History
=======

0.3.0 (2016-07-18)
------------------

- **Backwards incompatible:** The ``FlaskRedis.init_app`` method no longer takes
  a ``strict`` parameter. Pass this flag when creating your ``FlaskRedis``
  instance, instead.
- **Backwards incompatible:** The extension will now be registered under the
  (lowercased) config prefix of the instance. The default config prefix is
  ``'REDIS'``, so unless you change that, you can still access the extension via
  ``app.extensions['redis']`` as before.
- **Backwards incompatible:** The default class has been changed to
  ``redis.StrictRedis``. You can switch back to the old ``redis.Redis`` class by
  specifying ``strict=False`` in the ``FlaskRedis`` kwargs.
- You can now pass all supported ``Redis`` keyword arguments (such as
  ``decode_responses``) to ``FlaskRedis`` and they will be correctly passed over
  to the ``redis-py`` instance. Thanks, @giyyapan!
- Usage like ``redis_store['key'] = value``, ``redis_store['key']``, and
  ``del redis_store['key']`` is now supported. Thanks, @ariscn!

0.2.0 (4/15/2015)
-----------------

- Made 0.1.0's deprecation warned changes final

0.1.0 (4/15/2015)
-----------------

- **Deprecation:** Renamed ``flask_redis.Redis`` to ``flask_redis.FlaskRedis``.
  Using the old name still works, but emits a deprecation warning, as it will
  be removed from the next version
- **Deprecation:** Setting a ``REDIS_DATABASE`` (or equivalent) now emits a
  deprecation warning as it will be removed in the version in favor of
  including the database number in ``REDIS_URL`` (or equivalent)
- Added a ``FlaskRedis.from_custom_provider(provider)`` class method for using
  any redis provider class that supports instantiation with a ``from_url``
  class method
- Added a ``strict`` parameter to ``FlaskRedis`` which expects a boolean value
  and allows choosing between using ``redis.StrictRedis`` and ``redis.Redis``
  as the defualt provider.
- Made ``FlaskRedis`` register as a Flask extension through Flask's extension
  API
- Rewrote test suite in py.test
- Got rid of the hacky attribute copying mechanism in favor of using the
  ``__getattr__`` magic method to pass calls to the underlying client

0.0.6 (4/9/2014)
----------------

- Improved Python 3 Support (Thanks underyx!).
- Improved test cases.
- Improved configuration.
- Fixed up documentation.
- Removed un-used imports (Thanks underyx and lyschoening!).


0.0.5 (17/2/2014)
-----------------

- Improved suppot for the config prefix.

0.0.4 (17/2/2014)
-----------------

- Added support for config_prefix, allowing multiple DBs.

0.0.3 (6/7/2013)
----------------

- Added TravisCI Testing for Flask 0.9/0.10.
- Added Badges to README.

0.0.2 (6/7/2013)
----------------

- Implemented a very simple test.
- Fixed some documentation issues.
- Included requirements.txt for testing.
- Included task file including some basic methods for tests.

0.0.1 (5/7/2013)
----------------

- Conception
- Initial Commit of Package to GitHub.


