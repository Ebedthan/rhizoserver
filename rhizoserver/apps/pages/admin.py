from django.contrib import admin
from .models import Sequence, Taxonomy

# Tell the admin that Sequence and Taxonomy object have admin interface

@admin.register(Sequence)
class SequenceAdmin(admin.ModelAdmin):
    pass

@admin.register(Taxonomy)
class TaxonomyAdmin(admin.ModelAdmin):
    pass