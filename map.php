<!DOCTYPE html>
<html>
<head>
	
	<title>CMEvents</title>

	<meta charset="utf-8" />
	

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


	
</head>
<body>

<a href="index.php"> Retour à la page d'accueil </a>
<br>

<div id="mapid" style="width: 1000px; height: 700px;"></div>
<?php if(isset($_GET['lat']) && isset($_GET['long'])) {
	$lat=isset($_GET['lat']);
	$long=isset($_GET['long']);
?>
<script>

	var mymap = L.map('mapid').setView([<?php echo $_GET["lat"]; ?>, <?php echo $_GET["long"]; ?>], 10);

	L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox/streets-v11'
	}).addTo(mymap);

	L.marker([<?php echo $_GET["lat"]; ?>, <?php echo $_GET["long"]; ?>]).addTo(mymap)
		.bindPopup("L'évènement se passe ici").openPopup();

	

</script>
<?php
}
	
?>

</body>
</html>