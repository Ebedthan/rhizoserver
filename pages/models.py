from django.db import models
from django.contrib.postgres.search import SearchVectorField
from django.contrib.postgres.indexes import GinIndex

class Sequence(models.Model):
    seq_acc       = models.CharField(max_length=50)
    seq_name      = models.CharField(max_length=300)
    seq_desc      = models.CharField(max_length=500)
    seq_organism  = models.CharField(max_length=500)
    seq_type      = models.CharField(max_length=50,   default='RHIZO')
    seq           = models.CharField(max_length=3000, default='ATCG')
    search_vector = SearchVectorField(null=True)

    class Meta(object):
        indexes = [GinIndex(fields=['search_vector'])]
    
    def __str__(self):
        return self.seq_acc

    def _pretty_seq(self):
        "Return a pretty format of sequence for printing"
        seq_list = [self.seq[i:i+60] for i in range(0, len(self.seq), 60)]
        return '\n'.join(map(str, seq_list))
     
    pretty_seq = property(_pretty_seq)
