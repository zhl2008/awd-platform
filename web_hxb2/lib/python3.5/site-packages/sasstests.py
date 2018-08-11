# -*- coding: utf-8 -*-
from __future__ import with_statement

import collections
import contextlib
import glob
import json
import os
import os.path
import re
import shutil
import subprocess
import sys
import tempfile
import unittest
import warnings

from six import PY3, StringIO, b, string_types, text_type
from werkzeug.test import Client
from werkzeug.wrappers import Response

import sass
import sassc
from sassutils.builder import Manifest, build_directory
from sassutils.wsgi import SassMiddleware


if os.sep != '/' and os.altsep:
    def normalize_path(path):
        path = os.path.abspath(os.path.normpath(path))
        return path.replace(os.sep, os.altsep)
else:
    def normalize_path(path):
        return path


A_EXPECTED_CSS = '''\
body {
  background-color: green; }
  body a {
    color: blue; }
'''

A_EXPECTED_CSS_WITH_MAP = '''\
/* line 6, SOURCE */
body {
  background-color: green; }
  /* line 8, SOURCE */
  body a {
    color: blue; }

/*# sourceMappingURL=../a.scss.css.map */'''

A_EXPECTED_MAP = {
    'version': 3,
    'file': 'test/a.css',
    'sources': ['test/a.scss'],
    'sourcesContent': [],
    'names': [],
    'mappings': ';AAKA,IAAI,CAAC;EAHH,gBAAgB,EAAE,KAAM,GAGpB;;EAEJ,IAAI,CAAC,CAAC,CAAJ;IACA,KAAK,EAAE,IAAK,GADX',
}

B_EXPECTED_CSS = '''\
b i {
  font-size: 20px; }
'''

B_EXPECTED_CSS_WITH_MAP = '''\
/* line 2, SOURCE */
b i {
  font-size: 20px; }

/*# sourceMappingURL=../css/b.scss.css.map */'''

C_EXPECTED_CSS = '''\
body {
  background-color: green; }
  body a {
    color: blue; }

h1 a {
  color: green; }
'''

D_EXPECTED_CSS = '''\
@charset "UTF-8";
body {
  background-color: green; }
  body a {
    font: '나눔고딕', sans-serif; }
'''

D_EXPECTED_CSS_WITH_MAP = '''\
@charset "UTF-8";
/* line 6, SOURCE */
body {
  background-color: green; }
  /* line 8, SOURCE */
  body a {
    font: '나눔고딕', sans-serif; }

/*# sourceMappingURL=../css/d.scss.css.map */'''

E_EXPECTED_CSS = '''\
a {
  color: red; }
'''

G_EXPECTED_CSS = '''\
body {
  font: 100% Helvetica, sans-serif;
  color: #333;
  height: 1.42857; }
'''

G_EXPECTED_CSS_WITH_PRECISION_8 = '''\
body {
  font: 100% Helvetica, sans-serif;
  color: #333;
  height: 1.42857143; }
'''

SUBDIR_RECUR_EXPECTED_CSS = '''\
body p {
  color: blue; }
'''

utf8_if_py3 = {'encoding': 'utf-8'} if PY3 else {}


class BaseTestCase(unittest.TestCase):

    def assert_json_file(self, expected, filename):
        with open(filename) as f:
            try:
                tree = json.load(f)
            except ValueError as e:
                f.seek(0)
                msg = '{0!s}\n\n{1}:\n\n{2}'.format(e, filename, f.read())
                raise ValueError(msg)
        self.assertEqual(expected, tree)

    def assert_source_map_equal(self, expected, actual, *args, **kwargs):
        if isinstance(expected, string_types):
            expected = json.loads(expected)
        if isinstance(actual, string_types):
            actual = json.loads(actual)
        if sys.platform == 'win32':
            # On Windows the result of "mappings" is strange;
            # seems a bug of libsass itself
            expected.pop('mappings', None)
            actual.pop('mappings', None)
        self.assertEqual(expected, actual, *args, **kwargs)

    def assert_source_map_file(self, expected, filename):
        with open(filename) as f:
            try:
                tree = json.load(f)
            except ValueError as e:
                f.seek(0)
                msg = '{0!s}\n\n{1}:\n\n{2}'.format(e, filename, f.read())
                raise ValueError(msg)
        self.assert_source_map_equal(expected, tree)


class SassTestCase(BaseTestCase):

    def test_version(self):
        assert re.match(r'^\d+\.\d+\.\d+$', sass.__version__)

    def test_output_styles(self):
        if hasattr(collections, 'Mapping'):
            assert isinstance(sass.OUTPUT_STYLES, collections.Mapping)
        assert 'nested' in sass.OUTPUT_STYLES

    def test_and_join(self):
        self.assertEqual(
            'Korea, Japan, China, and Taiwan',
            sass.and_join(['Korea', 'Japan', 'China', 'Taiwan'])
        )
        self.assertEqual(
            'Korea, and Japan',
            sass.and_join(['Korea', 'Japan'])
        )
        self.assertEqual('Korea', sass.and_join(['Korea']))
        self.assertEqual('', sass.and_join([]))


