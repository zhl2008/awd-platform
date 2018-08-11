from __future__ import unicode_literals

import django
from django.core import checks
from django.db import IntegrityError, router
from django.db.models.fields.related import ForeignKey, ManyToManyField
from django.utils.functional import cached_property

try:
    from django.db.models.fields.related import ReverseManyToOneDescriptor, ManyToManyDescriptor
except ImportError:
    # Django 1.8 and below
    from django.db.models.fields.related import ForeignRelatedObjectsDescriptor as ReverseManyToOneDescriptor, \
        ReverseManyRelatedObjectsDescriptor as ManyToManyDescriptor


from modelcluster.utils import sort_by_fields

from modelcluster.queryset import FakeQuerySet


def create_deferring_foreign_related_manager(related, original_manager_cls):
    """
    Create a DeferringRelatedManager class that wraps an ordinary RelatedManager
    with 'deferring' behaviour: any updates to the object set (via e.g. add() or clear())
    are written to a holding area rather than committed to the database immediately.
    Writing to the database is deferred until the model is saved.
    """

    relation_name = related.get_accessor_name()
    rel_field = related.field
    rel_model = related.related_model
    superclass = rel_model._default_manager.__class__

    class DeferringRelatedManager(superclass):
        def __init__(self, instance):
            super(DeferringRelatedManager, self).__init__()
            self.model = rel_model
            self.instance = instance

        def _get_cluster_related_objects(self):
            # Helper to retrieve the instance's _cluster_related_objects dict,
            # creating it if it does not already exist
            try:
                return self.instance._cluster_related_objects
            except AttributeError:
                cluster_related_objects = {}
                self.instance._cluster_related_objects = cluster_related_objects
                return cluster_related_objects

        def get_live_query_set(self):
            # deprecated; renamed to get_live_queryset to match the move from
            # get_query_set to get_queryset in Django 1.6
            return self.get_live_queryset()

        def get_live_queryset(self):
            """
            return the original manager's queryset, which reflects the live database
            """
            return original_manager_cls(self.instance).get_queryset()

        def get_queryset(self):
            """
            return the current object set with any updates applied,
            wrapped up in a FakeQuerySet if it doesn't match the database state
            """
            try:
                results = self.instance._cluster_related_objects[relation_name]
            except (AttributeError, KeyError):
                return self.get_live_queryset()

            return FakeQuerySet(related.related_model, results)

        def get_prefetch_queryset(self, instances, queryset=None):
            if queryset is None:
                db = self._db or router.db_for_read(self.model, instance=instances[0])
                queryset = super(DeferringRelatedManager, self).get_queryset().using(db)

            rel_obj_attr = rel_field.get_local_related_value
            instance_attr = rel_field.get_foreign_related_value
            instances_dict = dict((instance_attr(inst), inst) for inst in instances)

            query = {'%s__in' % rel_field.name: instances}
            qs = queryset.filter(**query)
            # Since we just bypassed this class' get_queryset(), we must manage
            # the reverse relation manually.
            for rel_obj in qs:
                instance = instances_dict[rel_obj_attr(rel_obj)]
                setattr(rel_obj, rel_field.name, instance)
            cache_name = rel_field.related_query_name()
            return qs, rel_obj_attr, instance_attr, False, cache_name

        def get_object_list(self):
            """
            return the mutable list that forms the current in-memory state of
            this relation. If there is no such list (i.e. the manager is returning
            querysets from the live database instead), one is created, populating it
            with the live database state
            """
            cluster_related_objects = self._get_cluster_related_objects()

            try:
                object_list = cluster_related_objects[relation_name]
            except KeyError:
                object_list = list(self.get_live_queryset())
                cluster_related_objects[relation_name] = object_list

            return object_list

        def add(self, *new_items):
            """
            Add the passed items to the stored object set, but do not commit them
            to the database
            """
            items = self.get_object_list()

            for target in new_items:
                item_matched = False
                for i, item in enumerate(items):
                    if item == target:
                        # Replace the matched item with the new one. This ensures that any
                        # modifications to that item's fields take effect within the recordset -
                        # i.e. we can perform a virtual UPDATE to an object in the list
                        # by calling add(updated_object). Which is semantically a bit dubious,
                        # but it does the job...
                        items[i] = target
                        item_matched = True
                        break
                if not item_matched:
                    items.append(target)

                # update the foreign key on the added item to point back to the parent instance
                setattr(target, related.field.name, self.instance)

            # Sort list
            if rel_model._meta.ordering and len(items) > 1:
                sort_by_fields(items, rel_model._meta.ordering)

        def remove(self, *items_to_remove):
            """
            Remove the passed items from the stored object set, but do not commit the change
            to the database
            """
            items = self.get_object_list()

            # filter items list in place: see http://stackoverflow.com/a/1208792/1853523
            items[:] = [item for item in items if item not in items_to_remove]

        def create(self, **kwargs):
            items = self.get_object_list()
            new_item = related.related_model(**kwargs)
            items.append(new_item)
            return new_item

        def clear(self):
            """
            Clear the stored object set, without affecting the database
            """
            self.set([])

        def set(self, objs, bulk=True, clear=False):
            # cast objs to a list so that:
            # 1) we can call len() on it (which we can't do on, say, a queryset)
            # 2) if we need to sort it, we can do so without mutating the original
            objs = list(objs)

            cluster_related_objects = self._get_cluster_related_objects()

            for obj in objs:
                # update the foreign key on the added item to point back to the parent instance
                setattr(obj, related.field.name, self.instance)

            # Clone and sort the 'objs' list, if necessary
            if rel_model._meta.ordering and len(objs) > 1:
                sort_by_fields(objs, rel_model._meta.ordering)

            cluster_related_objects[relation_name] = objs

        def commit(self):
            """
            Apply any changes made to the stored object set to the database.
            Any objects removed from the initial set will be deleted entirely
            from the database.
            """
            if not self.instance.pk:
                raise IntegrityError("Cannot commit relation %r on an unsaved model" % relation_name)

            try:
                final_items = self.instance._cluster_related_objects[relation_name]
            except (AttributeError, KeyError):
                # _cluster_related_objects entry never created => no changes to make
                return

            original_manager = original_manager_cls(self.instance)

            live_items = list(original_manager.get_queryset())
            for item in live_items:
                if item not in final_items:
                    item.delete()

            for item in final_items:
                if django.VERSION >= (1, 9):
                    # Django 1.9+ bulk updates items by default which assumes
                    # that they have already been saved to the database.
                    # Disable this behaviour.
                    # https://code.djangoproject.com/ticket/18556
                    # https://github.com/django/django/commit/adc0c4fbac98f9cb975e8fa8220323b2de638b46
                    original_manager.add(item, bulk=False)
                else:
                    original_manager.add(item)

            # purge the _cluster_related_objects entry, so we switch back to live SQL
            del self.instance._cluster_related_objects[relation_name]

    return DeferringRelatedManager


