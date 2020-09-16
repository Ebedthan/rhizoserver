from django.db import models

class sequence(models.Model):
    accession_number = models.CharField(max_length=50)
    sequence_name = models.CharField(max_length=300)
    sequence_description = models.CharField(max_length=500)
    organism = models.CharField(max_length=500)
    sequence_type = models.CharField(max_length=50, default='RHIZO')
    seq = models.CharField(max_length=3000, default='ATCG')
    
    def __str__(self):
        return self.accession_number

    def _pretty_seq(self):
        "Return a pretty format of sequence for printing"
        seq_list = [self.seq[i:i+60] for i in range(0, len(self.seq), 60)]
        return '\n'.join(map(str, seq_list))
     
    pretty_seq = property(_pretty_seq)
