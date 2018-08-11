from __future__ import unicode_literals
from __future__ import absolute_import

from taggit import VERSION as TAGGIT_VERSION
from taggit.managers import TaggableManager, _TaggableManager
from taggit.utils import require_instance_manager

from modelcluster.queryset import FakeQuerySet


if TAGGIT_VERSION < (0, 20, 0):
    raise Exception("modelcluster.contrib.taggit requires django-taggit version 0.20 or above")


class _ClusterTaggableManager(_TaggableManager):
    @require_instance_manager
    def get_tagged_item_manager(self):
        """Return the manager that handles the relation from this instance to the tagged_item class.
        If content_object on the tagged_item class is defined as a ParentalKey, this will be a
        DeferringRelatedManager which allows writing related objects without committing them
        to the database.
        """
        rel_name = self.through._meta.get_field('content_object').rel.get_accessor_name()
        return getattr(self.instance, rel_name)

    def get_queryset(self, extra_filters=None):
        if self.instance is None:
            # this manager is not associated with a specific model instance
            # (which probably means it's being invoked within a prefetch_related operation);
            # this means that we don't have to deal with uncommitted models/tags, and can just
            # use the standard taggit handler
            return super(_ClusterTaggableManager, self).get_queryset(extra_filters)
        else:
            # FIXME: we ought to have some way of querying the tagged item manager about whether
            # it has uncommitted changes, and return a real queryset (using the original taggit logic)
            # if not
            return FakeQuerySet(
                self.through.tag_model(),
                [tagged_item.tag for tagged_item in self.get_tagged_item_manager().all()]
            )

    @require_instance_manager
    def add(self, *tags):
        tag_objs = self._to_tag_model_instances(tags)

        # Now write these to the relation
        tagged_item_manager = self.get_tagged_item_manager()
        for tag in tag_objs:
            if not tagged_item_manager.filter(tag=tag):
                # make an instance of the self.through model and add it to the relation
                tagged_item = self.through(tag=tag)
                tagged_item_manager.add(tagged_item)

    @require_instance_manager
    def remove(self, *tags):
        tagged_item_manager = self.get_tagged_item_manager()
        tagged_items = [
            tagged_item for tagged_item in tagged_item_manager.all()
            if tagged_item.tag.name in tags
        ]
        tagged_item_manager.remove(*tagged_items)

    @require_instance_manager
    def set(self, *tags, **kwargs):
        # Ignore the 'clear' kwarg (which defaults to False) and override it to be always true;
        # this means that set is implemented as a clear then an add, which was the standard behaviour
        # prior to django-taggit 0.19 (https://github.com/alex/django-taggit/commit/6542a702b590a5cfb91ea0de218b7f71ffd07c33).
        #
        # In this way, we avoid a live database lookup that occurs in the clear=False branch.
        #
        # The clear=True behaviour is fine for our purposes; the distinction only exists in django-taggit
        # to ensure that the correct set of m2m_changed signals is fired, and our reimplementation here
        # doesn't fire them at all (which makes logical sense, because the whole point of this module is
        # that the add/remove/set/clear operations don't write to the database).
        return super(_ClusterTaggableManager, self).set(*tags, clear=True)

    @require_instance_manager
    def clear(self):
        self.get_tagged_item_manager().clear()


class ClusterTaggableManager(TaggableManager):
    _need_commit_after_assignment = True

    def __get__(self, instance, model):
        # override TaggableManager's requirement for instance to have a primary key
        # before we can access its tags
        manager = _ClusterTaggableManager(
            through=self.through, model=model, instance=instance, prefetch_cache_name=self.name
        )

        return manager

    def value_from_object(self, instance):
        # retrieve the queryset via the related manager on the content object,
        # to accommodate the possibility of this having uncommitted changes relative to
        # the live database
        rel_name = self.through._meta.get_field('content_object').rel.get_accessor_name()
        return getattr(instance, rel_name).all()
