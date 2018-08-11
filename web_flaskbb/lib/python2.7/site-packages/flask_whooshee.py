import abc
import os
import re
import sys
import warnings

import sqlalchemy

import whoosh
import whoosh.fields
import whoosh.index
import whoosh.qparser
from whoosh.filedb.filestore import RamStorage

from flask import current_app
from flask_sqlalchemy import BaseQuery
from sqlalchemy import text, event
from sqlalchemy.inspection import inspect
from sqlalchemy.orm.mapper import Mapper
from sqlalchemy.orm.util import AliasedClass, AliasedInsp

INSERT_KWD = 'insert'
UPDATE_KWD = 'update'
DELETE_KWD = 'delete'


__version__ = '0.5.0'


def _get_app(obj):
    return (getattr(obj, 'app', None) or current_app)

def _get_config(obj):
    return _get_app(obj).extensions['whooshee']


class WhoosheeQuery(BaseQuery):
    """An override for SQLAlchemy query used to do fulltext search."""

    def whooshee_search(self, search_string, group=whoosh.qparser.OrGroup, whoosheer=None,
                        match_substrings=True, limit=None, order_by_relevance=10):
        """Do a fulltext search on the query.
        Returns a query filtered with results of the fulltext search.

        :param search_string: The string to search for.
        :param group: The whoosh group to use for searching.
                      Defaults to :class:`whoosh.qparser.OrGroup` which
                      searches for all words in all columns.
        :param match_substrings: ``True`` if you want to match substrings,
                                 ``False`` otherwise
        :param limit: The number of the top records to be returned.
                      Defaults to ``None`` and returns all records.
        """
        if not whoosheer:
            ### inspiration taken from flask-WhooshAlchemy
            # find out all entities in join
            entities = set()
            # directly queried entities
            for cd in self.column_descriptions:
                entities.add(cd['type'])
            # joined entities
            if self._join_entities and isinstance(self._join_entities[0], Mapper):
                # SQLAlchemy >= 0.8.0
                entities.update(set([x.entity for x in self._join_entities]))
            else:
                # SQLAlchemy < 0.8.0
                entities.update(set(self._join_entities))
            # make sure we can work with aliased entities
            unaliased = set()
            for entity in entities:
                if isinstance(entity, (AliasedClass, AliasedInsp)):
                    unaliased.add(inspect(entity).mapper.class_)
                else:
                    unaliased.add(entity)

            whoosheer = next(w for w in _get_config(self)['whoosheers']
                             if set(w.models) == unaliased)

        # TODO what if unique field doesn't exist or there are multiple?
        for fname, field in list(whoosheer.schema._fields.items()):
            if field.unique:
                uniq = fname

        # TODO: use something more general than id
        res = whoosheer.search(search_string=search_string,
                               values_of=uniq,
                               group=group,
                               match_substrings=match_substrings,
                               limit=limit)
        if not res:
            return self.filter(text('null'))

        # transform unique field name into model attribute field
        attr = None

        if hasattr(whoosheer, '_is_model_whoosheer'):
            attr = getattr(whoosheer.models[0], uniq)
        else:
            # non-model whoosheers must have unique field named
            # model.__name__.lower + '_' + attr
            for m in whoosheer.models:
                if m.__name__.lower() == uniq.split('_')[0]:
                    attr = getattr(m, uniq.split('_')[1])

        search_query = self.filter(attr.in_(res))

        if order_by_relevance < 0: # we want all returned rows ordered
            search_query = search_query.order_by(sqlalchemy.sql.expression.case(
                [(attr == uniq_val, index) for index, uniq_val in enumerate(res)],
            ))
        elif order_by_relevance > 0: # we want only number of specified rows ordered
            search_query = search_query.order_by(sqlalchemy.sql.expression.case(
                [(attr == uniq_val, index) for index, uniq_val in enumerate(res) if index < order_by_relevance],
                else_=order_by_relevance
            ))
        else: # no ordering
            pass

        return search_query