class CompileTestCase(BaseTestCase):

    def test_compile_required_arguments(self):
        self.assertRaises(TypeError, sass.compile)

    def test_compile_takes_only_keywords(self):
        self.assertRaises(TypeError, sass.compile, 'a { color: blue; }')

    def test_compile_exclusive_arguments(self):
        self.assertRaises(TypeError, sass.compile,
                          string='a { color: blue; }', filename='test/a.scss')
        self.assertRaises(TypeError, sass.compile,
                          string='a { color: blue; }', dirname='test/')
        self.assertRaises(TypeError,  sass.compile,
                          filename='test/a.scss', dirname='test/')

    def test_compile_invalid_output_style(self):
        self.assertRaises(TypeError, sass.compile,
                          string='a { color: blue; }',
                          output_style=['compact'])
        self.assertRaises(TypeError,  sass.compile,
                          string='a { color: blue; }', output_style=123j)
        self.assertRaises(ValueError,  sass.compile,
                          string='a { color: blue; }', output_style='invalid')

    def test_compile_invalid_source_comments(self):
        self.assertRaises(TypeError, sass.compile,
                          string='a { color: blue; }',
                          source_comments=['line_numbers'])
        self.assertRaises(TypeError,  sass.compile,
                          string='a { color: blue; }', source_comments=123j)
        self.assertRaises(TypeError,  sass.compile,
                          string='a { color: blue; }',
                          source_comments='invalid')

    def test_compile_string(self):
        actual = sass.compile(string='a { b { color: blue; } }')
        assert actual == 'a b {\n  color: blue; }\n'
        commented = sass.compile(string='''a {
            b { color: blue; }
            color: red;
        }''', source_comments=True)
        assert commented == '''/* line 1, stdin */
a {
  color: red; }
  /* line 2, stdin */
  a b {
    color: blue; }
'''
        actual = sass.compile(string=u'a { color: blue; } /* 유니코드 */')
        self.assertEqual(
            u'''@charset "UTF-8";
a {
  color: blue; }

/* 유니코드 */
''',
            actual
        )
        self.assertRaises(sass.CompileError, sass.compile,
                          string='a { b { color: blue; }')
        # sass.CompileError should be a subtype of ValueError
        self.assertRaises(ValueError, sass.compile,
                          string='a { b { color: blue; }')
        self.assertRaises(TypeError, sass.compile, string=1234)
        self.assertRaises(TypeError, sass.compile, string=[])

    def test_compile_string_deprecated_source_comments_line_numbers(self):
        source = '''a {
            b { color: blue; }
            color: red;
        }'''
        expected = sass.compile(string=source, source_comments=True)
        with warnings.catch_warnings(record=True) as w:
            warnings.simplefilter('always')
            actual = sass.compile(string=source,
                                  source_comments='line_numbers')
            self.assertEqual(1, len(w))
            assert issubclass(w[-1].category, DeprecationWarning)
        self.assertEqual(expected, actual)

    def test_compile_filename(self):
        actual = sass.compile(filename='test/a.scss')
        assert actual == A_EXPECTED_CSS
        actual = sass.compile(filename='test/c.scss')
        assert actual == C_EXPECTED_CSS
        actual = sass.compile(filename='test/d.scss')
        if text_type is str:
            self.assertEqual(D_EXPECTED_CSS, actual)
        else:
            self.assertEqual(D_EXPECTED_CSS.decode('utf-8'), actual)
        actual = sass.compile(filename='test/e.scss')
        assert actual == E_EXPECTED_CSS
        self.assertRaises(IOError, sass.compile,
                          filename='test/not-exist.sass')
        self.assertRaises(TypeError, sass.compile, filename=1234)
        self.assertRaises(TypeError, sass.compile, filename=[])

    def test_compile_source_map(self):
        filename = 'test/a.scss'
        actual, source_map = sass.compile(
            filename=filename,
            source_map_filename='a.scss.css.map'
        )
        self.assertEqual(
            A_EXPECTED_CSS_WITH_MAP.replace(
                'SOURCE',
                normalize_path(os.path.abspath(filename))
            ),
            actual
        )
        self.assert_source_map_equal(A_EXPECTED_MAP, source_map)

    def test_compile_source_map_deprecated_source_comments_map(self):
        filename = 'test/a.scss'
        expected, expected_map = sass.compile(
            filename=filename,
            source_map_filename='a.scss.css.map'
        )
        with warnings.catch_warnings(record=True) as w:
            warnings.simplefilter('always')
            actual, actual_map = sass.compile(
                filename=filename,
                source_comments='map',
                source_map_filename='a.scss.css.map'
            )
            self.assertEqual(1, len(w))
            assert issubclass(w[-1].category, DeprecationWarning)
        self.assertEqual(expected, actual)
        self.assert_source_map_equal(expected_map, actual_map)

    def test_compile_with_precision(self):
        actual = sass.compile(filename='test/g.scss')
        assert actual == G_EXPECTED_CSS
        actual = sass.compile(filename='test/g.scss', precision=8)
        assert actual == G_EXPECTED_CSS_WITH_PRECISION_8

    def test_regression_issue_2(self):
        actual = sass.compile(string='''
            @media (min-width: 980px) {
                a {
                    color: red;
                }
            }
        ''')
        normalized = re.sub(r'\s+', '', actual)
        assert normalized == '@media(min-width:980px){a{color:red;}}'

    def test_regression_issue_11(self):
        actual = sass.compile(string='''
            $foo: 3;
            @media (max-width: $foo) {
                body { color: black; }
            }
        ''')
        normalized = re.sub(r'\s+', '', actual)
        assert normalized == '@media(max-width:3){body{color:black;}}'


