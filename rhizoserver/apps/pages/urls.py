from django.urls import path

from .views import *

from . import views

urlpatterns = [
    # for homepage /
    path('',                           HomePageView.as_view(),      name = 'index'),
    # for about us /about.html
    path('about-us',                   AboutUsView.as_view(),       name = 'about'),
    # for analyze page /analyze.html
    path('analyze',                    AnalyzeView.as_view(),       name = 'analyze'),
    # for blast page /analyze/blast
    path('analyze/blast',              BlastView.as_view(),         name = 'blast'),
    # for taxasolver /analyze/taxasolver
    path('analyze/taxasolver',         TaxaSolverView.as_view(),    name = 'taxasolver'),
    # for download /download
    path('download/',                  DownloadView.as_view(),      name = 'download'),
    # for rhizobiales taxonomy view
    path('rhizotax',                   RhizoTaxView.as_view(),      name = 'rhizotax'),
    # for submit view 
    path('submit',                     SubmitView.as_view(),        name = 'submit'),
    # for detail of sequence ex: /rhizoserver/Q1FG45
    path('rhizoserver/<str:acc_num>/', views.detail,                name = 'detail'),
    # for search results ex: /search/?q=name+details
    path('search/',                    SearchResultsView.as_view(), name = 'search_results'),
]
