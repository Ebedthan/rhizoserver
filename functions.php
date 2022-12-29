<?php
session_start();
include 'cog.php';


function template_card($title, $href, $icon='',$image=false) {
    if (!$image) {
    echo <<<EOT
<div class="col g-4">
    <div class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-body text-secondary">
            $icon
            <br/>
            <br/>
            <h5 class="card-title">$title</h5>
            <a href="$href" class="stretched-link"></a>
        </div>
    </div>
</div>
EOT;
    } else {
        echo <<<EOT
<div class="col g-4">
    <div class="card border-secondary mb-3" style="max-width: 18rem;">
        <div class="card-body text-secondary">
            <img src="$icon" width="236px" height="auto" alt="16S sequence"/>
            <br/>
            <br/>
            <h5 class="card-title">$title</h5>
            <a href="$href" class="stretched-link"></a>
        </div>
    </div>
</div>
EOT;
    }
}

function template_header($title = 'Welcome!') {
    echo <<<EOT
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>$title - RhizoServer</title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
EOT;
}

function template_footer() {
    echo <<<EOT
<footer class="mt-auto py-3 my-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a href="contact.php" class="nav-link px-2 text-muted">Contact</a></li>
        <li class="nav-item"><a href="license.php" class="nav-link px-2 text-muted">License and disclaimer</a></li>
        <li class="nav-item"><a href="https://www.buymeacoffee.com/ediman" target="_blank" class="nav-link px-2 text-muted">Buy me a coffee</a></li>
    </ul>
    <p class="text-center">Made with ❤️ and ☕ in Côte d'Ivoire</p>
    <p class="text-center text-muted">&copy; 2022 RhizoServer</p>
</footer>
<script type="text/javascript" src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
EOT;
}

function nav() {
    echo <<<EOT
<nav class="navbar navbar-light bg-light" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="assets/images/rhizo_brand.png" width="50" height="auto" alt="RhizoServer logo">
            RhizoServer
        </a>
        <ul class="nav">
            <li class="nav-item"><a href="genomes.php" class="nav-link px-2 link-dark">Genomes</a></li>
            <li class="nav-item"><a href="16s.php" class="nav-link px-2 link-dark">16S sequences</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 link-dark">Analyses</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 link-dark">Download</a></li>
            <li class="nav-item"><a href="about.php" class="nav-link px-2 link-dark">About</a></li>
        </ul>
    </div>
</nav>
EOT;
}

function lookup_cog($feature) {
    $categories = array();

    if (array_search('db_xrefs', $feature)) {
        $categories = preg_filter('/^COG:[A-Z]+$/', substr('$0', 4), $feature['db_xrefs']);
        if (count($categories) > 0) {
            if (count($categories) > 1) {
                $categories = str_split($categories[0]);
            }
        }
    } else {
        $categories = array();
    }

    return $categories;
}

function array_flatten($array = null) {
    $result = array();

    if (!is_array($array)) {
        $array = func_get_args();
    }

    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        } else {
            $result = array_merge($result, array($key => $value));
        }
    }

    return $result;
}

class BaktaJSON {
    // Properties
    public $species;
    public $stats;
    public $annotations;
    public $fastaURL;
    public $tracks;