class BuilderTestCase(BaseTestCase):

    def setUp(self):
        self.temp_path = tempfile.mkdtemp()
        self.sass_path = os.path.join(self.temp_path, 'sass')
        self.css_path = os.path.join(self.temp_path, 'css')
        shutil.copytree('test', self.sass_path)

    def tearDown(self):
        shutil.rmtree(self.temp_path)

    def test_builder_build_directory(self):
        css_path = self.css_path
        result_files = build_directory(self.sass_path, css_path)
        self.assertEqual(7, len(result_files))
        self.assertEqual('a.scss.css', result_files['a.scss'])
        with open(os.path.join(css_path, 'a.scss.css'), **utf8_if_py3) as f:
            css = f.read()
        self.assertEqual(A_EXPECTED_CSS, css)
        self.assertEqual('b.scss.css', result_files['b.scss'])
        with open(os.path.join(css_path, 'b.scss.css'), **utf8_if_py3) as f:
            css = f.read()
        self.assertEqual(B_EXPECTED_CSS, css)
        self.assertEqual('c.scss.css', result_files['c.scss'])
        with open(os.path.join(css_path, 'c.scss.css'), **utf8_if_py3) as f:
            css = f.read()
        self.assertEqual(C_EXPECTED_CSS, css)
        self.assertEqual('d.scss.css', result_files['d.scss'])
        with open(os.path.join(css_path, 'd.scss.css'), **utf8_if_py3) as f:
            css = f.read()
        self.assertEqual(D_EXPECTED_CSS, css)
        self.assertEqual('e.scss.css', result_files['e.scss'])
        with open(os.path.join(css_path, 'e.scss.css'), **utf8_if_py3) as f:
            css = f.read()
        self.assertEqual(E_EXPECTED_CSS, css)
        self.assertEqual(
            os.path.join('subdir', 'recur.scss.css'),
            result_files[os.path.join('subdir', 'recur.scss')]
        )
        with open(os.path.join(css_path, 'g.scss.css'), **utf8_if_py3) as f:
            css = f.read()
        self.assertEqual(G_EXPECTED_CSS, css)
        self.assertEqual(
            os.path.join('subdir', 'recur.scss.css'),
            result_files[os.path.join('subdir', 'recur.scss')]
        )
        with open(os.path.join(css_path, 'subdir', 'recur.scss.css'),
                  **utf8_if_py3) as f:
            css = f.read()
        self.assertEqual(SUBDIR_RECUR_EXPECTED_CSS, css)

    def test_output_style(self):
        css_path = self.css_path
        result_files = build_directory(self.sass_path, css_path,
                                       output_style='compressed')
        self.assertEqual(7, len(result_files))
        self.assertEqual('a.scss.css', result_files['a.scss'])
        with open(os.path.join(css_path, 'a.scss.css'), **utf8_if_py3) as f:
            css = f.read()
        self.assertEqual('body{background-color:green}body a{color:blue}\n',
                         css)


class ManifestTestCase(BaseTestCase):

    def test_normalize_manifests(self):
        manifests = Manifest.normalize_manifests({
            'package': 'sass/path',
            'package.name': ('sass/path', 'css/path'),
            'package.name2': Manifest('sass/path', 'css/path')
        })
        assert len(manifests) == 3
        assert isinstance(manifests['package'], Manifest)
        assert manifests['package'].sass_path == 'sass/path'
        assert manifests['package'].css_path == 'sass/path'
        assert isinstance(manifests['package.name'], Manifest)
        assert manifests['package.name'].sass_path == 'sass/path'
        assert manifests['package.name'].css_path == 'css/path'
        assert isinstance(manifests['package.name2'], Manifest)
        assert manifests['package.name2'].sass_path == 'sass/path'
        assert manifests['package.name2'].css_path == 'css/path'

    def test_build_one(self):
        d = tempfile.mkdtemp()
        src_path = os.path.join(d, 'test')
        test_source_path = lambda *path: normalize_path(
            os.path.join(d, 'test', *path)
        )
        replace_source_path = lambda s, name: s.replace(
            'SOURCE',
            test_source_path(name)
        )
        try:
            shutil.copytree('test', src_path)
            m = Manifest(sass_path='test', css_path='css')
            m.build_one(d, 'a.scss')
            with open(os.path.join(d, 'css', 'a.scss.css')) as f:
                self.assertEqual(A_EXPECTED_CSS, f.read())
            m.build_one(d, 'b.scss', source_map=True)
            with open(os.path.join(d, 'css', 'b.scss.css'),
                      **utf8_if_py3) as f:
                self.assertEqual(
                    replace_source_path(B_EXPECTED_CSS_WITH_MAP, 'b.scss'),
                    f.read()
                )
            self.assert_source_map_file(
                {
                    'version': 3,
                    'file': '../test/b.css',
                    'sources': ['../test/b.scss'],
                    'sourcesContent': [],
                    'names': [],
                    'mappings': ';AACE,CAAC,CAAC,CAAC,CAAD;EACA,SAAS,EAAE,IAAK,GADf',
                },
                os.path.join(d, 'css', 'b.scss.css.map')
            )
            m.build_one(d, 'd.scss', source_map=True)
            with open(os.path.join(d, 'css', 'd.scss.css'),
                      **utf8_if_py3) as f:
                self.assertEqual(
                    replace_source_path(D_EXPECTED_CSS_WITH_MAP, 'd.scss'),
                    f.read()
                )
            self.assert_source_map_file(
                {
                    'version': 3,
                    'file': '../test/d.css',
                    'sources': ['../test/d.scss'],
                    'sourcesContent': [],
                    'names': [],
                    'mappings': ';;AAKA,IAAI,CAAC;EAHH,gBAAgB,EAAE,KAAM,GAGpB;;EAEJ,IAAI,CAAC,CAAC,CAAJ;IACA,IAAI,EAAE,0BAA2B,GADhC',
                },
                os.path.join(d, 'css', 'd.scss.css.map')
            )
        finally:
            shutil.rmtree(d)


