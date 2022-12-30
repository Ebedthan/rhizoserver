<?php
session_start();

require_once 'config.php';

include 'functions.php';
?>
<?=template_header("Genome")?>
<link rel="stylesheet" type="text/css" href="assets/datatables.min.css">
<script type="application/javascript" src="assets/js/igv.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <?php
		$sql = 'SELECT `gID`, `name`, `fastaURL`, `indexURL`, `url`, `indexedURL` FROM `Genomes`, `Tracks` WHERE `gID` = ?';
        $stmt = mysqli_prepare($link, $sql);
        $stmt->bind_param("s", $_GET["gid"]);
        $stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

        $data = new BaktaJSON("annotations/" . pathinfo(pathinfo($row["fastaURL"], PATHINFO_FILENAME), PATHINFO_FILENAME) . ".json"); 
        $stats = $data->get_stats();
        $annot = $data->get_annotations();
	?>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="card border-darks text-center mt-5">
                    <div class="card-header"><?php echo $_GET["gid"]; ?></div>
                    <div class="card-body text-dark">
                        <i><?php echo $row["name"]; ?></i><br/><br/>
                        <a href=<?php echo "https://www.ncbi.nlm.nih.gov/assembly/".$_GET["gid"]; ?> target="_blank"><img src="assets/images/ncbi.svg" width="100px" height="auto" class="img-thumbnail" alt="ncbi link"></a><br/><br/>
                        <a href=<?php echo "https://gtdb.ecogenomic.org/genome?gid=".$_GET["gid"]; ?> target="_blank"><img src="assets/images/gtdb.png" width="100px" height="auto" class="img-thumbnail" alt="gtdb"></a>
                    </div>
                </div>
            </div>
            
            <div class="col-10">
                <div class="mt-5">
                    <h4>Genome Statistics</h4>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>General</h5>
                                <div class="row">
                                    <div class="label col-md-4">Organism:</div>
                                    <div class="value col-md-8"><i><?php echo $row["name"]; ?></i></div>
                                </div>
                                <div class="row">
                                    <div class="label col-md-4">Sequences:</div>
                                    <div class="value col-md-8"><?php echo $stats["seqs"]; ?></div>
                                </div>
                                <div class="row">
                                    <div class="label col-md-4">Genome size:</div>
                                    <div class="value col-md-8"><?php echo $stats["size"]; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-10">
                                <br/>
                                <br/>
                                <h5>Summary</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="label col-md-6">tRNA:</div>
                                            <div class="value col-md-6"><?php echo $stats['tRNA']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">tmRNA:</div>
                                            <div class="value col-md-6"><?php echo $stats['tmRNA']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">rRNA:</div>
                                            <div class="value col-md-6"><?php echo $stats['rRNA']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">ncRNA:</div>
                                            <div class="value col-md-6"><?php echo $stats['ncRNA']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="label col-md-6">ncRNA regions:</div>
                                            <div class="value col-md-6"><?php echo $stats['ncRNA-region']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">CRISPR:</div>
                                            <div class="value col-md-6"><?php echo $stats['CRISPR']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">CDS:</div>
                                            <div class="value col-md-6"><?php echo $stats['CDS']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">sORF:</div>
                                            <div class="value col-md-6"><?php echo $stats['sORF']; ?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="label col-md-6">oriC:</div>
                                            <div class="value col-md-6"><?php echo $stats['oriC']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">oriV:</div>
                                            <div class="value col-md-6"><?php echo $stats['oriV']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">oriT:</div>
                                            <div class="value col-md-6"><?php echo $stats['oriT']; ?></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">gap:</div>
                                            <div class="value col-md-6"><?php echo $stats['gap']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="mt-5">
                    <h4>Genome Viewer</h4>
                    <div class="card card-body">
                        <div id="igvDiv" class="row">
                        <script type="text/javascript">
                            document.addEventListener("DOMContentLoaded", function() {
                            
                                var igvDiv = document.getElementById("igvDiv");
                                var options =  {
                                    reference: {
                                        id: '<?php echo $row["name"]; ?>',
                                        fastaURL: '<?php echo "genomes/" . pathinfo($row["fastaURL"], PATHINFO_FILENAME); ?>',
                                        indexed: false,
                                        tracks: <?php echo json_encode($data->get_tracks()); ?>,
                                        wholeGenomeView: false,
                                    },
                                    loadDefaultGenomes: false
                                };
                            
                                igv.createBrowser(igvDiv, options)
                                    .then(function (browser) {
                                        igv.browser = browser;
                                    });
                            });
                        </script>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="mt-5">
                    <h4>Annotations</h4>
                    <div class="card card-body">
                        <table id="annoTable" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sequence</th>
                                    <th>Feature type</th>
                                    <th>Start</th>
                                    <th>Stop</th>
                                    <th>Strand</th>
                                    <th>Locus tag</th>
                                    <th>Product</th>
                                    <th>DbXrefs</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            foreach($annot as $feature) {
                                echo "<tr>";
                                echo "<td>" . $feature["seq"] . "</td>";
                                echo "<td>" . $feature["type"] . "</td>";
                                echo "<td>" . $feature["start"] . "</td>";
                                echo "<td>" . $feature["stop"] . "</td>";
                                echo "<td>" . $feature["strand"] . "</td>";
                                echo "<td>" . $feature["locus"] . "</td>";
                                echo "<td>" . $feature["product"] . "</td>";
                                $arr = array();
                                foreach (array_values($feature["dbxrefs"]) as $val) {
                                    array_push($arr, "<a target='_blank' href='https://psos-staging.computational.bio//api/v1/dbxref/redirect/" . $val ."'>" . $val . "</a>");
                                }
                                echo "<td>" . implode(", ", $arr) . "</td>";
                                echo "</tr>";
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sequence</th>
                                    <th>Feature type</th>
                                    <th>Start</th>
                                    <th>Stop</th>
                                    <th>Strand</th>
                                    <th>Locus tag</th>
                                    <th>Product</th>
                                    <th>DbXrefs</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <hr/>
                <div class="mt-5">
                    <h4>Download annotation</h4>
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="label col-md-6">Annotations: </div>
                                            <div class="value col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">GFF3 file:</div>
                                            <div class="value col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">EMBL file:</div>
                                            <div class="value col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">Replicon/contig file:</div>
                                            <div class="value col-md-6"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="label col-md-6">Feature sequences:</div>
                                            <div class="value col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">CDS/sORF sequences:</div>
                                            <div class="value col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">Info on hypotheticals:</div>
                                            <div class="value col-md-6"></div>
                                        </div>
                                        <div class="row">
                                            <div class="label col-md-6">Hypothetical protein:</div>
                                            <div class="value col-md-6"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript" src="assets/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#annoTable').DataTable();
        });
    </script>
   

    <?=template_footer()?>

