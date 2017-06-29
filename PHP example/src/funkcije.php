<?php
function createQuery(){
    $splitQuery = [];

    if (!empty($_POST['name'])) {
        $splitQuery[] = 'contains(' . toUpperDiacriticInsensitive('ime') . ', "' . replace(mb_strtoupper($_POST['name']), "UTF-8") . '")';
    }

    if (!empty($_POST['field'])) {
        $splitQuery[] = "@podrucje='".$_POST['field']."'";
    }

    if (!empty($_POST['place'])) {
        $splitQuery[] = "adresa[contains(". replace(toUpperDiacriticInsensitive('mjesto')) . ", '". replace(mb_strtoupper($_POST['place']), 'UTF-8') . "')]";
    }

    if (!empty($_POST['numberOfStudents'])){
        $splitQuery[] ="studij[upis >= ".$_POST['numberOfStudents']."]";
    }

    if (!empty($_POST['model'])){
        $splitQuery[] ="studij[@model='".$_POST['model']."']";
    }

    if (!empty($_POST['hall'])){
        $splitQuery[]="sport[contains(". toUpperDiacriticInsensitive('dvorana').", '". mb_strtoupper($_POST['hall'], 'UTF-8'). "')]";
    }

    if (!empty($_POST['distanceToCoffee'])){
        $splitQuery[] = "ostalo/kafic[@udaljenost <=".$_POST['distanceToCoffee']."]";
    }

    if(!empty($_POST['food'])){
        $splitQuery[] = "ostalo[contains(". toUpperDiacriticInsensitive('menza').", '".mb_strtoupper($_POST['food'], 'UTF-8')."')]";
    }

    if(!empty($_POST['parking'])){
        $subquery = [];


        foreach ($_POST['parking'] as $polje) {
            $subquery[] = "ostalo/parkiraliste[@vrsta='".$polje."']";
        }

        $splitQuery[] = '(' . implode(' or ', $subquery) . ')';
    }

    if (!empty ($_POST['sport'])) {
        $subquery = [];

        foreach ($_POST['sport'] as $polje) {
            $subquery[] = "ekipa='".$polje."'";
        }

        $splitQuery[] = "sport[". implode(' and ', $subquery) ."]";
    }

    $returnQuery = implode(' and ', $splitQuery);

    if (!empty($returnQuery)) {
        return '/fakulteti/fakultet[' . $returnQuery . ']';
    }
    else return '/fakulteti';

}

function toUpperDiacriticInsensitive($string)
{
    return "translate(" . $string . ", 'abcdefghijklmnopqrstuvwxyzšđčćž', 'ABCDEFGHIJKLMNOPQRSTUVWXYZSĐCCZ')";
}

function getValue($node, $elementName)
{
    return $node->getElementsByTagName($elementName)->item(0)->nodeValue;
}



function getAttributeValue($node , $elementName ,$attributeName){
    $nodes = $node->getElementsByTagName($elementName);
    return $nodes->item(0)->getAttribute($attributeName);
}

function getChildNodes($node, $elementName){
    return $node->getElementsByTagName($elementName);
}

function replace($string){
    $string = str_replace("Č","C",$string);
    $string = str_replace("Ć","C", $string);
    $string = str_replace("Ž","Z", $string);
    $string = str_replace("Š","S",$string);
    return $string;
}


function getProfilePicture($facebookId){
    $JSONfile = file_get_contents("https://graph.facebook.com/v2.9/" . $facebookId . "?fields=picture{url}&access_token=226416197859556|e9d636dd65d8650560b98538c95eefb8");
    $decodedJSON[] = json_decode($JSONfile, true);
    return  $decodedJSON[0]['picture']['data']['url'] ;
}

function getLocation($facebookId){
    $JSONfile = file_get_contents("https://graph.facebook.com/v2.9/".$facebookId."?fields=location&access_token=226416197859556|e9d636dd65d8650560b98538c95eefb8");
    $decodedJSON = json_decode($JSONfile, true);
    $adress = array();

        if (isset($decodedJSON['location']['street'])) {
        $street = $decodedJSON['location']['street'];
        $adress[] =  $street;
    }

     if (isset($decodedJSON['location']['city'])) {
        $city = $decodedJSON['location']['city'];
        $adress[] =  $city;
     }

      if (isset($decodedJSON['location']['country'])) {
        $country = $decodedJSON['location']['country'];
        $adress[] =  $country;
     }
     return implode(" , ", $adress);
}

function getOfficialSite($facebookId){
    $JSONfile = file_get_contents("https://graph.facebook.com/v2.9/" . $facebookId . "?fields=website&access_token=226416197859556|e9d636dd65d8650560b98538c95eefb8");
    $decodedJSON = json_decode($JSONfile, true);
    return $decodedJSON['website'];
}

function getCoordinates($adress){
    $searchResults = simplexml_load_string(file_get_contents("http://nominatim.openstreetmap.org/search.php?q=" . rawurlencode($adress) . "&format=xml"));
     $coordinates = array();
     if (sizeof($searchResults) > 0){
        $coordinates['lat'] = $searchResults->place[0]->attributes()->lat;
        $coordinates['lon'] = $searchResults->place[0]->attributes()->lon;
     }
     else{
        $coordinates['lat'] = $searchResults->attributes()->lat;
        $coordinates['lon'] = $searchResults->attributes()->lon;
     }
     if (!isset($coordinates['lat']) OR !isset($coordinates['lat']) ) 
        $coordinates['lat'] = $coordinates['lon'] = "Unknown"; 
    return $coordinates;
 }

 function getJSONCoordinates($adress){
     $searchResults = (file_get_contents("http://nominatim.openstreetmap.org/search.php?q=" . rawurlencode($adress) . "&format=json"));
     $data = json_decode($searchResults, true);  
     $coordinates = array(); 

     if (sizeof($data) > 0){
        $coordinates['lat'] = $data[0]['lat'];
        $coordinates['lon'] = $data[0]['lon'];
     }
     if (!isset($coordinates['lat']) OR !isset($coordinates['lat']) ) 
        $coordinates['lat'] = $coordinates['lon'] = "Unknown";
    return $coordinates;
 }
 


    ?>