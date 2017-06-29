<!DOCTYPE html>
<html lang="hr">
<head>
    <link rel="stylesheet" type="text/css" href="dizajn.css">
    <script src="detalji.js"></script>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
    <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>


    <meta charset="UTF-8">
    <title>Rezultati pretrage</title>
</head>
<body>
<div class="header">
    <div class="picture-block">
        <a href="http://www.unizg.hr/">
            <img class="logo" src="./logo.png" alt="Logo">
        </a>
    </div>
    <div class="title">
        Fakulteti Sveučilišta u Zagrebu
    </div>
</div>
<div class="container">
    <div class="navigation-bar">
        <ul class="no-bullets">
            <li><a href="index.html">Početna stranica</a></li>
            <li><a href="obrazac.html">Pretraživanje</a></li>
            <li><a href="podaci.xml">XML</a></li>
            <li><a href="https://www.fer.unizg.hr/predmet/or">Otvoreno računarstvo</a></li>
            <li><a target="_blank" href="https://www.fer.unizg.hr/">FER</a></li>
            <li><a href="mailto:tomislav.dananic@fer.hr">Mail</a></li>
        </ul>
        <div id="Ispis_detalja" style="border: 2px black solid">

        </div>
    </div>
    <div class="content">
        <?php
        error_reporting(E_ALL);
        include('funkcije.php');
        $dom = new DOMDocument();
        $dom->load('podaci.xml');
        $xpath = new DOMXPath($dom);
        $query = createQuery();
        $rezultat = $xpath->query($query);
        if (!$rezultat->length)
            echo('<p class="bigFont center-text">Nije pronađen ni jedan podatak</p>');
        else{

            echo '<table class = "table-bordered"><tr><th>Ime</th><th>Područje</th><th>Model</th><th>Adresa</th><th>Službena stranica</th><th>Akcija</th></tr>';

            foreach ($rezultat as $ElementRezultata) {
                $facebookid = getValue($ElementRezultata, "fid");
                $id = $ElementRezultata->getAttribute("id");
                $ime = getValue($ElementRezultata, "ime");
                $podrucje = $ElementRezultata->getAttribute("podrucje");
                $mjesto = getValue($ElementRezultata, "mjesto");
                $pbr = getAttributeValue($ElementRezultata,"mjesto","pbr");
                $model = getAttributeValue($ElementRezultata, "studij", "model");
                $upis = getValue($ElementRezultata, "upis");
                $sportovi = getChildNodes($ElementRezultata, "ekipa");
                $parking = getChildNodes($ElementRezultata, "parkiraliste");
                $kafici = getChildNodes($ElementRezultata, "kafic");
                $pictureUrl = getProfilePicture($facebookid);
                $coordinates = getJSONCoordinates(getLocation($facebookid));

                echo'<tr onmouseover="changeColor(this)" onmouseleave="originalColor(this)">';
                echo'<td class="center-text"><a href="https://facebook.com/'. $facebookid .'">  <img class="fixedSize" src="'.$pictureUrl.'"/> <br/> '.$ime.'</a></td>';
                echo '<td>'.$podrucje.'</td>';
                echo '<td>'.$model.'</td>';
                echo '<td>'.getLocation($facebookid).'<br/>geografska dužina : '.$coordinates['lon'].'<br/>geografska širina : '.$coordinates['lat'].'</td>';
                echo '<td> <a href="'.getOfficialSite($facebookid).'">'.getOfficialSite($facebookid).'</a></td>';
                echo '<td>';
                echo ' <img class="search" src="search.png" alt="Detalji" onclick= "showDetails (';
                echo "'$id'";
                echo ');';
                echo 'showMap(';
                echo '\''.$coordinates['lat'].'\'';
                echo ",";
                echo '\''.$coordinates['lon'].'\'';
                echo ",";
                echo '\''.$ime.'\'';
                echo ",";
                echo '\''.getOfficialSite($facebookid).'\'';
                echo ",";
                echo '\''.getLocation($facebookid).'\'';
                echo ')"/>';
                echo '</td></tr>' ;
            }
        echo '</table>';
            echo  '<div id="news" style="width : 400px;"></div>';
            echo  '<div id="mapid" style="width: 400px; height: 400px"></div>';



        }
    ?>
    </div>
</div>
<div class="footer center-text ">
    <p>Autor: <span class="credentials">Dananić Tomislav</span><br>
        email: <span class="credentials">tomislav.dananic@fer.hr</span><br>
        Sveučilište u Zagrebu, Fakultet elektrotehnike i računarstva</p>
</div>
</body>
</html>