class ChildObjectsDescriptor(ReverseManyToOneDescriptor):
    def __get__(self, instance, instance_type=None):
        if instance is None:
            return self

        return self.child_object_manager_cls(instance)

    def __set__(self, instance, value):
        manager = self.__get__(instance)
        manager.set(value)

    @cached_property
    def child_object_manager_cls(self):
        try:
            rel = self.rel
        except AttributeError:
            # Django 1.8 and below
            rel = self.related

        return create_deferring_foreign_related_manager(rel, self.related_manager_cls)


class ParentalKey(ForeignKey):
    related_accessor_class = ChildObjectsDescriptor

    # Django 1.8 has a check to prevent unsaved instances being assigned to
    # ForeignKeys. Disable it
    # This check was moved to the save() method in Django 1.8.4
    allow_unsaved_instance_assignment = True

    def check(self, **kwargs):
        from modelcluster.models import ClusterableModel

        errors = super(ParentalKey, self).check(**kwargs)

        # Check that the destination model is a subclass of ClusterableModel.
        # If self.rel.to is a string at this point, it means that Django has been unable
        # to resolve it as a model name; if so, skip this test so that Django's own
        # system checks can report the appropriate error
        if isinstance(self.rel.to, type) and not issubclass(self.rel.to, ClusterableModel):
            errors.append(
                checks.Error(
                    'ParentalKey must point to a subclass of ClusterableModel.',
                    hint='Change {model_name} into a ClusterableModel or use a ForeignKey instead.'.format(
                        model_name=self.rel.to._meta.app_label + '.' + self.rel.to.__name__,
                    ),
                    obj=self,
                    id='modelcluster.E001',
                )
            )

        # ParentalKeys must have an accessor name (#49)
        if self.rel.get_accessor_name() == '+':
            errors.append(
                checks.Error(
                    "related_name='+' is not allowed on ParentalKey fields",
                    hint="Either change it to a valid name or remove it",
                    obj=self,
                    id='modelcluster.E002',
                )
            )

        return errors


