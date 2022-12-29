<?php
session_start();

require_once 'config.php';

include 'functions.php';
?>
<?=template_header('About')?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-2"></div>
            <div class="col-8 g-5">
                <h3>About RhizoServer</h3>
                <p> 
                    Rhizobia Server (RhizoServer) is a comprehensive ressource for genomes and 16S rRNA sequences and taxonomy of Rhizobia.
                    RhizoServer is a online database containing curated rRNA sequences, structures and functions of Rhizobiales 
                    which contains bacteria capable of plant symbiosis and pathogenic bacterias.This makes such bacteria 
                    interesting ressource for the study of interations between plant and bacteria, plant health,
                    plant nutrition and sustainable soil fertility management.
                </p>
                <p>
                    RhizoServer has been developped by <a href="https://orcid.org/0000-0003-4005-177X">Anicet Ebou</a> during his thesis.
                </p>
                <br/>
                <br/>
                <h2> Funding </h2>
                <p>
                    Do you want to sponsor or gives fund to this project, please contact <a href="mailto:ediman.ebou@inphb.ci">Anicet Ebou</a>.
                    <br/>
                    You can also <a href="https://www.buymeacoffee.com/ediman">buy me a coffee</a>.
                </p>
            </div>
            <div class="col-2 gy-4"></div>
        </div>
    </div>
    <?=template_footer()?>

