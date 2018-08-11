""":mod:`sass` --- Binding of ``libsass``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

This simple C extension module provides a very simple binding of ``libsass``,
which is written in C/C++.  It contains only one function and one exception
type.

>>> import sass
>>> sass.compile(string='a { b { color: blue; } }')
'a b {\n  color: blue; }\n'

"""
from __future__ import absolute_import
import collections
import inspect
import os
import os.path
import re
import sys
import warnings

from six import string_types, text_type

from _sass import OUTPUT_STYLES, compile_filename, compile_string

__all__ = ('MODES', 'OUTPUT_STYLES', 'SOURCE_COMMENTS', 'CompileError',
           'SassColor', 'SassError', 'SassFunction', 'SassList', 'SassMap',
           'SassNumber', 'SassWarning', 'and_join', 'compile')
__version__ = '0.8.2'


#: (:class:`collections.Mapping`) The dictionary of output styles.
#: Keys are output name strings, and values are flag integers.
OUTPUT_STYLES = OUTPUT_STYLES

#: (:class:`collections.Mapping`) The dictionary of source comments styles.
#: Keys are mode names, and values are corresponding flag integers.
#:
#: .. versionadded:: 0.4.0
#:
#: .. deprecated:: 0.6.0
SOURCE_COMMENTS = {'none': 0, 'line_numbers': 1, 'default': 1, 'map': 2}

#: (:class:`collections.Set`) The set of keywords :func:`compile()` can take.
MODES = set(['string', 'filename', 'dirname'])


class CompileError(ValueError):
    """The exception type that is raised by :func:`compile()`.
    It is a subtype of :exc:`exceptions.ValueError`.
    """


def mkdirp(path):
    try:
        os.makedirs(path)
    except OSError:
        if os.path.isdir(path):
            return
        raise


class SassFunction(object):
    """Custom function for Sass.  It can be instantiated using
    :meth:`from_lambda()` and :meth:`from_named_function()` as well.

    :param name: the function name
    :type name: :class:`str`
    :param arguments: the argument names
    :type arguments: :class:`collections.Sequence`
    :param callable_: the actual function to be called
    :type callable_: :class:`collections.Callable`

    .. versionadded:: 0.7.0

    """

    __slots__ = 'name', 'arguments', 'callable_'

    @classmethod
    def from_lambda(cls, name, lambda_):
        """Make a :class:`SassFunction` object from the given ``lambda_``
        function.  Since lambda functions don't have their name, it need
        its ``name`` as well.  Arguments are automatically inspected.

        :param name: the function name
        :type name: :class:`str`
        :param lambda_: the actual lambda function to be called
        :type lambda_: :class:`types.LambdaType`
        :returns: a custom function wrapper of the ``lambda_`` function
        :rtype: :class:`SassFunction`

        """
        argspec = inspect.getargspec(lambda_)
        if argspec.varargs or argspec.keywords or argspec.defaults:
            raise TypeError(
                'functions cannot have starargs or defaults: {0} {1}'.format(
                    name, lambda_
                )
            )
        return cls(name, argspec.args, lambda_)

    @classmethod
    def from_named_function(cls, function):
        """Make a :class:`SassFunction` object from the named ``function``.
        Function name and arguments are automatically inspected.

        :param function: the named function to be called
        :type function: :class:`types.FunctionType`
        :returns: a custom function wrapper of the ``function``
        :rtype: :class:`SassFunction`

        """
        if not getattr(function, '__name__', ''):
            raise TypeError('function must be named')
        return cls.from_lambda(function.__name__, function)

    def __init__(self, name, arguments, callable_):
        if not isinstance(name, string_types):
            raise TypeError('name must be a string, not ' + repr(name))
        elif not isinstance(arguments, collections.Sequence):
            raise TypeError('arguments must be a sequence, not ' +
                            repr(arguments))
        elif not callable(callable_):
            raise TypeError(repr(callable_) + ' is not callable')
        self.name = name
        self.arguments = tuple(
            arg if arg.startswith('$') else '$' + arg
            for arg in arguments
        )
        self.callable_ = callable_

    @property
    def signature(self):
        """Signature string of the function."""
        return '{0}({1})'.format(self.name, ', '.join(self.arguments))

    def __call__(self, *args, **kwargs):
        return self.callable_(*args, **kwargs)

    def __str__(self):
        return self.signature


