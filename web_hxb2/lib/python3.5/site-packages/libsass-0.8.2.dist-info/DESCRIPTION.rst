libsass: SASS_ for Python
=========================

.. image:: https://img.shields.io/pypi/v/libsass.svg
   :target: https://pypi.python.org/pypi/libsass
   :alt: The latest PyPI release

.. image:: https://travis-ci.org/dahlia/libsass-python.svg?branch=python
   :target: https://travis-ci.org/dahlia/libsass-python
   :alt: Build Status

.. image:: https://ci.appveyor.com/api/projects/status/yghrs9jw7b67c0ia/branch/python?svg=true
   :target: https://ci.appveyor.com/project/dahlia/libsass-python
   :alt: Build Status (Windows)

.. image:: https://img.shields.io/coveralls/dahlia/libsass-python/python.svg
   :target: https://coveralls.io/r/dahlia/libsass-python
   :alt: Coverage Status

This package provides a simple Python extension module ``sass`` which is
binding Libsass_ (written in C/C++ by Hampton Catlin and Aaron Leung).
It's very straightforward and there isn't any headache related Python
distribution/deployment.  That means you can add just ``libsass`` into
your ``setup.py``'s ``install_requires`` list or ``requirements.txt`` file.
Need no Ruby nor Node.js.

It currently supports CPython 2.6, 2.7, 3.3, 3.4, and PyPy 2.3+!

.. _SASS: http://sass-lang.com/
.. _Libsass: https://github.com/sass/libsass


Features
--------

- You don't need any Ruby/Node.js stack at all, for development or deployment
  either.
- Fast. (Libsass_ is written in C++.)
- Simple API.  See the below example code for details.
- Custom functions.
- Support both tabbed (Sass) and braces (SCSS) syntax.
- WSGI middleware for ease of development.
  It automatically compiles Sass/SCSS files for each request.
- ``setuptools``/``distutils`` integration.
  You can build all Sass/SCSS files using
  ``setup.py build_sass`` command.
- Works also on PyPy.
- Provides prebuilt wheel_ binary for Windows.

.. _wheel: https://www.python.org/dev/peps/pep-0427/


Install
-------

It's available on PyPI_, so you can install it using ``pip`` (or
``easy_install``):

.. code-block:: console

   $ pip install libsass

.. note::

   libsass-python (and libsass) requires C++11 to compile.
   It means you need install GCC (G++) 4.3+, LLVM Clang 2.9+,
   or Visual Studio 2013+.

.. _PyPI: https://pypi.python.org/pypi/libsass


.. _example:

Example
-------

.. code-block:: pycon

   >>> import sass
   >>> print sass.compile(string='a { b { color: blue; } }')
   a b {
     color: blue; }


Docs
----

There's the user guide manual and the full API reference for ``libsass``:

http://hongminhee.org/libsass-python/

You can build the docs by yourself:

.. code-block:: console

   $ cd docs/
   $ make html

The built docs will go to ``docs/_build/html/`` directory.


Credit
------

Hong Minhee wrote this Python binding of Libsass_.

Hampton Catlin and Aaron Leung wrote Libsass_, which is portable C/C++
implementation of SASS_.

Hampton Catlin originally designed SASS_ language and wrote the first
reference implementation of it in Ruby.

The above three softwares are all distributed under `MIT license`_.

.. _MIT license: http://mit-license.org/