class AbstractWhoosheer(object):
    """A superclass for all whoosheers.

    Whoosheer is basically a unit of fulltext search. It represents either of:

    * One table, in which case all given fields of the model is searched.
    * More tables, in which case all given fields of all the tables are
      searched.
    """

    auto_update = True

    @classmethod
    def search(cls, search_string, values_of='', group=whoosh.qparser.OrGroup, match_substrings=True, limit=None):
        """Searches the fields for given search_string.
        Returns the found records if 'values_of' is left empty,
        else the values of the given columns.

        :param search_string: The string to search for.
        :param values_of: If given, the method will not return the whole
                          records, but only values of given column.
                          Defaults to returning whole records.
        :param group: The whoosh group to use for searching.
                      Defaults to :class:`whoosh.qparser.OrGroup` which
                      searches for all words in all columns.
        :param match_substrings: ``True`` if you want to match substrings,
                                 ``False`` otherwise.
        :param limit: The number of the top records to be returned.
                      Defaults to ``None`` and returns all records.
        """
        index = Whooshee.get_or_create_index(_get_app(cls), cls)
        prepped_string = cls.prep_search_string(search_string, match_substrings)
        with index.searcher() as searcher:
            parser = whoosh.qparser.MultifieldParser(cls.schema.names(), index.schema, group=group)
            query = parser.parse(prepped_string)
            results = searcher.search(query, limit=limit)
            if values_of:
                return [x[values_of] for x in results]
            return results

    @classmethod
    def prep_search_string(cls, search_string, match_substrings):
        """Prepares search string as a proper whoosh search string.

        :param search_string: The search string which should be prepared.
        :param match_substrings: ``True`` if you want to match substrings,
                                 ``False`` otherwise.
        """
        if sys.version < '3':
            search_string = search_string.decode('utf-8')
        s = search_string.strip()
        # we don't want stars from user
        s = s.replace('*', '')
        if len(s) < _get_config(cls)['search_string_min_len']:
            raise ValueError('Search string must have at least 3 characters')
        # replace multiple with star space star
        if match_substrings:
            s = u'*{0}*'.format(re.sub('[\s]+', '* *', s))
        # TODO: some sanitization
        return s

AbstractWhoosheerMeta = abc.ABCMeta('AbstractWhoosheer', (AbstractWhoosheer,), {})