def compile_dirname(
    search_path, output_path, output_style, source_comments, include_paths,
    precision, custom_functions,
):
    fs_encoding = sys.getfilesystemencoding() or sys.getdefaultencoding()
    for dirpath, _, filenames in os.walk(search_path):
        filenames = [
            filename for filename in filenames
            if filename.endswith('.scss') and not filename.startswith('_')
        ]
        for filename in filenames:
            input_filename = os.path.join(dirpath, filename)
            relpath_to_file = os.path.relpath(input_filename, search_path)
            output_filename = os.path.join(output_path, relpath_to_file)
            output_filename = re.sub('.scss$', '.css', output_filename)
            input_filename = input_filename.encode(fs_encoding)
            s, v, _ = compile_filename(
                input_filename, output_style, source_comments, include_paths,
                precision, None, custom_functions,
            )
            if s:
                v = v.decode('UTF-8')
                mkdirp(os.path.dirname(output_filename))
                with open(output_filename, 'w') as output_file:
                    output_file.write(v)
            else:
                return False, v
    return True, None


def compile(**kwargs):
    """There are three modes of parameters :func:`compile()` can take:
    ``string``, ``filename``, and ``dirname``.

    The ``string`` parameter is the most basic way to compile SASS.
    It simply takes a string of SASS code, and then returns a compiled
    CSS string.

    :param string: SASS source code to compile.  it's exclusive to
                   ``filename`` and ``dirname`` parameters
    :type string: :class:`str`
    :param output_style: an optional coding style of the compiled result.
                         choose one of: ``'nested'`` (default), ``'expanded'``,
                         ``'compact'``, ``'compressed'``
    :type output_style: :class:`str`
    :param source_comments: whether to add comments about source lines.
                            :const:`False` by default
    :type source_comments: :class:`bool`
    :param include_paths: an optional list of paths to find ``@import``\ ed
                          SASS/CSS source files
    :type include_paths: :class:`collections.Sequence`, :class:`str`
    :param precision: optional precision for numbers. :const:`5` by default.
    :type precision: :class:`int`
    :param custom_functions: optional mapping of custom functions.
                             see also below `custom functions
                             <custom-functions>`_ description
    :type custom_functions: :class:`collections.Set`,
                            :class:`collections.Sequence`,
                            :class:`collections.Mapping`
    :returns: the compiled CSS string
    :rtype: :class:`str`
    :raises sass.CompileError: when it fails for any reason
                               (for example the given SASS has broken syntax)

    The ``filename`` is the most commonly used way.  It takes a string of
    SASS filename, and then returns a compiled CSS string.

    :param filename: the filename of SASS source code to compile.
                     it's exclusive to ``string`` and ``dirname`` parameters
    :type filename: :class:`str`
    :param output_style: an optional coding style of the compiled result.
                         choose one of: ``'nested'`` (default), ``'expanded'``,
                         ``'compact'``, ``'compressed'``
    :type output_style: :class:`str`
    :param source_comments: whether to add comments about source lines.
                            :const:`False` by default
    :type source_comments: :class:`bool`
    :param source_map_filename: use source maps and indicate the source map
                                output filename.  :const:`None` means not
                                using source maps.  :const:`None` by default.
                                note that it implies ``source_comments``
                                is also :const:`True`
    :type source_map_filename: :class:`str`
    :param include_paths: an optional list of paths to find ``@import``\ ed
                          SASS/CSS source files
    :type include_paths: :class:`collections.Sequence`, :class:`str`
    :param precision: optional precision for numbers. :const:`5` by default.
    :type precision: :class:`int`
    :param custom_functions: optional mapping of custom functions.
                             see also below `custom functions
                             <custom-functions>`_ description
    :type custom_functions: :class:`collections.Set`,
                            :class:`collections.Sequence`,
                            :class:`collections.Mapping`
    :returns: the compiled CSS string, or a pair of the compiled CSS string
              and the source map string if ``source_comments='map'``
    :rtype: :class:`str`, :class:`tuple`
    :raises sass.CompileError: when it fails for any reason
                               (for example the given SASS has broken syntax)
    :raises exceptions.IOError: when the ``filename`` doesn't exist or
                                cannot be read

    The ``dirname`` is useful for automation.  It takes a pair of paths.
    The first of the ``dirname`` pair refers the source directory, contains
    several SASS source files to compiled.  SASS source files can be nested
    in directories.  The second of the pair refers the output directory
    that compiled CSS files would be saved.  Directory tree structure of
    the source directory will be maintained in the output directory as well.
    If ``dirname`` parameter is used the function returns :const:`None`.

    :param dirname: a pair of ``(source_dir, output_dir)``.
                    it's exclusive to ``string`` and ``filename``
                    parameters
    :type dirname: :class:`tuple`
    :param output_style: an optional coding style of the compiled result.
                         choose one of: ``'nested'`` (default), ``'expanded'``,
                         ``'compact'``, ``'compressed'``
    :type output_style: :class:`str`
    :param source_comments: whether to add comments about source lines.
                            :const:`False` by default
    :type source_comments: :class:`bool`
    :param include_paths: an optional list of paths to find ``@import``\ ed
                          SASS/CSS source files
    :type include_paths: :class:`collections.Sequence`, :class:`str`
    :param precision: optional precision for numbers. :const:`5` by default.
    :type precision: :class:`int`
    :param custom_functions: optional mapping of custom functions.
                             see also below `custom functions
                             <custom-functions>`_ description
    :type custom_functions: :class:`collections.Set`,
                            :class:`collections.Sequence`,
                            :class:`collections.Mapping`
    :raises sass.CompileError: when it fails for any reason
                               (for example the given SASS has broken syntax)

    .. _custom-functions:

    The ``custom_functions`` parameter can take three types of forms:

    :class:`~collections.Set`/:class:`~collections.Sequence` of \
    :class:`SassFunction`\ s
       It is the most general form.  Although pretty verbose, it can take
       any kind of callables like type objects, unnamed functions,
       and user-defined callables.

       .. code-block:: python

          sass.compile(
              ...,
              custom_functions={
                  sass.SassFunction('func-name', ('$a', '$b'), some_callable),
                  ...
              }
          )

    :class:`~collections.Mapping` of names to functions
       Less general, but easier-to-use form.  Although it's not it can take
       any kind of callables, it can take any kind of *functions* defined
       using :keyword:`def`/:keyword:`lambda` syntax.
       It cannot take callables other than them since inspecting arguments
       is not always available for every kind of callables.

       .. code-block:: python

          sass.compile(
              ...,
              custom_functions={
                  'func-name': lambda a, b: ...,
                  ...
              }
          )

    :class:`~collections.Set`/:class:`~collections.Sequence` of \
    named functions
       Not general, but the easiest-to-use form for *named* functions.
       It can take only named functions, defined using :keyword:`def`.
       It cannot take lambdas sinc names are unavailable for them.

       .. code-block:: python

          def func_name(a, b):
              return ...

          sass.compile(
              ...,
              custom_functions={func_name}
          )

    .. versionadded:: 0.4.0
       Added ``source_comments`` and ``source_map_filename`` parameters.

    .. versionchanged:: 0.6.0
       The ``source_comments`` parameter becomes to take only :class:`bool`
       instead of :class:`str`.

    .. deprecated:: 0.6.0
       Values like ``'none'``, ``'line_numbers'``, and ``'map'`` for
       the ``source_comments`` parameter are deprecated.

    .. versionadded:: 0.7.0
       Added ``precision`` parameter.

    .. versionadded:: 0.7.0
       Added ``custom_functions`` parameter.

    """
    modes = set()
    for mode_name in MODES:
        if mode_name in kwargs:
            modes.add(mode_name)
    if not modes:
        raise TypeError('choose one at least in ' + and_join(MODES))
    elif len(modes) > 1:
        raise TypeError(and_join(modes) + ' are exclusive each other; '
                        'cannot be used at a time')
    precision = kwargs.pop('precision', 5)
    output_style = kwargs.pop('output_style', 'nested')
    if not isinstance(output_style, string_types):
        raise TypeError('output_style must be a string, not ' +
                        repr(output_style))
    try:
        output_style = OUTPUT_STYLES[output_style]
    except KeyError:
        raise CompileError('{0} is unsupported output_style; choose one of {1}'
                           ''.format(output_style, and_join(OUTPUT_STYLES)))
    source_comments = kwargs.pop('source_comments', False)
    if source_comments in SOURCE_COMMENTS:
        if source_comments == 'none':
            deprecation_message = ('you can simply pass False to '
                                   "source_comments instead of 'none'")
            source_comments = False
        elif source_comments in ('line_numbers', 'default'):
            deprecation_message = ('you can simply pass True to '
                                   "source_comments instead of " +
                                   repr(source_comments))
            source_comments = True
        else:
            deprecation_message = ("you don't have to pass 'map' to "
                                   'source_comments but just need to '
                                   'specify source_map_filename')
            source_comments = False
        warnings.warn(
            "values like 'none', 'line_numbers', and 'map' for "
            'the source_comments parameter are deprecated; ' +
            deprecation_message,
            DeprecationWarning
        )
    if not isinstance(source_comments, bool):
        raise TypeError('source_comments must be bool, not ' +
                        repr(source_comments))
    fs_encoding = sys.getfilesystemencoding() or sys.getdefaultencoding()
    source_map_filename = kwargs.pop('source_map_filename', None)
    if not (source_map_filename is None or
            isinstance(source_map_filename, string_types)):
        raise TypeError('source_map_filename must be a string, not ' +
                        repr(source_map_filename))
    elif isinstance(source_map_filename, text_type):
        source_map_filename = source_map_filename.encode(fs_encoding)
    if not ('filename' in modes or source_map_filename is None):
        raise CompileError('source_map_filename is only available with '
                           'filename= keyword argument since it has to be '
                           'aware of it')
    if source_map_filename is not None:
        source_comments = True
    try:
        include_paths = kwargs.pop('include_paths') or b''
    except KeyError:
        include_paths = b''
    else:
        if isinstance(include_paths, collections.Sequence):
            include_paths = os.pathsep.join(include_paths)
        elif not isinstance(include_paths, string_types):
            raise TypeError('include_paths must be a sequence of strings, or '
                            'a colon-separated (or semicolon-separated if '
                            'Windows) string, not ' + repr(include_paths))
        if isinstance(include_paths, text_type):
            include_paths = include_paths.encode(fs_encoding)

    custom_functions = kwargs.pop('custom_functions', ())
    if isinstance(custom_functions, collections.Mapping):
        custom_functions = [
            SassFunction.from_lambda(name, lambda_)
            for name, lambda_ in custom_functions.items()
        ]
    elif isinstance(custom_functions, (collections.Set, collections.Sequence)):
        custom_functions = [
            func if isinstance(func, SassFunction)
                 else SassFunction.from_named_function(func)
            for func in custom_functions
        ]
    else:
        raise TypeError(
            'custom_functions must be one of:\n'
            '- a set/sequence of {0.__module__}.{0.__name__} objects,\n'
            '- a mapping of function name strings to lambda functions,\n'
            '- a set/sequence of named functions,\n'
            'not {1!r}'.format(SassFunction, custom_functions)
        )

    if 'string' in modes:
        string = kwargs.pop('string')
        if isinstance(string, text_type):
            string = string.encode('utf-8')
        s, v = compile_string(
            string, output_style, source_comments, include_paths, precision,
            custom_functions,
        )
        if s:
            return v.decode('utf-8')
    elif 'filename' in modes:
        filename = kwargs.pop('filename')
        if not isinstance(filename, string_types):
            raise TypeError('filename must be a string, not ' + repr(filename))
        elif not os.path.isfile(filename):
            raise IOError('{0!r} seems not a file'.format(filename))
        elif isinstance(filename, text_type):
            filename = filename.encode(fs_encoding)
        s, v, source_map = compile_filename(
            filename, output_style, source_comments, include_paths, precision,
            source_map_filename, custom_functions,
        )
        if s:
            v = v.decode('utf-8')
            if source_map_filename:
                source_map = source_map.decode('utf-8')
                if os.sep != '/' and os.altsep:
                    # Libsass has a bug that produces invalid JSON string
                    # literals which contain unescaped backslashes for
                    # "sources" paths on Windows e.g.:
                    #
                    #   {
                    #     "version": 3,
                    #     "file": "",
                    #     "sources": ["c:\temp\tmpj2ac07\test\b.scss"],
                    #     "names": [],
                    #     "mappings": "AAAA,EAAE;EAEE,WAAW"
                    #   }
                    #
                    # To workaround this bug without changing libsass'
                    # internal behavior, we replace these backslashes with
                    # slashes e.g.:
                    #
                    #   {
                    #     "version": 3,
                    #     "file": "",
                    #     "sources": ["c:/temp/tmpj2ac07/test/b.scss"],
                    #     "names": [],
                    #     "mappings": "AAAA,EAAE;EAEE,WAAW"
                    #   }
                    source_map = re.sub(
                        r'"sources":\s*\[\s*"[^"]*"(?:\s*,\s*"[^"]*")*\s*\]',
                        lambda m: m.group(0).replace(os.sep, os.altsep),
                        source_map
                    )
                v = v, source_map
            return v
    elif 'dirname' in modes:
        try:
            search_path, output_path = kwargs.pop('dirname')
        except ValueError:
            raise ValueError('dirname must be a pair of (source_dir, '
                             'output_dir)')
        s, v = compile_dirname(
            search_path, output_path, output_style, source_comments,
            include_paths, precision, custom_functions,
        )
        if s:
            return
    else:
        raise TypeError('something went wrong')
    assert not s
    raise CompileError(v)


