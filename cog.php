<?php
// colors taken from https://help.ezbiocloud.net/cog-colors/
define('cogMap', array(
    'J' => array(
        'color' => "#ff0000",
        'name' => "Translation, ribosomal structure and biogenesis",
        'class' => "INF",
    ),
    'A' => array(
        'color' => "#c2af58",
        'name' => "RNA processing and modification",
        'class' => "INF",
    ),
    'K' => array('color' => "#ff9900", 'name' => "Transcription", 'class' => "INF" ),
    'L' => array(
        'color' => "#ffff00",
        'name' => "Replication, recombination and repair",
        'class' => "INF",
    ),
    'B' => array(
        'color' => "#ffc600",
        'name' => "Chromatin structure and dynamics",
        'class' => "INF",
    ),
    'D' => array(
        'color' => "#99ff00",
        'name' => "Cell cycle control, cell division, chromosome partitioning",
        'class' => "CEL",
    ),
    'Y' => array( 'color' => "#493126", 'name' => "Nuclear structure", 'class' => "CEL" ),
    'V' => array( 'color' => "#ff008a", 'name' => "Defense mechanisms", 'class' => "CEL" ),
    'T' => array(
        'color' => "#0000ff",
        'name' => "Signal transduction mechanisms",
        'class' => "CEL",
    ),
    'M' => array(
        'color' => "#9ec928",
        'name' => "Cell wall/membrane/envelope biogenesis",
        'class' => "CEL",
    ),
    'N' => array( 'color' => "#006633", 'name' => "Cell motility", 'class' => "CEL" ),
    'Z' => array( 'color' => "#660099", 'name' => "Cytoskeleton", 'class' => "CEL" ),
    'W' => array( 'color' => "#336699", 'name' => "Extracellular structures", 'class' => "CEL" ),
    'U' => array(
        'color' => "#33cc99",
        'name' => "Intracellular trafficking, secretion, and vesicular transport",
        'class' => "CEL",
    ),
    'O' => array(
        'color' => "#00ffff",
        'name' => "Posttranslational modification, protein turnover, chaperones",
        'class' => "CEL",
    ),
    'C' => array(
        'color' => "#9900ff",
        'name' => "Energy production and conversion",
        'class' => "MET",
    ),
    'G' => array(
        'color' => "#805642",
        'name' => "Carbohydrate transport and metabolism",
        'class' => "MET",
    ),
    'E' => array(
        'color' => "#ff00ff",
        'name' => "Amino acid transport and metabolism",
        'class' => "MET",
    ),
    'F' => array(
        'color' => "#99334d",
        'name' => "Nucleotide transport and metabolism",
        'class' => "MET",
    ),
    'H' => array(
        'color' => "#727dcc",
        'name' => "Coenzyme transport and metabolism",
        'class' => "MET",
    ),
    'I' => array(
        'color' => "#5c5a1b",
        'name' => "Lipid transport and metabolism",
        'class' => "MET",
    ),
    'P' => array(
        'color' => "#0099ff",
        'name' => "Inorganic ion transport and metabolism",
        'class' => "MET",
    ),
    'Q' => array(
        'color' => "#ffcc99",
        'name' => "Secondary metabolites biosynthesis, transport and catabolism",
        'class' => "MET",
    ),
    'R' => array(
        'color' => "#ff9999",
        'name' => "General function prediction only",
        'class' => "POO",
    ),
    'S' => array( 'color' => "#d6aadf", 'name' => "Function unknown", 'class' => "POO" ),
    'X' => array( 'color' => "#d6aadf", 'name' => "Function unknown", 'class' => "POO" ),
    'INF' => array( 'name' => "INFORMATION STORAGE AND PROCESSING", 'color' => "#FF0000" ),
    'CEL' => array( 'name' => "CELLULAR PROCESSES AND SIGNALING", 'color' => "#0000FF" ),
    'MET' => array( 'name' => "METABOLISM", 'color' => "#00FF00" ),
    'POO' => array( 'name' => "POORLY CHARACTERIZED", 'color' => "#000000" ),
));

