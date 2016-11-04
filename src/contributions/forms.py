from django.forms import ModelForm
from .models import Contribution


class ContributionForm(ModelForm):
    class Meta:
        model = Contribution
        fields = ('insee',)