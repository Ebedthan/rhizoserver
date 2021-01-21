from django.urls import path

from .views import HomePageView
from .views import SearchResultsView


from . import views

urlpatterns = [
    # for homepage /
    path('', HomePageView.as_view(), name = 'index'),
    # for detail of sequence ex: /rhizoserver/Q1FG45
    path('rhizoserver/<str:acc_num>/', views.detail, name = 'detail'),
    # for search results ex: /search/?q=name+details
    path('search/', SearchResultsView.as_view(), name = 'search_results'),
]
