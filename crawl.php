<?php

include("classes/DomDocumentParser.php");
function followLinks($url){
    $parser = new DomDocumentParser($url);
}
$startUrl = "https://www.google.com";
followLinks($startUrl)



?>