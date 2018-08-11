import operator
from abc import ABCMeta, abstractmethod
from flask._compat import with_metaclass


class Requirement(with_metaclass(ABCMeta)):
    """Base for object based Requirements in Flask-Allows. This is quite
    useful for requirements that have complex logic that is too much to fit
    inside of a single function.
    """
    @abstractmethod
    def fulfill(self, user, request):
        return NotImplemented

    def __call__(self, user, request):
        return self.fulfill(user, request)

    def __repr__(self):
        return '<{}()>'.format(self.__class__.__name__)


class ConditionalRequirement(Requirement):
    """ConditionalRequirement allows settings up very complex requirements such
    as: Is this user authenticated *and* is the request a read only method, *or*
    is the user an adminstrator, or is the user a moderator *and* the user is
    assigned to this section? Such a complex requirement can be difficult to
    write as a *single* requirement, but instead ConditionalRequirement can
    compose individual permissions into a more complex permission:

        ..code-block:: python

        from mypermissions import IsAdmin, IsModerator, Authenticated, ReadOnly
        from flask_allows import And, Or

        complex = Or(IsAdmin(), IsModerator(), And(Authenticated(), ReadOnly()))

    ConditionalRequirement also supports the concept of `Not` as well.

        ..code-block:: python

        from mypermissions import IsBanned
        from flask_allows import Not

        @requires(Not(IsBanned()))

    There are also shortcuts to each of these once a requirement is wrapped
    inside a conditional requirement:

        from flask_allows import C, And, Or, Not
        from mypermissions import IsAuthenticated, ReadOnly

        Or(IsAuthenticated(), ReadOnly())
        C(IsAuthenticated()) | C(ReadOnly())

        And(IsAuthenticated(), ReadOnly())
        C(IsAuthenticated) & C(ReadOnly)

        Not(IsAuthenticated())
        ~C(IsAuthenticated())

    ConditionalRequirement is also extensible to support any function that
    accepts two boolean arguments and returns a boolean. For example, a Xor
    condition can be represented as:

        Xored(IsAuthenticated(), ReadOnly(), op=operator.xor)

    And these custom conditional can be negated as well by passing True to the
    negated keyword.

    Finally, ConditionalRequirement can be instructed to only check requirements
    until a certain result is returned by passing the `until` keyword with
    either `True` or `False`.

    And, Or and Not are implemented by simply passing different keyword
    arguments, instead of subclassing.
    """
    def __init__(self, *requirements, **kwargs):
        self.requirements = requirements
        self.op = kwargs.get('op', operator.and_)
        self.until = kwargs.get('until')
        self.negated = kwargs.get('negated')

    @classmethod
    def And(cls, *requirements):
        return cls(*requirements, op=operator.and_, until=False)

    @classmethod
    def Or(cls, *requirements):
        return cls(*requirements, op=operator.or_, until=True)

    @classmethod
    def Not(cls, *requirements):
        return cls(*requirements, negated=True)

    def fulfill(self, user, request):
        reduced = None
        for r in self.requirements:
            result = r(user, request)

            if reduced is None:
                reduced = result
            else:
                reduced = self.op(reduced, result)

            if self.until == reduced:
                break

        if reduced is not None:
            return not reduced if self.negated else reduced

        return False

    def __and__(self, require):
        return self.And(self, require)

    def __or__(self, require):
        return self.Or(self, require)

    def __invert__(self):
        return self.Not(self)

    def __repr__(self):
        additional = []

        for name in ['op', 'negated', 'until']:
            value = getattr(self, name)
            if not value:
                continue
            additional.append('{0}={1!r}'.format(name, value))

        if additional:
            additional = ' {}'.format(', '.join(additional))
        else:
            additional = ''

        return "<{0} requirements={1!r}{2}>".format(self.__class__.__name__,
                                                    self.requirements,
                                                    additional)


(C, And, Or, Not) = (ConditionalRequirement, ConditionalRequirement.And,
                     ConditionalRequirement.Or, ConditionalRequirement.Not)
