from django.shortcuts import render
from django.http import JsonResponse

from .models import Waste, Dustbin

def contribuer(request):
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


def resultat(request, pk):
    return render(request, 'resultat.html', {
        'pk': pk,
    })


def consulter(request):
    return render(request, 'consulter.html', {
        'foo': 'bar',
    })