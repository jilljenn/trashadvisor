import requests
from collections import Counter

from django.shortcuts import render, redirect
from django.http import JsonResponse
from django.forms import inlineformset_factory
from datetime import datetime

from .models import Waste, Dustbin, Contribution, Trash
from .forms import ContributionForm


def contribuer_json(request):
    wastes = Waste.objects.all().order_by('order')
    dustbins = Dustbin.objects.all().order_by('order')

    w = [{'path': waste.image.url, 'name': waste.name} for waste in wastes]
    d = [{'path': dustbin.image.url, 'name': dustbin.name, 'color':dustbin.color} for dustbin in dustbins]

    return JsonResponse({'dechet': w, 'poubelle': d})
    # return render(request, 'contribuer.html', {
    #     'foo': 'bar',
    #     'dustbins': dustbins,
    #     'wastes': wastes
    # })


def contribuer(request):
    # if len(request.GET) > 0:
    #     pass
    TrashFormSet = inlineformset_factory(Contribution, Trash, fields=('dustbin', 'waste'))
    if request.method == 'POST':
        form = ContributionForm(request.POST)
        if form.is_valid():
            instance = form.save(commit=False)
            instance.timestamp = datetime.now()
            instance.save()
            formset = TrashFormSet(request.POST, instance=instance)
            if formset.is_valid():
                formset.save()
            return redirect('resultat', pk=instance.id)

    form = ContributionForm()
    formset = TrashFormSet()
    return render(request, 'contribuer.html', {
        'form': form,
        'formset': formset
    })


def resultat(request, pk):
    contribution = Contribution.objects.get(id=pk)
    contributeur_num = Contribution.objects.all().filter(insee=contribution.insee).count()
    contributeur_num_nat = Contribution.objects.all().count()
    communes_couvertes= Contribution.objects.all().distinct('insee').count()
    r = requests.get('https://geo.api.gouv.fr/communes?code=%s' % (contribution.insee))
    colors = list(Dustbin.objects.all().order_by('order').values_list('name', flat=True))
    backgroundColor = list(Dustbin.objects.all().order_by('order').values_list('color', flat=True))
    backgroundColor = [str(b) for b in backgroundColor]
    colors = [str(b) for b in colors]
    datas = []
    wastes = Waste.objects.all().order_by('order')
    #datas = [ for waste in range(wastes)]
    print datas

    for waste in Waste.objects.all().order_by('order'):
        waste_contribs_commune = Contribution.objects.all().filter(insee=contribution.insee, trash__waste=waste).values_list('trash__dustbin__order', flat=True) #.annotate(num_colors=Count('trash__dustbin'))
        data = [0] * Dustbin.objects.all().count()
        for key, val in Counter(waste_contribs_commune).items():
            data[key] = val
        print data
        datas.append({'labels': colors, 'datasets':[{'data': data, 'backgroundColor': backgroundColor}]})

    print datas
    return render(request, 'resultat.html', {
        'pk': pk,
        'contributeur_num': contributeur_num,
        'ville': r.json()[0]['nom'],
        'contributeur_num_nat': contributeur_num_nat,
        'communes_couvertes': communes_couvertes,
        'datas': datas,
        'wastes': wastes
    })


# var data = {
#     labels: [
#         "Red",
#         "Blue",
#         "Yellow"
#     ],
#     datasets: [
#         {
#             data: [300, 50, 100],
#             backgroundColor: [
#                 "#FF6384",
#                 "#36A2EB",
#                 "#FFCE56"
#             ],
#             hoverBackgroundColor: [
#                 "#FF6384",
#                 "#36A2EB",
#                 "#FFCE56"
#             ]
#         }]
# };




def consulter(request):
    return render(request, 'consulter.html', {
        'foo': 'bar',
    })