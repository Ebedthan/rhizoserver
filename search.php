<?php
include 'functions.php';
$xmlDoc = getXmlDoc();

$q = $_GET["q"];

if (strlen($q) > 0) {
    $xpath = new DOMXPath($xmlDoc);
    $query = "//link[contains(title, '$q')]";
    $links = $xpath->query($query);

    if ($links->length > 0) {
        $cpt = 0;
        $hint = "";
        foreach ($links as $link) {
            $title = $link->getElementsByTagName('title')->item(0)->nodeValue;
            $url = $link->getElementsByTagName('url')->item(0)->nodeValue;
            $hint .= "<a class='text-dark my-2' style='display: inline-block; text-decoration: none;' href='$url' target='_blank'><i class='bi bi-arrow-right-circle pe-3'></i>$title</a><br/>";
            $cpt += 1;
            if ($cpt == 15 ) {
                $hint .= "<a class='text-dark my-2' style='display: inline-block; text-decoration: none;' href='https://rhizoserver.org/genomes.php' target='_blank'><i class='bi bi-arrow-right-circle pe-3'></i>More results</a><br/>";
                break;
            }
        }
    } else {
        $hint = "No match found";
    }
} else {
    $hint = "Please enter a search query";
}

echo $hint;
?>