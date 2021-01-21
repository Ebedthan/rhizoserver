from django.shortcuts import get_object_or_404, render
from django.views.generic import TemplateView, ListView
from django.contrib.postgres.search import SearchVector, SearchQuery, SearchRank
from .models import Sequence

class HomePageView(TemplateView):
    template_name = "pages/index.html" 


def detail(request, acc_num):
    seq = get_object_or_404(Sequence, seq_acc = acc_num)
    return render(request, 'pages/detail.html', {'sequence': seq})

class SearchResultsView(ListView):
    model = Sequence
    template_name = 'pages/search_results.html'    

    def get_queryset(self):
        query = self.request.GET.get('q')
        search_query = SearchQuery(query)
        vector = SearchVector('seq_name',     weight = 'A') + \
                 SearchVector('seq_desc',     weight = 'B') + \
                 SearchVector('seq_organism', weight = 'C') + \
                 SearchVector('seq_acc',      weight = 'D')
        rank = SearchRank(vector, search_query)
        object_list = Sequence.objects\
                              .annotate(rank = rank)\
                              .filter(search_vector = search_query)\
                              .order_by('-rank')

        return object_list
        

