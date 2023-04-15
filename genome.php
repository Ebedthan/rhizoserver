<?php
session_start();

require_once 'config.php';

include 'functions.php';
?>
<?=template_header("Genome")?>
<link rel="stylesheet" type="text/css" href="assets/datatables.min.css">
<link rel="stylesheet" type="text/css" href="assets/leaflet.css">
<script src="assets/js/leaflet.js.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
<style>
    .leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
	}
    .bd-clipboard {
        display: block;
        position: relative;
        float: right;
    }
    .btn-clipboard {
        color: var(--bs-body-color);
        background-color: var(--bs-tertiary-bg);
        border: 0;
        border-radius: .25em;
    }
    code {
        font-size: inherit;
        color: var(--bs-code-color);
        font-family: var(--bs-font-monospace);
    }
</style>
</head>
<body class="d-flex flex-column min-vh-100">
    <?=nav()?>
    <?php
		$sql = 'SELECT `gid`, `name` FROM `Genomes` WHERE `gid` = ?';
        $stmt = mysqli_prepare($link, $sql);
        $stmt->bind_param("s", $_GET["gid"]);
        $stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

        $metfile = file_get_contents("metadata/". $_GET["gid"] . ".json");
        $metadata = json_decode($metfile, true);
	?>
    <div class="container">
        <div class="row z-0">
            <!-- Left column-->
            <div class="col-8">
                <div class="mt-5">
                    <div class="row">
                        <div class="col-8">
                            <h4><i><?php echo $row["name"]; ?></i>&nbsp; &nbsp;<?php if ($metadata["metadata_ncbi"]["ncbi_genome_category"] == "derived from metagenome" || $metadata["metadata_ncbi"]["ncbi_genome_category"] == "derived from environmental sample") { echo "<span class='badge text-bg-info' data-bs-toggle='tooltip' data-bs-title='Indicate if genome is an isolate, MAG or SAG'>MAG</span>"; } else { echo "<span class='badge text-bg-info' data-bs-toggle='tooltip' data-bs-title='Indicate if genome is an isolate, MAG or SAG'>Isolate</span>"; }?>&nbsp;&nbsp;<?php if ($metadata["metadata_gene"]["checkm_completeness"] >= 80 && $metadata["metadata_gene"]["checkm_contamination"] < 5) { echo "<span class='badge rounded-pill text-bg-success' data-bs-toggle='tooltip' data-bs-title='High Quality Genome'>High</span>"; } elseif ($metadata["metadata_gene"]["checkm_completeness"] >= 50 && $metadata["metadata_gene"]["checkm_contamination"] < 10 ) { echo "<span class='badge rounded-pill text-bg-warning' data-bs-toggle='tooltip' data-bs-title='Medium Quality Genome'>Medium</span>"; } else { echo "<span class='badge rounded-pill text-bg-danger' data-bs-toggle='tooltip' data-bs-title='Low Quality Genome'>Low</span>"; } ?></h4>
                        </div>
                        <div class="col-4 text-end">
                            <a href=<?php echo "https://gtdb.ecogenomic.org/genome?gid=".$_GET["gid"]; ?> target="_blank"><img src="assets/images/gtdb.png" width="80px" height="50px" class="img-thumbnail" alt="gtdb"></a>
                            <a href=<?php echo "https://www.ncbi.nlm.nih.gov/data-hub/genome/".$_GET["gid"]; ?> target="_blank"><img src="assets/images/ncbi.svg" width="80px" height="50px" class="img-thumbnail" alt="ncbi link"></a>
                        </div>
                    </div>
                    <hr>
                    <!-- Taxonomic information card -->
                    <div class="card">
                        <h5 class="card-header">Taxonomic information</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="label col-md-2">GTDB Taxonomy:</div>
                                <div class="value col-md-10">
                                    <?php 
                                    echo implode("&bull;",
                                        [
                                            "<a href='https://gtdb.ecogenomic.org/tree?r=".$metadata['metadata_taxonomy']['gtdb_domain']."'>".explode("__", $metadata['metadata_taxonomy']['gtdb_domain'])[1]."</a> ",
                                            " <a href='https://gtdb.ecogenomic.org/tree?r=".$metadata['metadata_taxonomy']['gtdb_phylum']."'>".explode("__", $metadata['metadata_taxonomy']['gtdb_phylum'])[1]."</a> ",
                                            " <a href='https://gtdb.ecogenomic.org/tree?r=".$metadata['metadata_taxonomy']['gtdb_class']."'>".explode("__", $metadata['metadata_taxonomy']['gtdb_class'])[1]."</a> ",
                                            " <a href='https://gtdb.ecogenomic.org/tree?r=".$metadata['metadata_taxonomy']['gtdb_order']."'>".explode("__", $metadata['metadata_taxonomy']['gtdb_order'])[1]."</a> ",
                                            " <a href='https://gtdb.ecogenomic.org/tree?r=".$metadata['metadata_taxonomy']['gtdb_family']."'>".explode("__", $metadata['metadata_taxonomy']['gtdb_family'])[1]."</a> ",
                                            " <a href='https://gtdb.ecogenomic.org/tree?r=".$metadata['metadata_taxonomy']['gtdb_genus']."'>".explode("__", $metadata['metadata_taxonomy']['gtdb_genus'])[1]."</a> ",
                                            " <a href='https://gtdb.ecogenomic.org/tree?r=".$metadata['metadata_taxonomy']['gtdb_species']."'><i>".explode("__", $metadata['metadata_taxonomy']['gtdb_species'])[1]."</i></a>",
                                        ]
                                    ); 
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="label col-md-2">NCBI Taxonomy (Unfiltered):</div>
                                <div class="value col-md-10">
                                    <?php 
                                        $c = explode(";", $metadata['link_ncbi_taxonomy_unfiltered']); 
                                        $ar = array();
                                        foreach ($c as $x) {
                                            array_push($ar, preg_replace("/(\w)__(.*)/", "$2", $x));
                                        }
                                        echo implode(" &bull; ", $ar);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="label col-md-4">GTDB representative:</div>
                                <div class="label col-md-8"><?php if ($metadata["metadata_taxonomy"]["gtdb_representative"]) { echo "true"; } else { echo "not GTDB representative"; } ?></div>
                            </div>
                            <div class="row">
                                <div class="label col-md-4">GTDB type material:</div>
                                <div class="label col-md-8"><?php echo $metadata["metadata_type_material"]["gtdbTypeDesignation"]; ?></div>
                            </div>
                            <div class="row">
                                <div class="label col-md-4">LPSN type material:</div>
                                <div class="label col-md-8"><?php echo $metadata["metadata_type_material"]["lpsnTypeDesignation"]; ?></div>
                            </div>
                            <div class="row">
                                <div class="label col-md-4">DSMZ type material:</div>
                                <div class="label col-md-8"><?php echo $metadata["metadata_type_material"]["dsmzTypeDesignation"]; ?></div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="card">
                        <h5 class="card-header">Metadata</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="label col-md-4">Country (Institution):</div>
                                <div class="value col-md-8"><?php $c = isset($metadata["metadata_ncbi"]["ncbi_country"]) ? $metadata["metadata_ncbi"]["ncbi_country"] : 'Undefined' ; echo $c; ?></div>
                            </div>
                            <div class="row">
                                <div class="label col-md-4">Submitter (NCBI):</div>
                                <div class="value col-md-8"><?php $c = isset($metadata["metadata_ncbi"]["ncbi_submitter"]) ? $metadata["metadata_ncbi"]["ncbi_submitter"] : 'Undefined' ; echo $c; ?></div>
                            </div>
                            <div class="row">
                                <div class="label col-md-4">Release date (NCBI):</div>
                                <div class="value col-md-8"><?php $c = isset($metadata["metadata_ncbi"]["ncbi_seq_rel_date"]) ? $metadata["metadata_ncbi"]["ncbi_seq_rel_date"] : '' ; echo $c; ?></div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-6">
                            <div class="card h-100">
                                <h5 class="card-header">Genome statistics</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="label col-md-8">tRNA</div>
                                        <div class="value col-md-4"><?php echo $metadata['metadata_nucleotide']['trna_aa_count']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8"># of Contigs</div>
                                        <div class="value col-md-4"><?php echo $metadata['metadata_nucleotide']['contig_count']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">N50 contigs</div>
                                        <div class="value col-md-4"><?php echo $metadata['metadata_nucleotide']['n50_contigs']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">Longest contig</div>
                                        <div class="value col-md-4"><?php echo $metadata['metadata_nucleotide']['longest_contig']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8"># scaffold</div>
                                        <div class="value col-md-4"><?php echo $metadata['metadata_nucleotide']['scaffold_count']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">N50 scaffold</div>
                                        <div class="value col-md-4"><?php echo $metadata['metadata_nucleotide']['n50_scaffolds']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">Longest scaffold</div>
                                        <div class="value col-md-4"><?php echo $metadata['metadata_nucleotide']['longest_scaffold']; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">Genome size</div>
                                        <div class="value col-md-4"><?php echo $metadata['metadata_nucleotide']['genome_size'] . " bp"; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">GC percentage</div>
                                        <div class="value col-md-4"><?php echo round($metadata['metadata_nucleotide']['gc_percentage'], 2) . "%"; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">Ambiguous bases</div>
                                        <div class="value col-md-4"><?php echo $metadata['metadata_nucleotide']['ambiguous_bases']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card h-100">
                                <h5 class="card-header">Gene statistics</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="label col-md-8">CheckM completeness</div>
                                        <div class="value col-md-4"><?php echo floatval($metadata['metadata_gene']['checkm_completeness']) . "%"; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">CheckM contamination</div>
                                        <div class="value col-md-4"><?php echo floatval($metadata['metadata_gene']['checkm_contamination']) . "%"; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">CheckM strain Heterogeneity</div>
                                        <div class="value col-md-4"><?php echo floatval($metadata['metadata_gene']['checkm_strain_heterogeneity']) . "%"; ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8"># 5S LSU</div>
                                        <div class="value col-md-4"><?php echo floatval($metadata['metadata_gene']['lsu_5s_count']); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8"># 23S LSU</div>
                                        <div class="value col-md-4"><?php echo floatval($metadata['metadata_gene']['lsu_23s_count']); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8"># SSU</div>
                                        <div class="value col-md-4"><?php echo floatval($metadata['metadata_gene']['ssu_count']); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8"># proteins</div>
                                        <div class="value col-md-4"><?php echo floatval($metadata['metadata_gene']['protein_count']); ?></div>
                                    </div>
                                    <div class="row">
                                        <div class="label col-md-8">Coding density</div>
                                        <div class="value col-md-4"><?php echo round(floatval($metadata['metadata_gene']['coding_density']), 2) . "%"; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <!--
                    <div class="row">
                        <div class="col">
                            <div class="card h-100">
                                <h5 class="card-header">Genome Viewer</h5>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
            <!-- Right column -->
            <div class="col-4">
                <div class="card border-darks mt-5">
                    <h5 class="card-header">Downloads</h5>
                    <div class="card-body">
                        <b>xgt</b>  <a class="icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="https://github.com/Ebedthan/xgt"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16"><path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/></svg> Get xgt</a><br/>
                        <div class="row g-2">
                            <div class="col-auto">
                                <input class="form-control-plaintext" id="codeXGT" value="<?php echo "xgt genome " . $_GET["gid"]; ?>">
                            </div>
                            <div class="col-auto align-self-center">
                                <button class="btn-clipboard" id="copyXGT" type="button" title="Copy to clipboard"><i class="bi bi-clipboard" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <br><b>datasets</b>  <a class="icon-link icon-link-hover link-success link-underline-success link-underline-opacity-25" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="https://www.ncbi.nlm.nih.gov/datasets/docs/v2/download-and-install"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16"><path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/></svg> Get datasets</a><br/>
                        <div class="row g-2">
                            <div class="col-auto">
                                <textarea class="form-control-plaintext" id="codeDT" rows="5"><?php echo "datasets download genome accession " . $_GET["gid"] . " --include gff3,rna,cds,protein,genome,seq-report --filename " . $_GET["gid"]; ?></textarea>
                            </div>
                            <div class="col-auto align-self-center">
                                <button class="btn-clipboard" id="copyDT" type="button" title="Copy to clipboard"><i class="bi bi-clipboard" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <script src="assets/js/jquery-3.6.1.min.js"></script>
    <script type="text/javascript">
        const data = [];
        data[0] = <?php
        $d = $metadata['metadata_ncbi']['ncbi_lat_lon'];
        if (!is_null($d)) {
            preg_match_all('/(\d+\.\d+)/', $d, $matches, PREG_SET_ORDER);
        }
        echo $matches[0][0];
        ?>;
        data[1] = <?php
        $d = $metadata['metadata_ncbi']['ncbi_lat_lon'];
        if (!is_null($d)) {
            preg_match_all('/(\d+\.\d+)/', $d, $matches, PREG_SET_ORDER);
        }
        echo $matches[1][0];
        ?>;
        var map = L.map('map').setView([51.505, -0.09], 13);
        var marker = L.marker([51.505, -0.09]).addTo(map);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
    </script>
    <script>
        document.getElementById('copyXGT').addEventListener('click', function() {
            var text = document.getElementById('codeXGT');
            text.select();
            document.execCommand('copy');
        })
        document.getElementById('copyDT').addEventListener('click', function() {
            var text = document.getElementById('codeDT');
            text.select();
            document.execCommand('copy');
        })
    </script>
    <script type="module">
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(tooltip => {
            new bootstrap.Tooltip(tooltip)
        })
    </script>
    <?=template_footer()?>

