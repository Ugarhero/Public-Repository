<!DOCTYPE html>
<html lang="hr">
<head>
    <link rel="stylesheet" type="text/css" href="dizajn.css">
    <meta charset="UTF-8">
    <title>Pretraživanje</title>
</head>

<body>
<div class="header">
    <div class="picture-block">
        <a href="http://www.unizg.hr/">
            <img class="logo" src="./logo.png" alt="Logo"/>
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
            <li><a class="selected" href="obrazac.html">Pretraživanje</a></li>
            <li><a href="podaci.xml">XML</a></li>
            <li><a href="https://www.fer.unizg.hr/predmet/or">Otvoreno računarstvo</a></li>
            <li><a target="_blank" href="https://www.fer.unizg.hr/">FER</a></li>
            <li><a href="mailto:tomislav.dananic@fer.hr">Mail</a></li>
        </ul>
    </div>
    <div class="content">
        <h2 class="center-text">Obrazac za pretraživanje</h2>
        <form action="pretraga.php" method="post">
            <table class="center">
                <tr class="center-text">
                    <td colspan="2"><br><b>Fakultet</b></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><br></td>
                </tr>
                <tr>
                    <td>Naziv :</td>
                    <td><input type="text" name="name" id="name"></td>
                </tr>
                <?php
                error_reporting(E_ALL);
                include('funkcije.php');
                $dom = new DOMDocument();
                $dom->load('podaci.xml');
                $query = '//fakultet';
                $xpath = new DOMXPath($dom);
                $fakulteti = $xpath->query($query);

                echo '<tr class="center">
                    <td colspan="2"><b>Područje</b></td>';

                $podrucje[] = array("");

                foreach ($fakulteti as $fakultet) {

                    if (!in_array($fakultet->getAttribute("podrucje"), $podrucje)) {
                        array_push($podrucje, $fakultet->getAttribute("podrucje"));
                        echo '<tr><td colspan="2" class="center"><input type="radio" name="field" value="' . $fakultet->getAttribute("podrucje") . '">' . $fakultet->getAttribute("podrucje") . '</td></tr>';
                    }
                }
                ?>


                <tr class="center-text">
                    <td colspan="2"><br><b>Adresa</b></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td>Mjesto</td>
                    <td><input type="text" name="place"></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td colspan="2" class="center-text"><b>Studiranje</b></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td>Minimalan broj mjesta za upis</td>
                    <td><input type="text" name="numberOfStudents"></td>
                </tr>
                <tr>
                    <td rowspan="4">Model studiranja</td>
                    <td><input type="radio" name="model" value="3+2">Preddiplomski 3 godine i diplomski 2 godine</td>
                </tr>
                <tr>
                    <td><input type="radio" name="model" value="3.5+1.5">Preddiplomski 3.5 godine i diplomski 1.5 godina
                    </td>
                </tr>
                <tr>
                    <td><input type="radio" name="model" value="4+1">Preddiplomski 4 godine i diplomski 1 godina</td>
                </tr>
                <tr>
                    <td><input type="radio" name="model" value="5+0">5 godina</td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td colspan="2" class="center-text"><b>Sport</b></td>
                </tr>
                <tr>
                    <td rowspan="2">Dvorana u sklopu faxa</td>
                    <td><input type="radio" name="hall" value="Da">Da</td>
                </tr>
                <tr>
                    <td><input type="radio" name="hall" value="Ne">Ne</td>
                </tr>
                <tr>
                    <td colspan="3" class="center-text"><br>Športovi u kojima se studenti fakulteta natječu</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="sport[]" value="Kosarka">Košarka</td>
                    <td><input type="checkbox" name="sport[]" value="Nogomet">Nogomet</td>
                    <td><input type="checkbox" name="sport[]" value="Rukomet">Rukomet</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="sport[]" value="Odbojka">Odbojka</td>
                    <td><input type="checkbox" name="sport[]" value="Badminton">Badminton</td>
                    <td><input type="checkbox" name="sport[]" value="Veslanje">Veslanje</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="sport[]" value="Stolni tenis">Stolni tenis</td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td colspan="2" class="center-text"><br><br><b>Ostali sadržaj</b></td>
                </tr>
                <tr>
                    <td>Radijus za pretragu kafića u okolici( u metrima )</td>
                    <td><input type="text" name="distanceToCoffee"></td>
                </tr>
                <tr>
                    <td rowspan="2">Menza</td>
                    <td><input type="radio" name="food" value="Da">U prostorijama fakulteta</td>
                </tr>
                <tr>
                    <td><input type="radio" name="food" value="Ne">Van prostora fakulteta</td>
                </tr>
                <tr>
                    <td rowspan="3">Parkiranje</td>
                    <td><input type="checkbox" name="parking[]" value="Nema">Nema parkirališta</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="parking[]" value="Nenaplatni">Nenaplatni parking</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="parking[]" value="Naplatni">Naplatni parking</td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr class="center-text center">
                    <td><input type="submit" value="Traži"></td>
                    <td><input type="reset" value="resetiraj"></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<div class="footer center-text">
    <p>Autor: <span class="credentials">Dananić Tomislav</span><br>
        email: <span class="credentials">tomislav.dananic@fer.hr</span><br>
        Sveučilište u Zagrebu, Fakultet elektrotehnike i računarstva
    </p>
</div>
</body>
</html>