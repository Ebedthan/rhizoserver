from django.shortcuts import get_object_or_404, render
from django.views.generic import TemplateView, ListView
from django.contrib.postgres.search import SearchVector, SearchQuery, SearchRank
from .models import Sequence

# Homepage view: rhizoserver.org
class HomePageView(TemplateView):
    template_name = "pages/index.html" 


# About us view: rhizoserver.org/aboutus.html
class LicenseView(TemplateView):
    template_name = "pages/license.html"

# About us view: rhizoserver.org/aboutus.html
class AboutUsView(TemplateView):
    template_name = "pages/about-us.html"


# Analyze view: rhizoserver.org/analyze
class AnalyzeView(TemplateView):
    template_name = "pages/analyze.html"


# Blast analysis view: rhizoserver.org/analyze/blast
class BlastView(TemplateView):
    template_name = "pages/blast.html"


# taxaSolver analysis view: rhizoserver.org/analyze
class TaxaSolverView(TemplateView):
    template_name = "pages/taxasolver.html"


# Detail view: rhizoserver.org/rhizoserver/ACCNUM
def detail(request, acc_num):
    seq = get_object_or_404(Sequence, seq_acc = acc_num)
    template_name = 'pages/detail.html'

    return render(request, template_name, {'sequence': seq})


# Download view: rhizoserver.org/download
class DownloadView(TemplateView):
    template_name = "pages/download.html"


# Rhizobiales Taxonomy view: rhizoserver.org/rhizotax.html
class RhizoTaxView(TemplateView):
    template_name = "pages/rhizotax.html"


# Submit data view: rhizoserver.org/submit.html
class SubmitView(TemplateView):
    template_name = "pages/submit.html"


# Search Result view: rhizoserver.org/search/?q=searchstring
class SearchResultsView(ListView):
    model = Sequence
    template_name = 'pages/search_results.html'    

    def get_queryset(self):
        query = self.request.GET.get('q', None)
        search_query = SearchQuery(query)
        vector = SearchVector('seq_name',                        weight = 'A') + \
                 SearchVector('seq_desc',                        weight = 'B') + \
                 SearchVector('sequence__seq_tax__tax_organism', weight = 'C') + \
                 SearchVector('seq_acc',                         weight = 'D')
        rank = SearchRank(vector, search_query)
        object_list = Sequence.objects\
                              .annotate(rank = rank)\
                              .filter(search_vector = search_query)\
                              .order_by('-rank')

        return object_list
        

