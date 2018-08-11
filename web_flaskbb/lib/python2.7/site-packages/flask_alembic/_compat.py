import sys

PY2 = sys.version_info[0] == 2

if not PY2:
    string_types = (str,)

    def logger_has_handlers(logger):
        return logger.hasHandlers()

else:
    string_types = (str, unicode)

    # backported from PY3 logging.Logger.hasHandlers
    def logger_has_handlers(logger):
        c = logger
        rv = False
        while c:
            if c.handlers:
                rv = True
                break
            if not c.propagate:
                break
            else:
                c = c.parent
        return rv
