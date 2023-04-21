<?php
session_start();

require_once 'config.php';
include 'functions.php';
?>
<?=template_header("Download")?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <div class="container text-center">
        <div class="row z-0 g-5" style="margin-top: 1.56em; margin-bottom: 1.56em;">
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Allorizobium</i></h5>
                    <p class="card-text">There is 
                        <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Allorhizobium'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes availables for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Aminobacter</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Aminobacter'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Azorhizobium</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Azorhizobium'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row g-5">
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Bradyrhizobium</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Bradyrhizobium'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Cupriavidus</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Cupriavidus'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Devosia</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Devosia'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row g-5">
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Ensifer</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Ensifer'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Mesorhizobium</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Mesorhizobium'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Methylobacterium</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Methylobacterium'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row g-5">
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Microvirga</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Microvirga'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Neorhizobium</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Neorhizobium'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Ochrobactrum</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Ochrobactrum'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row g-5">
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Paraburkholderia</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Paraburkholderia'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Pararhizobium</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Pararhizobium'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Phyllobacterium</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Phyllobacterium'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row g-5">
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Rhizobium</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Rhizobium'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Shinella</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Shinella'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><i>Trinickia</i></h5>
                    <p class="card-text">There is <?php 
                            $sql = "SELECT COUNT(genome_id) FROM Taxonomy WHERE genus = 'g__Trinickia'";
                            $result = mysqli_query($link, $sql);
                            $row = mysqli_fetch_array($result);
                            echo $row[0];
                        ?> genomes available for download.</p>
                    <a href="#" class="btn btn-success">Download</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
<?=template_footer()?>