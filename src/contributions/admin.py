from django.contrib import admin

from .models import *


class TrashInline(admin.TabularInline):
    model = Trash


class ContributionAdmin(admin.ModelAdmin):
    list_display = ('id', 'insee')
    inlines = (TrashInline,)


class WasteAdmin(admin.ModelAdmin):
    list_display = ('id', 'name', 'order', 'image')
    list_editable = ('order', 'image' )


class DustbinAdmin(admin.ModelAdmin):
    list_display = ('id', 'name', 'order', 'image')
    list_editable = ('order', 'image')


admin.site.register(Dustbin, DustbinAdmin)
admin.site.register(Waste, WasteAdmin)
admin.site.register(Trash)
admin.site.register(Contribution, ContributionAdmin)
