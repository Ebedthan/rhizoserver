<?php
session_start();

require_once 'config.php';

include 'functions.php';
?>
<?=template_header('License and disclaimer')?>
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-2"></div>
            <div class="col-8 g-5">
                <h3>License and disclaimer</h3>
                <h4>License</h4>
                <p>
                    All copyrightable parts of our databases are licensed under
                    the <a href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution (CC BY 4.0) License.</a>
                </p>
                <br/>
                <h4>Disclaimer</h4>
                <p>
                    We make no warranties regarding the correctness of the data, and disclaim liability for 
                    damages resulting from its use. We cannot provide unrestricted permission regarding the
                    use of the data, as some data may be covered by patents.
                </p>
                <p>
                    Any information is provided for research, educational and informational purposes only.
                </p>
            </div>
            <div class="col-2 gy-4"></div>
        </div>
    </div>
    <?=template_footer()?>