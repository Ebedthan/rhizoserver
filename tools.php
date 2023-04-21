<?php
session_start();

require_once 'config.php';

include 'functions.php';
?>
<?=template_header("Tools")?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container text-center">
        <div class="row text-center z-0" style="margin-top: 1.56em; margin-bottom: 1.56em;">
            <h3>Useful tools for Rhizobia genome analysis</h3>
            <br><br><br>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 align-items-center">
            <div class="col">
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">xgt</h5>
                        <p class="card-text">Efficient and fast querying and parsing of GTDB's data</p>
                        <a href="https://github.com/Ebedthan/xgt" target="_blank" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">barrnap</h5>
                        <p class="card-text">Barrnap predicts the location of ribosomal RNA genes in genomes.</p>
                        <a href="https://github.com/tseemann/barrnap" target="_blank" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">hyperex</h5>
                        <p class="card-text">Hypervariable region primer-based extractor for 16S rRNA and other SSU/LSU sequences.</p>
                        <a href="https://github.com/Ebedthan/hyperex" target="_blank" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">BLAST</h5>
                        <p class="card-text">Find regions of similarity between biological sequences.</p>
                        <a href="https://blast.ncbi.nlm.nih.gov/Blast.cgi" target="_blank" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">IGV</h5>
                        <p class="card-text">High-performance, easy-to-use and interactive tool for the visual exploration of genomic data.</p>
                        <a href="https://software.broadinstitute.org/software/igv" target="_blank" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=template_footer()?>