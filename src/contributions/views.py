# -*- coding: utf-8 -*-
from collections import Counter
from datetime import datetime
import json
import requests

from django.http import JsonResponse
from django.shortcuts import render, redirect

from djgeojson.serializers import Serializer as GeoJSONSerializer

from .forms import ContributionForm
from .models import Waste, Dustbin, Contribution, Trash, Commune


def contribuer(request):
    """
    Contribute
    View to add a contribution to TrashAdvisor
    """
    if request.method == 'POST':
        form = ContributionForm(request.POST)
        if form.is_valid():
            insee = form.cleaned_data['insee']
            trashes = json.loads(form.cleaned_data['trashes'])
            commune, created = Commune.objects.get_or_create(insee=insee)
            contribution = Contribution(insee=insee, commune=commune, timestamp=datetime.now())
            contribution.save()
            for key, val in trashes.items():
                if len(val) > 0:
                    dustbin = Dustbin.objects.get(id=int(key))
                    for el in val:
                        waste = Waste.objects.get(id=int(el))
                        trash = Trash(contribution=contribution, waste=waste, dustbin=dustbin)
                        trash.save()
            return redirect('resultat', pk=contribution.id)

    return render(request, 'contribuer.html', {
        'form': ContributionForm(),
        'geojson': GeoJSONSerializer().serialize(Commune.objects.all(), geometry_field='geometry', properties=('insee', 'geometry')),
        'wastes': Waste.objects.all(),
        'dustbins': Dustbin.objects.all(),
    })


def resultat(request, pk):
    """
    Result
    View to present the result of a contribution to TrashAdvisor
    """
    contribution = Contribution.objects.get(id=pk)
    contributions = Contribution.objects.all()
    contributeur_num = contributions.filter(insee=contribution.insee).count()
    contributeur_num_nat = contributions.count()
    communes_couvertes = contributions.distinct('insee').count()
    r = requests.get('https://geo.api.gouv.fr/communes?code=%s' % (contribution.insee))

    # c'est moche c'est moche c'est moche
    colors = list(Dustbin.objects.all().order_by('order').values_list('name', flat=True))
    colors = [str(b) for b in colors]
    backgroundColor = list(Dustbin.objects.all().order_by('order').values_list('color', flat=True))
    backgroundColor = [str(b) for b in backgroundColor]

    datas = []
    wastes = Waste.objects.all().order_by('order')
    for waste in wastes:
        waste_contribs_commune = Contribution.objects.all().filter(insee=contribution.insee, trash__waste=waste).values_list('trash__dustbin__order', flat=True)
        data = [0] * Dustbin.objects.all().count()
        for key, val in Counter(waste_contribs_commune).items():
            data[key] = val
        datas.append({'labels': colors, 'datasets':[{'data': data, 'backgroundColor': backgroundColor}]})

    return render(request, 'resultat.html', {
        'contributeur_num': contributeur_num,
        'ville': r.json()[0]['nom'],
        'contributeur_num_nat': contributeur_num_nat,
        'communes_couvertes': communes_couvertes,
        'datas': datas,
        'wastes': wastes
    })


def consulter(request):
    return render(request, 'consulter.html', {
        'foo': 'bar',
    })


def contribuer_json(request):
    wastes = Waste.objects.all().order_by('order')
    dustbins = Dustbin.objects.all().order_by('order')
    w = [{'path': waste.image.url, 'name': waste.name} for waste in wastes]
    d = [{'path': dustbin.image.url, 'name': dustbin.name, 'color':dustbin.color} for dustbin in dustbins]
    return JsonResponse({'dechet': w, 'poubelle': d})
