# -*- coding: utf-8 -*-
from django.conf.urls import url, include
from django.contrib import admin

from contributions.views import contribuer, consulter, resultat

urlpatterns = [
    url(r'^admin/', admin.site.urls),
    url(r'^contribuer/$', contribuer, name="contribuer"),
    url(r'^resultat/(?P<pk>\d+)/$', resultat, name="resultat"),
    url(r'^consulter/', consulter, name="consulter"),
]

admin.site.site_header = "TrashAdvisor"
