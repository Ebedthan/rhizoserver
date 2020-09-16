from django.shortcuts import get_object_or_404, render
from django.views.generic import TemplateView, ListView
from django.contrib.postgres.search import SearchVector, SearchQuery, SearchRank
from .models import sequence

class HomePageView(TemplateView):
    template_name = "pages/index.html"


def detail(request, acc_num):
    seq = get_object_or_404(sequence, accession_number = acc_num)
    return render(request, 'pages/detail.html', {'sequence': seq})

class SearchResultsView(ListView):
    model = sequence
    template_name = 'pages/search_results.html'    

    def get_queryset(self):
        query = self.request.GET.get('q')
        vector = SearchVector('accession_number', 'sequence_description')
        search_query = SearchQuery(query)
        object_list = sequence.objects.annotate(
            rank = SearchRank(vector, search_query)
        ).order_by('-rank')
        return object_list

