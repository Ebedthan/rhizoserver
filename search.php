<?php
$xmlDoc = new DOMDocument();
$xmlDoc->load("genomes.xml");

$x = $xmlDoc->getElementsByTagName('link');

// Get the q parameter from URL
$q = $_GET["q"];

// Lookup all links from the xml file if length of q > 0
if (strlen($q) > 0) {
    $hint = "";
    for ($i = 0; $i < ($x->length); $i++) {
        $y = $x->item($i)->getElementsByTagName('title');
        $z = $x->item($i)->getElementsByTagName('url');

        if ($y->item(0)->nodeType == 1) {
            // Find a link matching the search text
            if (stristr($y->item(0)->childNodes->item(0)->nodeValue, $q)) {
                if ($hint == "") {
                    $hint = "<a class='text-dark my-2' style='display: inline-block; text-decoration: none;' href='" . $z->item(0)->childNodes->item(0)->nodeValue . "' target='_blank'><i class='bi bi-arrow-right-circle pe-3'></i>" . $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
                } else {
                    $hint = $hint . "<br/><a class='text-dark my-2' style='display: inline-block; text-decoration: none;' href='" . $z->item(0)->childNodes->item(0)->nodeValue . "' target='_blank'><i class='bi bi-arrow-right-circle pe-3'></i>" . $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
                }
            }
        }
    }
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint == "") {
    $response = "No match found";
} else {
    $response = $hint;
}

echo $response;
?>