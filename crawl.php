<?php

include("classes/DomDocumentParser.php");
// SCHEME - HTTP
// HOST  - www.google.com
// TYPES OF RELATIVE LINKS
/*
/about/about.php -> https://www.google.com/about/about.php
./about/aboutUs.php
../about/aboutUs.php
about/aboutUs.php
*/
// CONVERSION PROCESS

/*
SCHEME + HOST + RELATIVE LINKS


*/

// REMOVING UNWANTED LINKS
/*
 RELATIVE LINKS  - SHORT LINKS  (ALSO SPAM)
 */

 $alreadyCrawled = array();
 $crawling = [];

// FUNCTION TO CONVERT RELATIVE LINSK TO ABSOLUTE LINKIS
function createLink($src, $url){
    
    $scheme = parse_url($url)["scheme"];
    $host = parse_url($url)["host"];

    // CONVERTING THE RELATIVE LINKS TO ABSOLUTE
    if(substr($src, 0, 2) == "//"){
        $src = $scheme . ":" . $src;
    }else  if(substr($src, 0, 1) == "/"){
        $src = $scheme . "://" . $host . $src;
    }else if(substr($src, 0, 2) == "./"){
        $src = $scheme  . "://" . $host . dirname(parse_url($url)["path"]) . substr($src, 1);
    }else if(substr($src, 0, 3) == "../"){
        $src = $scheme  . "://" . $host . "/" . $src;
    }else if(substr($src, 0, 5) == "https" && substr($src, 0, 4) != "http"){
        $src = $scheme . "://" . $host . "/"  .$src;
    }

    return $src;
}


function followLinks($url){

    global $alreadyCrawled;
    global $crawling;
    $parser = new DomDocumentParser($url);

    // PARSING EACH LINK
    $linkList = $parser->getlinks();
    // GETTING EACH LINK
    foreach($linkList as $link){
        $href = $link->getAttribute('href');
        
        // IGNORING THE UNWANTED LINKS
        if(strpos($href, "#") !== false){
            continue;
        }else if(substr($href, 0, 11) == "javascript:"){
            continue;
        }
        
       $href = createLink($href, $url);
        if(!in_array($href, $alreadyCrawled)){
            $alreadyCrawled[] = $href;;
            $crawling[]  =$href;
        }
       echo $href . "<br>";
    }

    array_shift($crawling);

    foreach($crawling as site){
        followLinks($site);
    }

}
$startUrl = "https://www.bbc.com";
followLinks($startUrl)



?>