class WsgiTestCase(BaseTestCase):

    @staticmethod
    def sample_wsgi_app(environ, start_response):
        start_response('200 OK', [('Content-Type', 'text/plain')])
        return environ['PATH_INFO'],

    def test_wsgi_sass_middleware(self):
        css_dir = tempfile.mkdtemp()
        src_dir = os.path.join(css_dir, 'src')
        shutil.copytree('test', src_dir)
        try:
            app = SassMiddleware(self.sample_wsgi_app, {
                __name__: (src_dir, css_dir, '/static')
            })
            client = Client(app, Response)
            r = client.get('/asdf')
            self.assertEqual(200, r.status_code)
            self.assert_bytes_equal(b'/asdf', r.data)
            self.assertEqual('text/plain', r.mimetype)
            r = client.get('/static/a.scss.css')
            self.assertEqual(200, r.status_code)
            src_path = normalize_path(os.path.join(src_dir, 'a.scss'))
            self.assert_bytes_equal(
                b(A_EXPECTED_CSS_WITH_MAP.replace('SOURCE', src_path)),
                r.data
            )
            self.assertEqual('text/css', r.mimetype)
            r = client.get('/static/not-exists.sass.css')
            self.assertEqual(200, r.status_code)
            self.assert_bytes_equal(b'/static/not-exists.sass.css', r.data)
            self.assertEqual('text/plain', r.mimetype)
        finally:
            shutil.rmtree(css_dir)

    def assert_bytes_equal(self, expected, actual, *args):
        self.assertEqual(expected.replace(b'\r\n', b'\n'),
                         actual.replace(b'\r\n', b'\n'),
                         *args)


class DistutilsTestCase(BaseTestCase):

    def tearDown(self):
        for filename in self.list_built_css():
            os.remove(filename)

    def css_path(self, *args):
        return os.path.join(
            os.path.dirname(__file__),
            'testpkg', 'testpkg', 'static', 'css',
            *args
        )

    def list_built_css(self):
        return glob.glob(self.css_path('*.scss.css'))

    def build_sass(self, *args):
        testpkg_path = os.path.join(os.path.dirname(__file__), 'testpkg')
        return subprocess.call(
            [sys.executable, 'setup.py', 'build_sass'] + list(args),
            cwd=os.path.abspath(testpkg_path)
        )

    def test_build_sass(self):
        rv = self.build_sass()
        self.assertEqual(0, rv)
        self.assertEqual(
            ['a.scss.css'],
            list(map(os.path.basename, self.list_built_css()))
        )
        with open(self.css_path('a.scss.css')) as f:
            self.assertEqual(
                'p a {\n  color: red; }\n\np b {\n  color: blue; }\n',
                f.read()
            )

    def test_output_style(self):
        rv = self.build_sass('--output-style', 'compressed')
        self.assertEqual(0, rv)
        with open(self.css_path('a.scss.css')) as f:
            self.assertEqual(
                'p a{color:red}p b{color:blue}\n',
                f.read()
            )