def create_deferring_forward_many_to_many_manager(rel, original_manager_cls):
    relation_name = rel.field.name
    rel_model = rel.model
    superclass = rel_model._default_manager.__class__

    class DeferringManyRelatedManager(superclass):
        def __init__(self, instance=None):
            super(DeferringManyRelatedManager, self).__init__()
            self.model = rel_model
            self.instance = instance

        def get_original_manager(self):
            if django.VERSION >= (1, 9):
                return original_manager_cls(self.instance)
            else:
                field = rel.field
                return original_manager_cls(
                    model=rel.to,
                    query_field_name=field.related_query_name(),
                    prefetch_cache_name=field.name,
                    instance=self.instance,
                    symmetrical=rel.symmetrical,
                    source_field_name=field.m2m_field_name(),
                    target_field_name=field.m2m_reverse_field_name(),
                    reverse=False,
                    through=rel.through,
                )

        def get_live_queryset(self):
            """
            return the original manager's queryset, which reflects the live database
            """
            return self.get_original_manager().get_queryset()

        def _get_cluster_related_objects(self):
            # Helper to retrieve the instance's _cluster_related_objects dict,
            # creating it if it does not already exist
            try:
                return self.instance._cluster_related_objects
            except AttributeError:
                cluster_related_objects = {}
                self.instance._cluster_related_objects = cluster_related_objects
                return cluster_related_objects

        def get_queryset(self):
            """
            return the current object set with any updates applied,
            wrapped up in a FakeQuerySet if it doesn't match the database state
            """
            try:
                results = self.instance._cluster_related_objects[relation_name]
            except (AttributeError, KeyError):
                if self.instance.pk:
                    return self.get_live_queryset()
                else:
                    # the standard M2M manager fails on unsaved instances,
                    # so bypass it and return an empty queryset
                    return rel_model.objects.none()

            return FakeQuerySet(rel_model, results)

        def get_object_list(self):
            """
            return the mutable list that forms the current in-memory state of
            this relation. If there is no such list (i.e. the manager is returning
            querysets from the live database instead), one is created, populating it
            with the live database state
            """
            cluster_related_objects = self._get_cluster_related_objects()

            try:
                object_list = cluster_related_objects[relation_name]
            except KeyError:
                object_list = list(self.get_live_queryset())
                cluster_related_objects[relation_name] = object_list

            return object_list

        def add(self, *new_items):
            """
            Add the passed items to the stored object set, but do not commit them
            to the database
            """
            items = self.get_object_list()

            for target in new_items:
                if target.pk is None:
                    raise ValueError('"%r" needs to have a primary key value before '
                        'it can be added to a parental many-to-many relation.' % target)
                item_matched = False
                for i, item in enumerate(items):
                    if item == target:
                        # Replace the matched item with the new one. This ensures that any
                        # modifications to that item's fields take effect within the recordset -
                        # i.e. we can perform a virtual UPDATE to an object in the list
                        # by calling add(updated_object). Which is semantically a bit dubious,
                        # but it does the job...
                        items[i] = target
                        item_matched = True
                        break
                if not item_matched:
                    items.append(target)

            # Sort list
            if rel_model._meta.ordering and len(items) > 1:
                sort_by_fields(items, rel_model._meta.ordering)

        def clear(self):
            """
            Clear the stored object set, without affecting the database
            """
            self.set([])

        def set(self, objs, bulk=True, clear=False):
            # cast objs to a list so that:
            # 1) we can call len() on it (which we can't do on, say, a queryset)
            # 2) if we need to sort it, we can do so without mutating the original
            objs = list(objs)

            cluster_related_objects = self._get_cluster_related_objects()

            # Clone and sort the 'objs' list, if necessary
            if rel_model._meta.ordering and len(objs) > 1:
                sort_by_fields(objs, rel_model._meta.ordering)

            cluster_related_objects[relation_name] = objs

        def remove(self, *items_to_remove):
            """
            Remove the passed items from the stored object set, but do not commit the change
            to the database
            """
            items = self.get_object_list()

            # filter items list in place: see http://stackoverflow.com/a/1208792/1853523
            items[:] = [item for item in items if item not in items_to_remove]

        def commit(self):
            """
            Apply any changes made to the stored object set to the database.
            """
            if not self.instance.pk:
                raise IntegrityError("Cannot commit relation %r on an unsaved model" % relation_name)

            try:
                final_items = self.instance._cluster_related_objects[relation_name]
            except (AttributeError, KeyError):
                # _cluster_related_objects entry never created => no changes to make
                return

            original_manager = self.get_original_manager()
            live_items = list(original_manager.get_queryset())

            items_to_remove = [item for item in live_items if item not in final_items]
            items_to_add = [item for item in final_items if item not in live_items]

            if items_to_remove:
                original_manager.remove(*items_to_remove)
            if items_to_add:
                original_manager.add(*items_to_add)

            # purge the _cluster_related_objects entry, so we switch back to live SQL
            del self.instance._cluster_related_objects[relation_name]

    return DeferringManyRelatedManager


