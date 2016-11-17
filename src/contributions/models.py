# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from collections import defaultdict, Counter

from django.db import models
from django.db.models import Count
from django.contrib.gis.db import models as gis_models
from django.utils.text import slugify


class Dustbin(models.Model):
    order = models.PositiveIntegerField()
    color = models.CharField(max_length=7)
    image = models.ImageField(upload_to="dustbin/", blank=True, null=True)
    name = models.CharField(max_length=20)
    slug = models.CharField(max_length=100, default="vide")

    def __unicode__(self):
        return self.name


class Waste(models.Model):
    order = models.PositiveIntegerField()
    name = models.CharField(max_length=100)
    image = models.ImageField(upload_to="waste/", blank=True, null=True)
    slug = models.CharField(max_length=100, default="vide")

    def __unicode__(self):
        return self.name


class Commune(gis_models.Model):
    insee = models.CharField(max_length=5)
    geometry = gis_models.GeometryCollectionField(blank=True, null=True)

    @property
    def nb_of_contributions(self):
        return self.contribution_set.all().count()


    def waste_color(self, waste_id):
        el = Waste.objects.get(id=waste_id)
        c = Contribution.objects.filter(trash__waste=el, commune=self).values_list('trash__dustbin__color', flat=True)
        v = Counter(c).most_common(1)
        if len(v) > 0:
            return str(v[0][0])
        else:
            return None

    @property
    def nonRecyclable(self):
        return self.waste_color(8)

    @property
    def barquettePlastique(self):
        return self.waste_color(7)

    @property
    def alimentaire(self):
        return self.waste_color(6)

    @property
    def verre(self):
        return self.waste_color(5)

    @property
    def papier(self):
        return self.waste_color(4)

    @property
    def emballageCarton(self):
        return self.waste_color(3)

    @property
    def canette(self):
        return self.waste_color(2)

    @property
    def bouteillePlastique(self):
        return self.waste_color(1)

    @property
    def contributions(self, only_winning_dustbin=True):
        ds = [item.trashes for item in self.contribution_set.all()]
        dd = defaultdict(list)
        for d in ds:
            for key, value in d.iteritems():
                dd[key].append(value)
        for key, vals in dd.items():
            cnt = Counter()
            for val in vals:
                cnt[val.keys()[0]] += val.values()[0]
            dd[key] = dict(cnt)
        if only_winning_dustbin is True:
            for key, vals in dd.items():
                nb = 0
                cl = None
                for key2, val2 in vals.items():
                    if val2 > nb:
                        cl = key2
                dd[key] = cl
        return dd

    # def __getattr__(self, name):
    #     wastes = [str(slugify(waste)) for waste in Waste.objects.all().values_list('name', flat=True)]
    #     if name in wastes:
    #         try:
    #             return self.contributions[name]
    #         except:
    #             return None
    #     return super(Commune, self).__getattr__(name)


class Contribution(models.Model):
    insee = models.CharField(max_length=5)
    timestamp = models.DateTimeField()
    commune = models.ForeignKey(Commune, null=True, blank=True)

    @property
    def trashes(self):
        dd = defaultdict(list)
        for item in self.trash_set.all():
            dd[item.data[0]].append(item.data[1])
        for key, vals in dd.items():
            cnt = Counter()
            for val in vals:
                cnt[val] += 1
            dd[key] = dict(cnt)
        return dict(dd)


class Trash(models.Model):
    dustbin = models.ForeignKey(Dustbin)
    waste = models.ForeignKey(Waste)
    contribution = models.ForeignKey(Contribution)

    @property
    def data(self):
        return [str(slugify(self.waste.name)), str(self.dustbin.color)]


class Legacy(models.Model):
    id_declarant = models.IntegerField(max_length=11)
    conteneur_type = models.CharField(max_length=20)
    conteneur_couleur = models.CharField(max_length=20)
    dechet_type = models.CharField(max_length=32)
    code_postal = models.IntegerField(max_length=5)
    code_insee = models.CharField(max_length=32)
    declaration_date = models.DateTimeField(auto_now=True)