class SasscTestCase(BaseTestCase):

    def setUp(self):
        self.out = StringIO()
        self.err = StringIO()

    def test_no_args(self):
        exit_code = sassc.main(['sassc', ], self.out, self.err)
        self.assertEqual(2, exit_code)
        err = self.err.getvalue()
        assert err.strip().endswith('error: too few arguments'), \
               'actual error message is: ' + repr(err)
        self.assertEqual('', self.out.getvalue())

    def test_three_args(self):
        exit_code = sassc.main(
            ['sassc', 'a.scss', 'b.scss', 'c.scss'],
            self.out, self.err
        )
        self.assertEqual(2, exit_code)
        err = self.err.getvalue()
        assert err.strip().endswith('error: too many arguments'), \
               'actual error message is: ' + repr(err)
        self.assertEqual('', self.out.getvalue())

    def test_sassc_stdout(self):
        exit_code = sassc.main(['sassc', 'test/a.scss'], self.out, self.err)
        self.assertEqual(0, exit_code)
        self.assertEqual('', self.err.getvalue())
        self.assertEqual(A_EXPECTED_CSS.strip(), self.out.getvalue().strip())

    def test_sassc_output(self):
        fd, tmp = tempfile.mkstemp('.css')
        try:
            os.close(fd)
            exit_code = sassc.main(['sassc', 'test/a.scss', tmp],
                                   self.out, self.err)
            self.assertEqual(0, exit_code)
            self.assertEqual('', self.err.getvalue())
            self.assertEqual('', self.out.getvalue())
            with open(tmp) as f:
                self.assertEqual(A_EXPECTED_CSS.strip(), f.read().strip())
        finally:
            os.remove(tmp)

    def test_sassc_output_unicode(self):
        fd, tmp = tempfile.mkstemp('.css')
        try:
            os.close(fd)
            exit_code = sassc.main(['sassc', 'test/d.scss', tmp],
                                   self.out, self.err)
            self.assertEqual(0, exit_code)
            self.assertEqual('', self.err.getvalue())
            self.assertEqual('', self.out.getvalue())
            with open(tmp, **utf8_if_py3) as f:
                self.assertEqual(
                    D_EXPECTED_CSS.strip(),
                    f.read().strip()
                )
        finally:
            os.remove(tmp)

    def test_sassc_source_map_without_css_filename(self):
        exit_code = sassc.main(['sassc', '-m', 'a.scss'], self.out, self.err)
        self.assertEqual(2, exit_code)
        err = self.err.getvalue()
        assert err.strip().endswith('error: -m/-g/--sourcemap requires '
                                    'the second argument, the output css '
                                    'filename.'), \
               'actual error message is: ' + repr(err)
        self.assertEqual('', self.out.getvalue())

    def test_sassc_sourcemap(self):
        tmp_dir = tempfile.mkdtemp()
        src_dir = os.path.join(tmp_dir, 'test')
        shutil.copytree('test', src_dir)
        src_filename = os.path.join(src_dir, 'a.scss')
        out_filename = os.path.join(tmp_dir, 'a.scss.css')
        try:
            exit_code = sassc.main(
                ['sassc', '-m', src_filename, out_filename],
                self.out, self.err
            )
            self.assertEqual(0, exit_code)
            self.assertEqual('', self.err.getvalue())
            self.assertEqual('', self.out.getvalue())
            with open(out_filename) as f:
                self.assertEqual(
                    A_EXPECTED_CSS_WITH_MAP.replace(
                        'SOURCE', normalize_path(src_filename)
                    ),
                    f.read().strip()
                )
            with open(out_filename + '.map') as f:
                self.assert_source_map_equal(
                    dict(A_EXPECTED_MAP, sources=None),
                    dict(json.load(f), sources=None)
                )
        finally:
            shutil.rmtree(tmp_dir)


@contextlib.contextmanager
def tempdir():
    tmpdir = tempfile.mkdtemp()
    try:
        yield tmpdir
    finally:
        shutil.rmtree(tmpdir)


def write_file(filename, contents):
    with open(filename, 'w') as f:
        f.write(contents)


class CompileDirectoriesTest(unittest.TestCase):

    def test_successful(self):
        with tempdir() as tmpdir:
            input_dir = os.path.join(tmpdir, 'input')
            output_dir = os.path.join(tmpdir, 'output')
            os.makedirs(os.path.join(input_dir, 'foo'))
            write_file(os.path.join(input_dir, 'f1.scss'), 'a { b { width: 100%; } }')
            write_file(os.path.join(input_dir, 'foo/f2.scss'), 'foo { width: 100%; }')
            # Make sure we don't compile non-scss files
            write_file(os.path.join(input_dir, 'baz.txt'), 'Hello der')

            sass.compile(dirname=(input_dir, output_dir))
            assert os.path.exists(output_dir)
            assert os.path.exists(os.path.join(output_dir, 'foo'))
            assert os.path.exists(os.path.join(output_dir, 'f1.css'))
            assert os.path.exists(os.path.join(output_dir, 'foo/f2.css'))
            assert not os.path.exists(os.path.join(output_dir, 'baz.txt'))

            contentsf1 = open(os.path.join(output_dir, 'f1.css')).read()
            contentsf2 = open(os.path.join(output_dir, 'foo/f2.css')).read()
            self.assertEqual(contentsf1, 'a b {\n  width: 100%; }\n')
            self.assertEqual(contentsf2, 'foo {\n  width: 100%; }\n')

    def test_ignores_underscored_files(self):
        with tempdir() as tmpdir:
            input_dir = os.path.join(tmpdir, 'input')
            output_dir = os.path.join(tmpdir, 'output')
            os.mkdir(input_dir)
            write_file(os.path.join(input_dir, 'f1.scss'), '@import "f2";')
            write_file(os.path.join(input_dir, '_f2.scss'), 'a{color:red}')

            sass.compile(dirname=(input_dir, output_dir))
            assert not os.path.exists(os.path.join(output_dir, '_f2.css'))

    def test_error(self):
        with tempdir() as tmpdir:
            input_dir = os.path.join(tmpdir, 'input')
            os.makedirs(input_dir)
            write_file(os.path.join(input_dir, 'bad.scss'), 'a {')

            try:
                sass.compile(dirname=(input_dir, os.path.join(tmpdir, 'output')))
                assert False, 'Expected to raise'
            except sass.CompileError as e:
                msg, = e.args
                assert msg.decode('UTF-8').startswith(
                    'Error: invalid property name'
                ), msg
                return
            except Exception as e:
                assert False, 'Expected to raise CompileError but got {0!r}'.format(e)


