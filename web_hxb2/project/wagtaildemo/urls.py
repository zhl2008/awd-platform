from django.conf.urls import include, url
from django.conf.urls.static import static
from django.conf import settings
from django.contrib import admin

from wagtail.wagtailadmin import urls as wagtailadmin_urls
from wagtail.wagtaildocs import urls as wagtaildocs_urls
from wagtail.wagtailcore import urls as wagtail_urls
from wagtail.contrib.wagtailapi import urls as wagtailapi_urls
from wagtail.api.v2.router import WagtailAPIRouter
from wagtail.api.v2.endpoints import PagesAPIEndpoint
from wagtail.wagtaildocs.api.v2.endpoints import DocumentsAPIEndpoint
from wagtail.wagtailimages.api.v2.endpoints import ImagesAPIEndpoint

from demo import views


api = WagtailAPIRouter('api')
api.register_endpoint('pages', PagesAPIEndpoint)
api.register_endpoint('images', ImagesAPIEndpoint)
api.register_endpoint('documents', DocumentsAPIEndpoint)


urlpatterns = [
    url(r'^django-admin/', include(admin.site.urls)),

    url(r'^admin/', include(wagtailadmin_urls)),
    url(r'^documents/', include(wagtaildocs_urls)),

    url(r'search/$', views.search, name='search'),
    url(r'^api/', include(wagtailapi_urls)),
    url(r'^api/v2/', include(api.urls)),
]


if settings.DEBUG:
    from django.contrib.staticfiles.urls import staticfiles_urlpatterns
    from django.views.generic.base import RedirectView

    urlpatterns += staticfiles_urlpatterns()
    urlpatterns += static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
    urlpatterns += [
        url(r'^favicon\.ico$', RedirectView.as_view(url=settings.STATIC_URL + 'demo/images/favicon.ico'))
    ]

    # Uncomment the lines below to enable django-debug-toolbar (along with the
    # corresponding lines in settings/local.py):
    #import debug_toolbar

    #urlpatterns += [
    #    url(r'^__debug__/', include(debug_toolbar.urls)),
    #]


# For anything not caught by a more specific rule above, hand over to
# Wagtail's serving mechanism (must come last)
urlpatterns += [
    url(r'', include(wagtail_urls)),
]
