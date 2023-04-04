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
    <div class="container">
        <div class="row text-center" style="margin-top: 1.56em; margin-bottom: 1.56em;">
            <h3>Useful tools for Rhizobia genome analysis</h3>
            <br><br><br>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-5 text-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">xgt</h5>
                        <p class="card-text">Efficient and fast querying and parsing of GTDB's data</p>
                        <a href="https://github.com/Ebedthan/xgt" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">BLAST</h5>
                        <p class="card-text">Find regions of similarity between biological sequences.</p>
                        <a href="https://blast.ncbi.nlm.nih.gov/Blast.cgi" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">IGV</h5>
                        <p class="card-text">High-performance, easy-to-use and interactive tool for the visual exploration of genomic data.</p>
                        <a href="https://software.broadinstitute.org/software/igv" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="genomes.php" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=template_footer()?>