class SassFunctionTest(unittest.TestCase):

    def test_from_lambda(self):
        lambda_ = lambda abc, d: None
        sf = sass.SassFunction.from_lambda('func_name', lambda_)
        self.assertEqual('func_name', sf.name)
        self.assertEqual(('$abc', '$d'), sf.arguments)
        assert sf.callable_ is lambda_

    def test_from_named_function(self):
        sf = sass.SassFunction.from_named_function(identity)
        self.assertEqual('identity', sf.name)
        self.assertEqual(('$x',), sf.arguments)
        assert sf.callable_ is identity

    def test_sigature(self):
        sf = sass.SassFunction(
            'func-name',
            ('$a', '$bc', '$d'),
            lambda a, bc, d: None
        )
        self.assertEqual('func-name($a, $bc, $d)', sf.signature)
        self.assertEqual(sf.signature, str(sf))

    def test_raises_typeerror_kwargs(self):
        self.assertRaises(
            TypeError,
            sass.SassFunction.from_lambda,
            lambda bar='womp': 'baz'
        )

    def test_raises_typerror_star_kwargs(self):
        self.assertRaises(
            TypeError,
            sass.SassFunction.from_lambda,
            lambda *args: 'baz'
        )

    def test_raises_typeerror_star_kwargs(self):
        self.assertRaises(
            TypeError,
            sass.SassFunction.from_lambda,
            lambda *kwargs: 'baz'
        )


class SassTypesTest(unittest.TestCase):
    def test_number_no_conversion(self):
        num = sass.SassNumber(123., u'px')
        assert type(num.value) is float, type(num.value)
        assert type(num.unit) is text_type, type(num.unit)

    def test_number_conversion(self):
        num = sass.SassNumber(123, b'px')
        assert type(num.value) is float, type(num.value)
        assert type(num.unit) is text_type, type(num.unit)

    def test_color_no_conversion(self):
        color = sass.SassColor(1., 2., 3., .5)
        assert type(color.r) is float, type(color.r)
        assert type(color.g) is float, type(color.g)
        assert type(color.b) is float, type(color.b)
        assert type(color.a) is float, type(color.a)

    def test_color_conversion(self):
        color = sass.SassColor(1, 2, 3, 1)
        assert type(color.r) is float, type(color.r)
        assert type(color.g) is float, type(color.g)
        assert type(color.b) is float, type(color.b)
        assert type(color.a) is float, type(color.a)

    def test_sass_list_no_conversion(self):
        lst = sass.SassList(
            ('foo', 'bar'), sass.SASS_SEPARATOR_COMMA,
        )
        assert type(lst.items) is tuple, type(lst.items)
        assert lst.separator is sass.SASS_SEPARATOR_COMMA, lst.separator

    def test_sass_list_conversion(self):
        lst = sass.SassList(
            ['foo', 'bar'], sass.SASS_SEPARATOR_SPACE,
        )
        assert type(lst.items) is tuple, type(lst.items)
        assert lst.separator is sass.SASS_SEPARATOR_SPACE, lst.separator

    def test_sass_warning_no_conversion(self):
        warn = sass.SassWarning(u'error msg')
        assert type(warn.msg) is text_type, type(warn.msg)

    def test_sass_warning_no_conversion(self):
        warn = sass.SassWarning(b'error msg')
        assert type(warn.msg) is text_type, type(warn.msg)

    def test_sass_error_no_conversion(self):
        err = sass.SassError(u'error msg')
        assert type(err.msg) is text_type, type(err.msg)

    def test_sass_error_conversion(self):
        err = sass.SassError(b'error msg')
        assert type(err.msg) is text_type, type(err.msg)


def raises():
    raise AssertionError('foo')


def returns_warning():
    return sass.SassWarning('This is a warning')


def returns_error():
    return sass.SassError('This is an error')

def returns_unknown():
    """Tuples are a not-supported type."""
    return 1, 2, 3


def returns_true():
    return True


def returns_false():
    return False


def returns_none():
    return None


def returns_unicode():
    return u'☃'


def returns_bytes():
    return u'☃'.encode('UTF-8')


def returns_number():
    return sass.SassNumber(5, 'px')


def returns_color():
    return sass.SassColor(1, 2, 3, .5)


def returns_comma_list():
    return sass.SassList(('Arial', 'sans-serif'), sass.SASS_SEPARATOR_COMMA)


