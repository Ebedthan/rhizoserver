<?php
session_start();

require_once 'config.php';

include 'functions.php';
?>
<?=template_header('Contact')?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container">
        <div class="row z-0 align-items-center">
            <div class="col">
                <div class="container px-4 py-5" id="icon-grid">
                    <h2 class="pb-2 border-bottom">Let us connect!</h2>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4 py-5">
                        <div class="col d-flex align-items-start">
                            <i class="bi bi-house-door text-muted flex-shrink-0 me-3" style="font-size: 1.75em;"></i>
                            <div>
                            <h4 class="fw-bold mb-0">Our Home</h4>
                            <p>The Bioinformatic and Biostatistics laboratory of the Institut National Polytechnique Félix Houphouët-Boigny</p>
                            </div>
                        </div>
                        <div class="col d-flex align-items-start">
                            <i class="bi bi-geo-fill text-muted flex-shrink-0 me-3" style="font-size: 1.75em;"></i>
                            <div>
                            <h4 class="fw-bold mb-0">Our location</h4>
                            <p>Yamoussoukro, the capital of the amazing Côte d'Ivoire!</p>
                            </div>
                        </div>
                        <div class="col d-flex align-items-start">
                            <i class="bi bi-envelope text-muted flex-shrink-0 me-3" style="font-size: 1.75em;"></i>
                            <div>
                            <h4 class="fw-bold mb-0">Our Email</h4>
                            <p><a href="mailto:info@rhizoserver.org">info@rhizoserver.org</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=template_footer()?>

