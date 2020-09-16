from django.contrib import admin
from .models import sequence

# Tell the admin that sequence objects have an admin interface
admin.site.register(sequence)