def and_join(strings):
    """Join the given ``strings`` by commas with last `' and '` conjuction.

    >>> and_join(['Korea', 'Japan', 'China', 'Taiwan'])
    'Korea, Japan, China, and Taiwan'

    :param strings: a list of words to join
    :type string: :class:`collections.Sequence`
    :returns: a joined string
    :rtype: :class:`str`, :class:`basestring`

    """
    last = len(strings) - 1
    if last == 0:
        return strings[0]
    elif last < 0:
        return ''
    iterator = enumerate(strings)
    return ', '.join('and ' + s if i == last else s for i, s in iterator)


"""
This module provides datatypes to be used in custom sass functions.

The following mappings from sass types to python types are used:

SASS_NULL: ``None``
SASS_BOOLEAN: ``True`` or ``False``
SASS_STRING: class:`str`
SASS_NUMBER: class:`SassNumber`
SASS_COLOR: class:`SassColor`
SASS_LIST: class:`SassList`
SASS_MAP: class:`dict` or class:`SassMap`
SASS_ERROR: class:`SassError`
SASS_WARNING: class:`SassWarning`
"""


class SassNumber(collections.namedtuple('SassNumber', ('value', 'unit'))):

    def __new__(cls, value, unit):
        value = float(value)
        if not isinstance(unit, text_type):
            unit = unit.decode('UTF-8')
        return super(SassNumber, cls).__new__(cls, value, unit)


