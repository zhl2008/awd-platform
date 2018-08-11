import warnings
from functools import wraps

from flask.views import MethodView, View

from .allows import _allows, _make_callable


def requires(*requirements, **opts):

    def raiser():
        raise opts.get('throws', _allows.throws)

    def fail(*args, **kwargs):
        f = _make_callable(opts.get('on_fail', _allows.on_fail))
        res = f(*args, **kwargs)

        if res is not None:
            return res

        raiser()

    def decorator(f):

        @wraps(f)
        def allower(*args, **kwargs):
            if _allows.fulfill(requirements, identity=opts.get('identity')):
                return f(*args, **kwargs)
            return fail(*args, **kwargs)

        return allower

    return decorator


class PermissionedView(View):
    requirements = ()

    @classmethod
    def as_view(cls, name, *cls_args, **cls_kwargs):
        warnings.warn(
            "PermissionedView is deprecated and will be removed in 0.6. Use either requires(...)"
            "or allows.requires(...) in the decorators attribute of View or MethodView.",
            DeprecationWarning,
            stacklevel=2
        )

        view = super(PermissionedView, cls).as_view(name, *cls_args, **cls_kwargs)

        if cls.requirements:
            view = requires(*cls.requirements)(view)
        view.requirements = cls.requirements
        return view


class PermissionedMethodView(PermissionedView, MethodView):
    pass
