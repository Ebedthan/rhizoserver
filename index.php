<?php
session_start();

require_once 'config.php';

include 'functions.php';
?>
<?=template_header("Welcome")?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container">
        <div class="row text-center" style="margin-top: 1.56em; margin-bottom: 1.56em;">
            <h3>Welcome to RhizoServer!</h3>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-5 text-center">
            <div class="col d-flex justify-content-center">
                <div class="card border-secondary h-100 w-75">
                    <div class="card-body text-secondary">
                        <img src="assets/images/genome.svg" width="150px" height="auto" alt="Genome"/>
                        <br/>
                        <br/>
                        <h5 class="card-title">Genomes</h5>
                        <a href="genomes.php" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <div class="card border-secondary h-100 w-75">
                    <div class="card-body text-secondary">
                        <br/>
                        <br/>
                        <img src="assets/images/dna.svg" width="200px" height="auto" alt="16S sequence"/>
                        <br/>
                        <br/>
                        <br/>
                        <h5 class="card-title">Genes</h5>
                        <a href="16s.php" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-center">
                <div class="card border-secondary h-100 w-75">
                    <div class="card-body text-secondary">
                        <br/>
                        <br/>
                        <i style="font-size: 50px;" class="bi bi-download link-success"></i>
                        <br/>
                        <br/>
                        <h5 class="card-title">Downloads</h5>
                        <br/>
                        <a href="#" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=template_footer()?>

