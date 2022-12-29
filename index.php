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
        <div class="row align-items-center">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="container text-center">
                    <div class="row">
                        <div class="gy-5">
                            <h3>Welcome to RhizoServer!</h3>
                        </div>
                    </div>
                    <div class="row">
                        <?=template_card('Search genomes', 'genomes.php', '<i style="font-size: 50px;" class="bi bi-search link-success"></i>', false)?>
                        <?=template_card('Search 16S sequences', '16s.php','assets/images/dna.svg', true)?>
                    </div>
                    <div class="row">
                        <?=template_card('Search HK genes', '#', '<i style="font-size: 50px;" class="bi bi-bar-chart-steps link-success"></i>', false)?>
                        <?=template_card('Search ASVs', '#', '<i style="font-size: 50px;" class="bi bi-download link-success"></i>', false)?>
                    </div>
                </div>
            </div>
            <div class="col-2 gy-5"></div>
        </div>
    </div>
    <?=template_footer()?>

