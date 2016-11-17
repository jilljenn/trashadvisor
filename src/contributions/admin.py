# -*- coding: utf-8 -*-
from django.contrib import admin

from .models import Dustbin, Waste, Trash, Legacy, Commune, Contribution


class TrashInline(admin.TabularInline):
    model = Trash


class ContributionAdmin(admin.ModelAdmin):
    list_display = ('id', 'insee')
    inlines = (TrashInline,)


class CommuneAdmin(admin.ModelAdmin):
    list_display = ('id', 'insee')


class WasteAdmin(admin.ModelAdmin):
    list_display = ('id', 'name', 'order', 'image', 'slug')
    list_editable = ('order', 'image', 'slug')


class DustbinAdmin(admin.ModelAdmin):
    list_display = ('id', 'name', 'order', 'image', 'color', 'slug')
    list_editable = ('order', 'image', 'slug')


admin.site.register(Dustbin, DustbinAdmin)
admin.site.register(Waste, WasteAdmin)
admin.site.register(Trash)
admin.site.register(Legacy)
admin.site.register(Commune, CommuneAdmin)
admin.site.register(Contribution, ContributionAdmin)