// taken from https://ftp.ncbi.nih.gov/pub/COG/COG2020/data/fun-20.tab
define('ncbiCogMap', array(
    "J" => array("name" => "Translation, ribosomal structure and biogenesis", "color" => "#FCCCFC" ),
    "A" => array("name" => "RNA processing and modification", "color" => "#FCDCFC" ),
    "K" => array("name" => "Transcription", "color" => "#FCDCEC" ),
    "L" => array("name" => "Replication, recombination and repair", "color" => "#FCDCDC" ),
    "B" => array("name" => "Chromatin structure and dynamics", "color" => "#FCDCCC" ),
    "D" => array("name" => "Cell cycle control, cell division, chromosome partitioning", "color" => "#FCFCDC" ),
    "Y" => array("name" => "Nuclear structure", "color" => "#FCFCCC" ),
    "V" => array("name" => "Defense mechanisms", "color" => "#FCFCBC" ),
    "T" => array("name" => "Signal transduction mechanisms", "color" => "#FCFCAC" ),
    "M" => array("name" => "Cell wall/membrane/envelope biogenesis", "color" => "#ECFCAC" ),
    "N" => array("name" => "Cell motility", "color" => "#DCFCAC" ),
    "Z" => array("name" => "Cytoskeleton", "color" => "#CCFCAC" ),
    "W" => array("name" => "Extracellular structures", "color" => "#BCFCAC" ),
    "U" => array("name" => "Intracellular trafficking, secretion, and vesicular transport", "color" => "#ACFCAC" ),
    "O" => array("name" => "Posttranslational modification, protein turnover, chaperones", "color" => "#9CFCAC" ),
    "X" => array("name" => "Mobilome: prophages, transposons", "color" => "#9CFC9C" ),
    "C" => array("name" => "Energy production and conversion", "color" => "#BCFCFC" ),
    "G" => array("name" => "Carbohydrate transport and metabolism", "color" => "#CCFCFC" ),
    "E" => array("name" => "Amino acid transport and metabolism", "color" => "#DCFCFC" ),
    "F" => array("name" => "Nucleotide transport and metabolism", "color" => "#DCECFC" ),
    "H" => array("name" => "Coenzyme transport and metabolism", "color" => "#DCDCFC" ),
    "I" => array("name" => "Lipid transport and metabolism", "color" => "#DCCCFC" ),
    "P" => array("name" => "Inorganic ion transport and metabolism", "color" => "#CCCCFC" ),
    "Q" => array("name" => "Secondary metabolites biosynthesis, transport and catabolism", "color" => "#BCCCFC" ),
    "R" => array("name" => "General function prediction only", "color" => "#E0E0E0" ),
    "S" => array("name" => "Function unknown", "color" => "#CCCCCC" ),
));

function lookup_cog_color($coglist) {
    $color = '';

    if (count($coglist) > 0) {
        $arr = array();
        foreach($coglist as $cog) {
            if (isset(cogMap[$cog]) && isset(cogMap[$cog]['color'])) {
                $arr = cogMap[$cog]['color'];
                $color = $arr[0];
            } else {
                $color = cogMap["S"]['color'];
            }
        }
    } else {
        $color = cogMap["S"]['color'];
    }

    return $color;
}

function lookup_cog_group_color($coglist) {
    $group_color = '';
    
    if (count($coglist) > 0) {
        $arr = array();
        foreach($coglist as $cog) {
            if (isset(cogMap[$cog]) && isset(cogMap[$cog]['color'])) {
                $arr = cogMap[cogMap[$cog]['class']]['color'];
                $group_color = $arr[0];
            } else {
                $group_color = cogMap["POO"]['color'];
            }
        }
    } else {
        $group_color = cogMap["POO"]['color'];
    }

    return $group_color;
}

function lookup_cog_labels($coglist) {
    $labels = array();

    foreach($coglist as $cog) {
        if (isset(cogMap[$cog]) && isset(cogMap[$cog]['name'])) {
            array_push($labels, $cog . " - " . cogMap[$cog]['name']);
        } else {
            array_push($labels, $cog . " - ");
        }
    }

    return $labels;
}
?>