    // Constructor
    function __construct($jsonpath) {
        // Read the JSON file
        $json = file_get_contents($jsonpath);

        // Decode the JSON file
        $json_data = json_decode($json, true);
        $feat = array_count_values(array_column($json_data['features'], 'type'));

        $data = array(
            "seqs" => $json_data["stats"]['no_sequences'], 
            "size" => number_format($json_data["stats"]["size"]) . " bp",
            "tRNA" => $feat['tRNA'] ?? 0,
            "tmRNA" => $feat['tmRNA'] ?? 0,
            "rRNA" => $feat['rRNA'] ?? 0,
            "ncRNA" => $feat['ncRNA'] ?? 0,
            "ncRNA-region" => $feat['ncRNA-region'] ?? 0,
            "CRISPR" => $feat['crispr'] ?? 0,
            "CDS" => $feat['cds'] ?? 0,
            "sORF" => $feat['sorf'] ?? 0,
            "oriC" => $feat['oriC'] ?? 0,
            "oriV" => $feat['oriV'] ?? 0,
            "oriT" => $feat['oriT'] ?? 0,
            "gap" => $feat['gap'] ?? 0,
        );

        $annot = array();
        foreach ($json_data['features'] as $feature) {
            if (in_array($feature['type'], array("tRNA", "tmRNA", "rRNA", "ncRNA", "ncRNA-region", "cripsr", "cds", "sorf", "oriC", "oriV", "oriT", "gap"))) {
                array_push(
                    $annot, 
                    array(
                        "type" => $feature['type'] ?? '',
                        "seq" => $feature['contig'] ?? '',
                        "start" => $feature['start'] ?? '',
                        "stop" => $feature['stop'] ?? '',
                        "strand" => $feature['strand'] ?? '',
                        "locus" => $feature['locus'] ?? '',
                        "product" => $feature['product'] ?? '',
                        "dbxrefs" => $feature['db_xrefs'] ?? array( ),
                    )
                );
            }
        }

        $temp = tmpfile();
        $fp = fopen("data.fa", 'w');

        foreach ($json_data['sequences'] as $seq) {
            fwrite($temp, ">" . $seq['id'] . "\n" . chunk_split($seq['sequence'], 80) . "\n");
            fwrite($fp, ">" . $seq['id'] . "\n" . chunk_split($seq['sequence'], 80) . "\n");
        }
        fclose($fp);

        $tracks = array();
        $track_type = array(
            "cds" => "CDS/sORF", 
            "sorf" => "CDS/sORF",
            "tRNA" => "tRNA/tmRNA/rRNA",
            "tmRNA" => "tRNA/tmRNA/rRNA",
            "rRNA" => "tRNA/tmRNA/rRNA",
            "ncRNA" => "ncRNA",
            "ncRNA-region" => "ncRNA-region", 
            "crispr" => "CRISPR", 
            "gap" => "Gap", 
            "oriC" => "oriC/oriV/oriT",
            "oriV" => "oriC/oriV/oriT",
            "oriT" => "oriC/oriV/oriT"
        );

        $tcds = array();
        $ttrna = array();
        $tncrna = array();
        $tncrnareg = array();
        $tcrispr = array();
        $tgap = array();
        $tori = array();

        foreach ($json_data['features'] as $x) {
            $features = new Feature($x, $json_data['sequences']);
            $features = array_flatten($features->get_feature());

            switch ($track_type[$x['type']]) {
                case "CDS/sORF":
                    array_push($tcds, $features);
                    break;
                case "tRNA/tmRNA/rRNA":
                    array_push($ttrna, $features);
                    break;
                case "ncRNA":
                    array_push($tncrna, $features);
                    break;
                case "ncRNA-region":
                    array_push($tncrnareg, $features);
                    break;
                case "CRISPR":
                    array_push($tcrispr, $features);
                    break;
                case "Gap":
                    array_push($tgap, $features);
                    break;
                case "oriC/oriV/oriT":
                    array_push($tori, $features);
                    break;
                default:
                    continue 2;
            }
        }

        $tracks = array(
            array("name" => "CDS/sORF", "type" => "annotation", "features" => $tcds),
            array("name" => "tRNA/tmRNA/rRNA", "type" => "annotation", "features" => $ttrna),
            array("name" => "ncRNA", "type" => "annotation", "features" => $tncrna),
            array("name" => "ncRNA-region", "type" => "annotation", "features" => $tncrnareg),
            array("name" => "CRISPR", "type" => "annotation", "features" => $tcrispr),
            array("name" => "Gap", "type" => "annotation", "features" => $tgap),
            array("name" => "oriC/oriV/oriT", "type" => "annotation", "features" => $tori)
        );
        

        $this->species = $json_data['genome']['genus'] ?? '' . ' ' . $json_data['genome']['species'] ?? '' . ' ' . $json_data['genome']['strain'] ?? '';
        $this->stats = $data;
        $this->annotations = $annot;
        $this->fastaURL = stream_get_meta_data($temp)['uri'];
        $this->tracks = $tracks;
    }

    // Methods
    function get_species() {
        return $this->species;
    }

    function get_stats() {
        return $this->stats;
    }

    function get_annotations() {
        return $this->annotations;
    }

    function get_fastaURL() {
        return $this->fastaURL;
    }

    function get_tracks() {
        return $this->tracks;
    }
}

class Feature {
    // Properties
    public $feature;

    // Constructor
    function __construct($feature, $sequences) {
        $categories = array();
        $color = "";
        if ($feature['type'] == "cds") {
            $categories = lookup_cog($feature);
            $color = lookup_cog_color($categories);
        } elseif ($feature['type'] == "tRNA") {
            $color = "rgb(255,0,0)";
        } elseif ($feature['type'] == "rRNA") {
            $color = "rgb(0,255,100)";
        } else {
            $color = "rgb(100,0,0)";
        }
        
        $cog = array();
        if ($feature['type'] == 'cds') {
            $cogs = lookup_cog($feature);
            if (count($cogs) > 0) {
                $cog = lookup_cog_labels($cogs);
            } 
        }

        // Split into two feature when end < start
        if ($feature['stop'] < $feature['start']) {
            $seq = $sequences[$feature['contig']];
            $this->feature = array(
                array(
                    "chr" => $feature['contig'], 
                    "start" => $feature['start'] - 1,
                    "end" => mb_strlen($seq),
                    "strand" => $feature["strand"],
                    "type" => $feature["type"],
                    "color" => $color,
                    "locus" => $feature['locus'] ?? '',
                    "gene" => $feature['gene'] ?? '',
                    "product" => $feature['product'] ?? '',
                    "name" => $feature['product'] ?? '',
                    "cog" => $cog,
                ),
                array(
                    "chr" => $feature['contig'], 
                    "start" => 0,
                    "end" => $feature["stop"],
                    "strand" => $feature["strand"],
                    "type" => $feature["type"],
                    "color" => $color,
                    "locus" => $feature['locus'] ?? '',
                    "gene" => $feature['gene'] ?? '',
                    "product" => $feature['product'] ?? '',
                    "name" => $feature['product'] ?? '',
                    "cog" => $cog,
                )
            );
        } else {
            $this->feature = array(
                array(
                    "chr" => $feature['contig'], 
                    "start" => $feature['start'] - 1,
                    "end" => $feature["stop"],
                    "strand" => $feature["strand"],
                    "type" => $feature["type"],
                    "color" => $color,
                    "locus" => $feature['locus'] ?? '',
                    "gene" => $feature['gene'] ?? '',
                    "product" => $feature['product'] ?? '',
                    "name" => $feature['product'] ?? '',
                    "cog" => $cog,
                )
            );
        }
    }

    // Methods
    function get_feature() {
        return $this->feature;
    }
}

?>