class Whooshee(object):
    """A top level class that allows to register whoosheers and adds an
    on_commit hook to SQLAlchemy.

    There are two different methods on setting up Flask-Whooshee for your
    application. The first one would be to initialize it directly, thus
    binding it to a specific application instance::

        app = Flask(__name__)
        whooshee = Whooshee(app)

    and the second is to use the factory pattern which will allow you to
    configure whooshee at a later point::

        whooshee = Whooshee()
        def create_app():
            app = Flask(__name__)
            whooshee.init_app(app)
            return app

    Please note that Whooshee will replace the Flask-SQLAlchemy's
    `db.Model.query_class` with a whoosh specific query class,
    :class:`WhoosheeQuery` which will enable full-text search on
    the registered model.
    """

    _underscore_re1 = re.compile(r'(.)([A-Z][a-z]+)')
    _underscore_re2 = re.compile('([a-z0-9])([A-Z])')

    def __init__(self, app=None):
        self.app = app
        self.whoosheers = []
        if app:
            self.init_app(app)
            # if we have app, create subclass of WhoosheeQuery that will carry it and
            # always use it for models associated to this Whooshee
            class WhoosheeQueryWithApp(WhoosheeQuery):
                app = self.app
            self.query = WhoosheeQueryWithApp
        else:
            self.query = WhoosheeQuery

    def init_app(self, app):
        """Initialize the extension. It will create the `index_path_root`
        directory upon initalization but it will **not** create the index.
        Please use :meth:`reindex` for this.

        :param app: The application instance for which the extension should
                    be initialized.
        """
        if not hasattr(app, 'extensions'):
            app.extensions = {}
        config = app.extensions.setdefault('whooshee', {})
        # mapping that caches whoosheers to their indexes; used by `get_or_create_index`
        config['whoosheers_indexes'] = {}
        # store a reference to self whoosheers; this way, even whoosheers created after init_app
        # was called will be found
        config['whoosheers'] = self.whoosheers
        config['index_path_root'] = app.config.get('WHOOSHEE_DIR', '') or 'whooshee'
        config['writer_timeout'] = app.config.get('WHOOSHEE_WRITER_TIMEOUT', 2)
        config['search_string_min_len'] = app.config.get('WHOOSHEE_MIN_STRING_LEN', 3)
        config['memory_storage'] = app.config.get("WHOOSHEE_MEMORY_STORAGE", False)
        config['enable_indexing'] = app.config.get('WHOOSHEE_ENABLE_INDEXING', True)

        if app.config.get('WHOOSHE_MIN_STRING_LEN', None) is not None:
            warnings.warn(WhoosheeDeprecationWarning("The config key WHOOSHE_MIN_STRING_LEN has been renamed to WHOOSHEE_MIN_STRING_LEN. The mispelled config key is deprecated and will be removed in upcoming releases. Change it to WHOOSHEE_MIN_STRING_LEN to suppress this warning"))
            config['search_string_min_len'] = app.config.get('WHOOSHE_MIN_STRING_LEN')

        if not os.path.exists(config['index_path_root']):
            os.makedirs(config['index_path_root'])

    def register_whoosheer(self, wh):
        """This will register the given whoosher on `whoosheers`, create the
        neccessary SQLAlchemy event listeners, replace the `query_class` with
        our own query class which will provide the search functionality
        and store the app on the whoosheer, so that we can always work
        with that.

        :param wh: The whoosher which should be registered.
        """
        self.whoosheers.append(wh)
        for model in wh.models:
            event.listen(model, 'after_{0}'.format(INSERT_KWD), self.after_insert)
            event.listen(model, 'after_{0}'.format(UPDATE_KWD), self.after_update)
            event.listen(model, 'after_{0}'.format(DELETE_KWD), self.after_delete)
            model.query_class = self.query
        if self.app:
            wh.app = self.app
        return wh

    def register_model(self, *index_fields, **kw):
        """Registers a single model for fulltext search. This basically creates
        a simple Whoosheer for the model and calls :func:`register_whoosheer`
        on it.
        """
        # construct subclass of AbstractWhoosheer for a model
        class ModelWhoosheer(AbstractWhoosheerMeta):
            pass

        mwh = ModelWhoosheer

        def inner(model):
            mwh.index_subdir = model.__tablename__
            mwh.models = [model]

            schema_attrs = {}
            for field in model.__table__.columns:
                if field.primary_key:
                    primary = field.name
                    schema_attrs[field.name] = whoosh.fields.NUMERIC(stored=True, unique=True)
                elif field.name in index_fields:
                    schema_attrs[field.name] = whoosh.fields.TEXT(**kw)
            mwh.schema = whoosh.fields.Schema(**schema_attrs)
            # we can't check with isinstance, because ModelWhoosheer is private
            # so use this attribute to find out
            mwh._is_model_whoosheer = True

            @classmethod
            def update_model(cls, writer, model):
                attrs = {primary: getattr(model, primary)}
                for f in index_fields:
                    attrs[f] = getattr(model, f)
                    if not isinstance(attrs[f], int):
                        if sys.version < '3':
                            attrs[f] = unicode(attrs[f])
                        else:
                            attrs[f] = str(attrs[f])
                writer.update_document(**attrs)

            @classmethod
            def insert_model(cls, writer, model):
                attrs = {primary: getattr(model, primary)}
                for f in index_fields:
                    attrs[f] = getattr(model, f)
                    if not isinstance(attrs[f], int):
                        if sys.version < '3':
                            attrs[f] = unicode(attrs[f])
                        else:
                            attrs[f] = str(attrs[f])
                writer.add_document(**attrs)

            @classmethod
            def delete_model(cls, writer, model):
                writer.delete_by_term(primary, getattr(model, primary))

            setattr(mwh, '{0}_{1}'.format(UPDATE_KWD, model.__name__.lower()), update_model)
            setattr(mwh, '{0}_{1}'.format(INSERT_KWD, model.__name__.lower()), insert_model)
            setattr(mwh, '{0}_{1}'.format(DELETE_KWD, model.__name__.lower()), delete_model)
            model._whoosheer_ = mwh
            model.whoosh_search = mwh.search
            self.register_whoosheer(mwh)
            return model

        return inner

    @classmethod
    def create_index(cls, app, wh):
        """Creates and opens an index for the given whoosheer and app.
        If the index already exists, it just opens it, otherwise it creates
        it first.

        :param app: The application instance.
        :param wh: The whoosheer instance for which a index should be created.
        """
        # TODO: do we really want/need to use camel casing?
        # everywhere else, there is just .lower()
        if app.extensions['whooshee']['memory_storage']:
            storage = RamStorage()
            index = storage.create_index(wh.schema)
            assert index
            return index
        else:
            index_path = os.path.join(app.extensions['whooshee']['index_path_root'],
                                      getattr(wh, 'index_subdir', cls.camel_to_snake(wh.__name__)))
            if whoosh.index.exists_in(index_path):
                index = whoosh.index.open_dir(index_path)
            else:
                if not os.path.exists(index_path):
                    os.makedirs(index_path)
                index = whoosh.index.create_in(index_path, wh.schema)
            return index

    @classmethod
    def camel_to_snake(self, s):
        """Constructs nice dir name from class name, e.g. FooBar => foo_bar.

        :param s: The string which should be converted to snake_case.
        """
        return self._underscore_re2.sub(r'\1_\2', self._underscore_re1.sub(r'\1_\2', s)).lower()

    @classmethod
    def get_or_create_index(cls, app, wh):
        """Gets a previously cached index or creates a new one for the
        given app and whoosheer.

        :param app: The application instance.
        :param wh: The whoosheer instance for which the index should be
                   retrieved or created.
        """
        if wh in app.extensions['whooshee']['whoosheers_indexes']:
            return app.extensions['whooshee']['whoosheers_indexes'][wh]
        index = cls.create_index(app, wh)
        app.extensions['whooshee']['whoosheers_indexes'][wh] = index
        return index

    def after_insert(self, mapper, connection, target):
        self.on_commit([[target, INSERT_KWD]])

    def after_delete(self, mapper, connection, target):
        self.on_commit([[target, DELETE_KWD]])

    def after_update(self, mapper, connection, target):
        self.on_commit([[target, UPDATE_KWD]])

    def on_commit(self, changes):
        """Method that gets called when a model is changed. This serves
        to do the actual index writing.
        """
        if _get_config(self)['enable_indexing'] is False:
            return None

        for wh in self.whoosheers:
            if not wh.auto_update:
                continue
            writer = None
            for change in changes:
                if change[0].__class__ in wh.models:
                    method_name = '{0}_{1}'.format(change[1], change[0].__class__.__name__.lower())
                    method = getattr(wh, method_name, None)
                    if method:
                        if not writer:
                            writer = type(self).get_or_create_index(_get_app(self), wh).\
                                writer(timeout=_get_config(self)['writer_timeout'])
                        method(writer, change[0])
            if writer:
                writer.commit()

    def reindex(self):
        """Reindex all data

        This method retrieves all the data from the registered models and
        calls the ``update_<model>()`` function for every instance of such
        model.
        """
        for wh in self.whoosheers:
            index = type(self).get_or_create_index(_get_app(self), wh)
            writer = index.writer(timeout=_get_config(self)['writer_timeout'])
            for model in wh.models:
                method_name = "{0}_{1}".format(UPDATE_KWD, model.__name__.lower())
                for item in model.query.all():
                    getattr(wh, method_name)(writer, item)
            writer.commit()


class WhoosheeDeprecationWarning(DeprecationWarning):
    pass


warnings.simplefilter('always', WhoosheeDeprecationWarning)