def returns_space_list():
    return sass.SassList(('medium', 'none'), sass.SASS_SEPARATOR_SPACE)


def returns_py_dict():
    return {'foo': 'bar'}


def returns_map():
    return sass.SassMap([('foo', 'bar')])


def identity(x):
    """This has the side-effect of bubbling any exceptions we failed to process
    in C land

    """
    import sys
    return x


custom_functions = frozenset([
    sass.SassFunction('raises', (), raises),
    sass.SassFunction('returns_warning', (), returns_warning),
    sass.SassFunction('returns_error', (), returns_error),
    sass.SassFunction('returns_unknown', (), returns_unknown),
    sass.SassFunction('returns_true', (), returns_true),
    sass.SassFunction('returns_false', (), returns_false),
    sass.SassFunction('returns_none', (), returns_none),
    sass.SassFunction('returns_unicode', (), returns_unicode),
    sass.SassFunction('returns_bytes', (), returns_bytes),
    sass.SassFunction('returns_number', (), returns_number),
    sass.SassFunction('returns_color', (), returns_color),
    sass.SassFunction('returns_comma_list', (), returns_comma_list),
    sass.SassFunction('returns_space_list', (), returns_space_list),
    sass.SassFunction('returns_py_dict', (), returns_py_dict),
    sass.SassFunction('returns_map', (), returns_map),
    sass.SassFunction('identity', ('$x',), identity),
])

custom_function_map = {
    'raises': raises,
    'returns_warning': returns_warning,
    'returns_error': returns_error,
    'returns_unknown': returns_unknown,
    'returns_true': returns_true,
    'returns_false': returns_false,
    'returns_none': returns_none,
    'returns_unicode': returns_unicode,
    'returns_bytes': returns_bytes,
    'returns_number': returns_number,
    'returns_color': returns_color,
    'returns_comma_list': returns_comma_list,
    'returns_space_list': returns_space_list,
    'returns_py_dict': returns_py_dict,
    'returns_map': returns_map,
    'identity': identity,
}

custom_function_set = frozenset([
    raises,
    returns_warning,
    returns_error,
    returns_unknown,
    returns_true,
    returns_false,
    returns_none,
    returns_unicode,
    returns_bytes,
    returns_number,
    returns_color,
    returns_comma_list,
    returns_space_list,
    returns_py_dict,
    returns_map,
    identity,
])


def compile_with_func(s):
    result = sass.compile(
        string=s,
        custom_functions=custom_functions,
        output_style='compressed',
    )
    map_result = sass.compile(
        string=s,
        custom_functions=custom_function_map,
        output_style='compressed',
    )
    assert result == map_result
    set_result = sass.compile(
        string=s,
        custom_functions=custom_function_set,
        output_style='compressed',
    )
    assert map_result == set_result
    return result


@contextlib.contextmanager
def assert_raises_compile_error(expected):
    try:
        yield
        assert False, 'Expected to raise!'
    except sass.CompileError as e:
        msg, = e.args
        assert msg.decode('UTF-8') == expected, (msg, expected)


class RegexMatcher(object):
    def __init__(self, reg, flags=None):
        self.reg = re.compile(reg, re.MULTILINE | re.DOTALL)

    def __eq__(self, other):
        return bool(self.reg.match(other))


