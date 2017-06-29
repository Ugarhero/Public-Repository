var XMLrequest;
var newsXMLrequest;
var url;
var map;
var row = -1;

function changeColor(red){
	red.style.background = "#FAABCD";
}

function originalColor(red) {
    red.style.background="#FFFFFF";

}

function showDetails(id){
	var detalji = document.getElementById("Ispis_detalja");
	detalji.style.visibility = "visible";
	detalji.innerHTML =  '<img class="search" style="margin: 40%" id="detailsLoader"src="loader.gif" alt="Molimo pričekajte!" />'
    if (window.XMLHttpRequest) { // FF, Safari, Opera, IE7+
        XMLrequest = new XMLHttpRequest(); // stvaranje novog objekta
    } else if (window.ActiveXObject) { // IE 6+
        XMLrequest = new ActiveXObject("Microsoft.XMLHTTP"); //ActiveX
    }
    if (XMLrequest) { // uspješno stvoren objekt
        url = "detalji.php?id="+id + "";
        XMLrequest.onreadystatechange = processQuery;
        XMLrequest.open("GET", url, true); // metoda, URL, asinkroni na?in
        XMLrequest.send(null); //slanje (null za GET, podaci za POST)
    }
}


function showMap(lat, lon, naziv, stranica, lokacija){
    document.getElementById('mapid').style.visibility = "visible";
    document.getElementById('mapid').style.display = "block";
    console.log(naziv + " " + stranica + " "+ lokacija);

   if (lat != "Unknown" && lon != "Unknown"){
    document.getElementById('mapid').innerHTML ='<img class="search" style="margin: 40%" id="detailsLoader"src="loader.gif" alt="Molimo pričekajte!" />'
    document.getElementById('mapid').innerHTML = '<div id="insideMapa" style="height: 100%; width: 100%"></div>';
    map = L.map('insideMapa', {scrollWheelZoom: false, tap: false}).setView([parseFloat(lat),parseFloat(lon)], 16);
    L.tileLayer('http://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
        maxZoom: 50,
        attribution:  '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var marker = L.marker([lat, lon]).addTo(map);
    marker.bindPopup("<h3><b>" + naziv + "</b></h3><b>Širina : </b>" + lat + "<br><b>Dužina : </b>" + lon + "<br><b>Adresa : </b>" + lokacija +'<br><a target="_blank" href="' + stranica + '">' + "Službena stranica"+ '</a>').openPopup();

   }
    else
    document.getElementById('mapid').innerHTML ='<p style="width: 100%; height: 100%">Nisu pronađene koordinate za traženi upit</p>'

}

function processQuery() {

    if (XMLrequest.readyState == 4) {
        if (XMLrequest.status == 200) { // sve ok
            document.getElementById('Ispis_detalja').innerHTML = XMLrequest.responseText;
        }
        else { // nije ok
            alert("Nije 200 OK, greška:\n" + XMLrequest.statusText);
        }
    }
}

function wait(ms)
{
    var d = new Date();
    var d2 = null;
    do { d2 = new Date(); }
    while(d2-d < ms);
}



function getNews() {
    if (window.XMLHttpRequest) { // FF, Safari, Opera, IE7+
        newsXMLrequest = new XMLHttpRequest(); // stvaranje novog objekta
    } else if (window.ActiveXObject) { // IE 6+
        newsXMLrequest = new ActiveXObject("Microsoft.XMLHTTP"); //ActiveX
    }
    if (newsXMLrequest) { // uspješno stvoren objekt
        newsXMLrequest.onreadystatechange = showNews;
        newsXMLrequest.open("GET", "vijesti.txt", true); // metoda, URL, asinkroni na?in
        newsXMLrequest.send(null); //slanje (null za GET, podaci za POST)
    }
}

function showNews() {

    if (newsXMLrequest.readyState == 4) {
        if (newsXMLrequest.status == 200) { // sve ok
            var file = newsXMLrequest.responseText;
            row = (row +1) % file.trim().split("\n").length;
            file = file.split("\n");

            document.getElementById('news').innerHTML = file[row];
        }
        else { // nije ok
            alert("Nije 200 OK, greška:\n" + newsXMLrequest.statusText);
        }
    }
}

window.setInterval(function(){
    getNews();
}, 1000);