class ParentalManyToManyDescriptor(ManyToManyDescriptor):
    def __get__(self, instance, instance_type=None):
        if instance is None:
            return self

        return self.child_object_manager_cls(instance)

    def __set__(self, instance, value):
        manager = self.__get__(instance)
        manager.set(value)

    @cached_property
    def child_object_manager_cls(self):
        if django.VERSION >= (1, 9):
            rel = self.rel
        else:
            rel = self.field.rel

        return create_deferring_forward_many_to_many_manager(rel, self.related_manager_cls)


class ParentalManyToManyField(ManyToManyField):
    related_accessor_class = ParentalManyToManyDescriptor
    _need_commit_after_assignment = True

    def contribute_to_class(self, cls, name, **kwargs):
        # ManyToManyField does not (as of Django 1.10) respect related_accessor_class,
        # but hard-codes ManyToManyDescriptor instead:
        # https://github.com/django/django/blob/6157cd6da1b27716e8f3d1ed692a6e33d970ae46/django/db/models/fields/related.py#L1538
        # So, we'll let the original contribute_to_class do its thing, and then overwrite
        # the accessor...
        super(ParentalManyToManyField, self).contribute_to_class(cls, name, **kwargs)

        if django.VERSION >= (1, 9):
            setattr(cls, self.name, self.related_accessor_class(self.rel))
        else:
            # in Django 1.8, the accessor is constructed with the field (self) rather than the 'rel'
            setattr(cls, self.name, self.related_accessor_class(self))

    def value_from_object(self, obj):
        # In Django >=1.10, ManyToManyField.value_from_object special-cases objects with no PK,
        # returning an empty list on the basis that unsaved objects can't have related objects.
        # Remove that special case.
        return getattr(obj, self.attname).all()