class CustomFunctionsTest(unittest.TestCase):

    def test_raises(self):
        with assert_raises_compile_error(RegexMatcher(
                r'^Error: error in C function raises: \n'
                r'       Traceback \(most recent call last\):\n'
                r'.+'
                r'AssertionError: foo\n\n\n'
                r'       Backtrace:\n'
                r'       \tstdin:1, in function `raises`\n'
                r'       \tstdin:1\n'
                r'        on line 1 of stdin\n'
                r'>> a { content: raises\(\); }\n'
                r'   -------------\^\n$'
        )):
            compile_with_func('a { content: raises(); }')

    def test_warning(self):
        with assert_raises_compile_error(
                'Error: warning in C function returns_warning: '
                'This is a warning\n\n'
                '       Backtrace:\n'
                '       \tstdin:1, in function `returns_warning`\n'
                '       \tstdin:1\n'
                '        on line 1 of stdin\n'
                '>> a { content: returns_warning(); }\n'
                '   -------------^\n'
        ):
            compile_with_func('a { content: returns_warning(); }')

    def test_error(self):
        with assert_raises_compile_error(
                'Error: error in C function returns_error: '
                'This is an error\n\n'
                '       Backtrace:\n'
                '       \tstdin:1, in function `returns_error`\n'
                '       \tstdin:1\n'
                '        on line 1 of stdin\n'
                '>> a { content: returns_error(); }\n'
                '   -------------^\n'
        ):
            compile_with_func('a { content: returns_error(); }')

    def test_returns_unknown_object(self):
        with assert_raises_compile_error(
                'Error: error in C function returns_unknown: '
                'Unexpected type: `tuple`.\n'
                '       Expected one of:\n'
                '       - None\n'
                '       - bool\n'
                '       - str\n'
                '       - SassNumber\n'
                '       - SassColor\n'
                '       - SassList\n'
                '       - dict\n'
                '       - SassMap\n'
                '       - SassWarning\n'
                '       - SassError\n\n\n'
                '       Backtrace:\n'
                '       \tstdin:1, in function `returns_unknown`\n'
                '       \tstdin:1\n'
                '        on line 1 of stdin\n'
                '>> a { content: returns_unknown(); }\n'
                '   -------------^\n'
        ):
            compile_with_func('a { content: returns_unknown(); }')

    def test_none(self):
        self.assertEqual(
            compile_with_func('a {color: #fff; content: returns_none();}'),
            'a{color:#fff}\n',
        )

    def test_true(self):
        self.assertEqual(
            compile_with_func('a { content: returns_true(); }'),
            'a{content:true}\n',
        )

    def test_false(self):
        self.assertEqual(
            compile_with_func('a { content: returns_false(); }'),
            'a{content:false}\n',
        )

    def test_unicode(self):
        self.assertEqual(
            compile_with_func('a { content: returns_unicode(); }'),
            u'\ufeffa{content:☃}\n',
        )

    def test_bytes(self):
        self.assertEqual(
            compile_with_func('a { content: returns_bytes(); }'),
            u'\ufeffa{content:☃}\n',
        )

    def test_number(self):
        self.assertEqual(
            compile_with_func('a { width: returns_number(); }'),
            'a{width:5px}\n',
        )

    def test_color(self):
        self.assertEqual(
            compile_with_func('a { color: returns_color(); }'),
            'a{color:rgba(1,2,3,0.5)}\n',
        )

    def test_comma_list(self):
        self.assertEqual(
            compile_with_func('a { font-family: returns_comma_list(); }'),
            'a{font-family:Arial,sans-serif}\n',
        )

    def test_space_list(self):
        self.assertEqual(
            compile_with_func('a { border-right: returns_space_list(); }'),
            'a{border-right:medium none}\n',
        )

    def test_py_dict(self):
        self.assertEqual(
            compile_with_func(
                'a { content: map-get(returns_py_dict(), foo); }',
            ),
            'a{content:bar}\n',
        )

    def test_map(self):
        self.assertEqual(
            compile_with_func(
                'a { content: map-get(returns_map(), foo); }',
            ),
            'a{content:bar}\n',
        )

    def test_identity_none(self):
        self.assertEqual(
            compile_with_func(
                'a {color: #fff; content: identity(returns_none());}',
            ),
            'a{color:#fff}\n',
        )

    def test_identity_true(self):
        self.assertEqual(
            compile_with_func('a { content: identity(returns_true()); }'),
            'a{content:true}\n',
        )

    def test_identity_false(self):
        self.assertEqual(
            compile_with_func('a { content: identity(returns_false()); }'),
            'a{content:false}\n',
        )

    def test_identity_strings(self):
        self.assertEqual(
            compile_with_func('a { content: identity(returns_unicode()); }'),
            u'\ufeffa{content:☃}\n',
        )

    def test_identity_number(self):
        self.assertEqual(
            compile_with_func('a { width: identity(returns_number()); }'),
            'a{width:5px}\n',
        )

    def test_identity_color(self):
        self.assertEqual(
            compile_with_func('a { color: identity(returns_color()); }'),
            'a{color:rgba(1,2,3,0.5)}\n',
        )

    def test_identity_comma_list(self):
        self.assertEqual(
            compile_with_func(
                'a { font-family: identity(returns_comma_list()); }',
            ),
            'a{font-family:Arial,sans-serif}\n',
        )

    def test_identity_space_list(self):
        self.assertEqual(
            compile_with_func(
                'a { border-right: identity(returns_space_list()); }',
            ),
            'a{border-right:medium none}\n',
        )

    def test_identity_py_dict(self):
        self.assertEqual(
            compile_with_func(
                'a { content: map-get(identity(returns_py_dict()), foo); }',
            ),
            'a{content:bar}\n',
        )

    def test_identity_map(self):
        self.assertEqual(
            compile_with_func(
                'a { content: map-get(identity(returns_map()), foo); }',
            ),
            'a{content:bar}\n',
        )

    def test_list_with_map_item(self):
        self.assertEqual(
            compile_with_func(
                'a{content: '
                'map-get(nth(identity(((foo: bar), (baz: womp))), 1), foo)'
                '}'
            ),
            'a{content:bar}\n'
        )

    def test_map_with_map_key(self):
        self.assertEqual(
            compile_with_func(
                'a{content: map-get(identity(((foo: bar): baz)), (foo: bar))}',
            ),
            'a{content:baz}\n',
        )


test_cases = [
    SassTestCase,
    CompileTestCase,
    BuilderTestCase,
    ManifestTestCase,
    WsgiTestCase,
    DistutilsTestCase,
    SasscTestCase,
    CompileDirectoriesTest,
    SassFunctionTest,
    SassTypesTest,
    CustomFunctionsTest,
]
loader = unittest.defaultTestLoader
suite = unittest.TestSuite()
for test_case in test_cases:
    suite.addTests(loader.loadTestsFromTestCase(test_case))
