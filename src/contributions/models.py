# -*- coding: utf-8 -*-
from __future__ import unicode_literals

from django.db import models
from django.contrib.gis.db import models as gis_models


class Dustbin(models.Model):
    order = models.PositiveIntegerField()
    color = models.CharField(max_length=7)
    image = models.ImageField(upload_to="dustbin/", blank=True, null=True)
    name = models.CharField(max_length=20)

    def __unicode__(self):
        return self.name


class Waste(models.Model):
    order = models.PositiveIntegerField()
    name = models.CharField(max_length=100)
    image = models.ImageField(upload_to="waste/", blank=True, null=True)

    def __unicode__(self):
        return self.name


class Commune(gis_models.Model):
    insee = models.CharField(max_length=5)
    geometry = gis_models.GeometryCollectionField(blank=True, null=True)


class Contribution(models.Model):
    insee = models.CharField(max_length=5)
    timestamp = models.DateTimeField()
    commune = models.ForeignKey(Commune, null=True, blank=True)


class Trash(models.Model):
    dustbin = models.ForeignKey(Dustbin)
    waste = models.ForeignKey(Waste)
    contribution = models.ForeignKey(Contribution)


class Legacy(models.Model):
    id_declarant = models.IntegerField(max_length=11)
    conteneur_type = models.CharField(max_length=20)
    conteneur_couleur = models.CharField(max_length=20)
    dechet_type = models.CharField(max_length=32)
    code_postal = models.IntegerField(max_length=5)
    code_insee = models.CharField(max_length=32)
    declaration_date = models.DateTimeField(auto_now=True)
