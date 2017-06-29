<script type="text/javascript" src="detalji.js"></script>
<?php
        $id =$_GET["id"];
        error_reporting(E_ALL);
        include('funkcije.php');
        $dom = new DOMDocument();
        $dom->load('podaci.xml');
        $xpath = new DOMXPath($dom);
        $query = '/fakulteti/fakultet[@id="' . $id .'"]';
        $ElementRezultata = $xpath->query($query)[0];


                $facebookid = getValue($ElementRezultata, "fid");
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

        echo '<p>Ime : '.$ime.'</p>';
        echo '<p>Područje : '.$podrucje.' </p>';
        echo '<p>Model : '.$model.'</p>';
        echo '<p>Upis : '.$upis.'<p>';
        echo '<p>Mjesto : '.$mjesto.'</p>';

        $counter = 0;
        foreach($sportovi as $element)
            $counter++;
        if ($counter > 0) {
            echo '<p class="center-text"> Sportovi </p>';
            foreach ($sportovi as $sport)
                echo '<p> ' . $sport->nodeValue . '</p>';
        }

        $counter = 0;
        foreach($parking as $element)
            $counter++;

        if ($counter > 0) {
            echo '<p class="center-text"> Parking </p>';
            foreach ($parking as $element)
                echo '<p> ' . $element->getAttribute('vrsta'). '</p>';
        }

        $counter = 0;
        foreach($kafici as $element)
            $counter++;

        if ($counter > 0) {
            echo '<p class="center-text"> Kafici u blizini </p>';
        foreach ($kafici as $element)
            echo '<p> ' . $element->nodeValue. '('.$element->getAttribute('udaljenost').' m )</p>';
}






       
