"""Platform compatibility."""
from __future__ import absolute_import, unicode_literals

import struct
import sys
import platform
import re

# Jython does not have this attribute
try:
    from socket import SOL_TCP
except ImportError:  # pragma: no cover
    from socket import IPPROTO_TCP as SOL_TCP  # noqa


RE_NUM = re.compile(r'(\d+).+')


def _linux_version_to_tuple(s):
    # type: (str) -> Tuple[int, int, int]
    return tuple(map(_versionatom, s.split('.')[:3]))


def _versionatom(s):
    # type: (str) -> int
    if s.isdigit():
        return int(s)
    match = RE_NUM.match(s)
    return int(match.groups()[0]) if match else 0


LINUX_VERSION = None
if sys.platform.startswith('linux'):
    LINUX_VERSION = _linux_version_to_tuple(platform.release())

try:
    from socket import TCP_USER_TIMEOUT
    HAS_TCP_USER_TIMEOUT = True
except ImportError:  # pragma: no cover
    # should be in Python 3.6+ on Linux.
    TCP_USER_TIMEOUT = 18
    HAS_TCP_USER_TIMEOUT = LINUX_VERSION and LINUX_VERSION >= (2, 6, 37)


if sys.version_info < (2, 7, 6):
    import functools

    def _to_bytes_arg(fun):
        @functools.wraps(fun)
        def _inner(s, *args, **kwargs):
            return fun(s.encode(), *args, **kwargs)
        return _inner

    pack = _to_bytes_arg(struct.pack)
    pack_into = _to_bytes_arg(struct.pack_into)
    unpack = _to_bytes_arg(struct.unpack)
    unpack_from = _to_bytes_arg(struct.unpack_from)
else:
    pack = struct.pack
    pack_into = struct.pack_into
    unpack = struct.unpack
    unpack_from = struct.unpack_from

__all__ = [
    'LINUX_VERSION',
    'SOL_TCP',
    'TCP_USER_TIMEOUT',
    'HAS_TCP_USER_TIMEOUT',
    'pack',
    'pack_into',
    'unpack',
    'unpack_from',
]