class SassColor(collections.namedtuple('SassColor', ('r', 'g', 'b', 'a'))):

    def __new__(cls, r, g, b, a):
        r = float(r)
        g = float(g)
        b = float(b)
        a = float(a)
        return super(SassColor, cls).__new__(cls, r, g, b, a)


SASS_SEPARATOR_COMMA = collections.namedtuple('SASS_SEPARATOR_COMMA', ())()
SASS_SEPARATOR_SPACE = collections.namedtuple('SASS_SEPARATOR_SPACE', ())()
SEPARATORS = frozenset((SASS_SEPARATOR_COMMA, SASS_SEPARATOR_SPACE))


class SassList(collections.namedtuple('SassList', ('items', 'separator'))):

    def __new__(cls, items, separator):
        items = tuple(items)
        assert separator in SEPARATORS
        return super(SassList, cls).__new__(cls, items, separator)


class SassError(collections.namedtuple('SassError', ('msg',))):

    def __new__(cls, msg):
        if not isinstance(msg, text_type):
            msg = msg.decode('UTF-8')
        return super(SassError, cls).__new__(cls, msg)


class SassWarning(collections.namedtuple('SassWarning', ('msg',))):

    def __new__(cls, msg):
        if not isinstance(msg, text_type):
            msg = msg.decode('UTF-8')
        return super(SassWarning, cls).__new__(cls, msg)


class SassMap(collections.Mapping):
    """Because sass maps can have mapping types as keys, we need an immutable
    hashable mapping type.

    .. versionadded:: 0.7.0

    """

    __slots__ = '_dict', '_hash'

    def __init__(self, *args, **kwargs):
        self._dict = dict(*args, **kwargs)
        # An assertion that all things are hashable
        self._hash = hash(frozenset(self._dict.items()))

    # Mapping interface

    def __getitem__(self, key):
        return self._dict[key]

    def __iter__(self):
        return iter(self._dict)

    def __len__(self):
        return len(self._dict)

    # Our interface

    def __repr__(self):
        return '{0}({1})'.format(type(self).__name__, frozenset(self.items()))

    def __hash__(self):
        return self._hash

    def _immutable(self, *_):
        raise TypeError('SassMaps are immutable.')

    __setitem__ = __delitem__ = _immutable
