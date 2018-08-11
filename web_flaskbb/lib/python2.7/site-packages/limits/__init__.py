"""
Rate limiting utilities
"""
from ._version import get_versions
__version__ = get_versions()['version']
del get_versions

from .limits import (
    RateLimitItem, RateLimitItemPerYear, RateLimitItemPerMonth,
    RateLimitItemPerDay, RateLimitItemPerHour, RateLimitItemPerMinute,
    RateLimitItemPerSecond
)
from .util import parse, parse_many
