<?php 
require("connections/mysql.php"); 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" href="css/leaflet.css">
<!--[if lte IE 8]> 
		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" /> 
<![endif]--> 

<link rel="stylesheet" href="css/gh-pages.css">
<script src="js/leaflet.js"></script>
<script src="js/catiline.js"></script> 
<script src="js/leaflet.shpfile.js"></script> 
<style> 
html { 
	height: 100%; } 
body { 
	height: 100%; 
	margin: 0; 
	padding: 0; 
	} 
#map { 
height: 100% 
} 
</style> 


</head>
<div id="map"></div>
<?php

//
function lambert93ToWgs84($x, $y){
	$x = number_format($x, 10, '.', '');
	$y = number_format($y, 10, '.', '');
	$b6  = 6378137.0000;
	$b7  = 298.257222101;
	$b8  = 1/$b7;
	$b9  = 2*$b8-$b8*$b8;
	$b10 = sqrt($b9);
	$b13 = 3.000000000;
	$b14 = 700000.0000;
	$b15 = 12655612.0499;
	$b16 = 0.7256077650532670;
	$b17 = 11754255.426096;
	$delx = $x - $b14;
	$dely = $y - $b15;
	$gamma = atan( -($delx) / $dely );
	$r = sqrt(($delx*$delx)+($dely*$dely));
	$latiso = log($b17/$r)/$b16;
	$sinphiit0 = tanh($latiso+$b10*atanh($b10*sin(1)));
	$sinphiit1 = tanh($latiso+$b10*atanh($b10*$sinphiit0));
	$sinphiit2 = tanh($latiso+$b10*atanh($b10*$sinphiit1));
	$sinphiit3 = tanh($latiso+$b10*atanh($b10*$sinphiit2));
	$sinphiit4 = tanh($latiso+$b10*atanh($b10*$sinphiit3));
	$sinphiit5 = tanh($latiso+$b10*atanh($b10*$sinphiit4));
	$sinphiit6 = tanh($latiso+$b10*atanh($b10*$sinphiit5));
	$longrad = $gamma/$b16+$b13/180*pi();
	$latrad = asin($sinphiit6);
	$long = ($longrad/pi()*180);
	$lat  = ($latrad/pi()*180);
	
	return array(
		'lambert93' => array(
			'x' => $x,
			'y' => $y
		),
		'wgs84' => array(
			'lat' => $lat,
			'long' => $long
		)
	);
}

// Exemple d'utilisation :
	/*$x = 955502.7409000024;
	$y = 6225307.0799999982;
	print_r(lambert93ToWgs84($x,$y));*/

/* Résultat en sortie :
	Array
	(
    [lambert93] => Array
        (
            [x] => 955502.7409000024
            [y] => 6225307.0799999982
        )

    [wgs84] => Array
        (
            [lat] => 43.081387131355
            [long] => 6.1358573938246
        )
	)
	*/

?>
<script>

var m = L.map('map').setView([46.861, 2.343], 6);
/*var watercolor = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(m);*/
var OpenStreetMap_BlackAndWhite = L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(m);

/*
L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(mymap);
*/

/*

// affichage d'une couche .shp
var shpfile = new L.Shapefile('COMMUNE.zip', { 
		onEachFeature: function(feature, layer) { 
				if (feature.properties) { 
 					layer.bindPopup(Object.keys(feature.properties).map(function(k) { 
 						return k + ": " + feature.properties[k]; 
 					}).join("<br />"), { 
 						maxHeight: 200 
 					}); 
 				} 
 			} 
 		}); 
 		shpfile.addTo(m); 
 		shpfile.once("data:loaded", function() { 
 			console.log("finished loaded shapefile"); 
 		}); 

*/

</script>
<?php
// Xieme contributeur
$sql = 'SELECT Distinct couleur_dechet.code_postal, code_postal_commune.`ID,C,5`, commune_geofla.`NOM_COM,C,50`, commune_geofla.`X_CENTROID,N,7,0`, commune_geofla.`Y_CENTROID,N,7,0` 
FROM couleur_dechet, code_postal_commune, commune_geofla WHERE couleur_dechet.code_postal = code_postal_commune.`ID,C,5` AND code_postal_commune.`LIB,C,36` = commune_geofla.`NOM_COM,C,50`'; 

$res = $mysqli->query($sql);
$row = $res->fetch_assoc();
$res->data_seek(0);
echo '<script>';
        //echo '<tr><th>', implode('</th><th>', array_keys($row)), '</th></tr>'; 
        while ($row = $res->fetch_assoc()) { 
			//echo $row['X_CENTROID,N,7,0']."///".$row['Y_CENTROID,N,7,0']."<br>";
			 
			$point = lambert93ToWgs84($row['X_CENTROID,N,7,0'],$row['Y_CENTROID,N,7,0']);
			//echo $point['wgs84'][lat].','.$point['wgs84']['long'];
			//print_r $point;
			
			//
			echo 'var marker = L.marker(['.$point['wgs84']['lat'].','.$point['wgs84']['long'].']).addTo(m).bindPopup("'.$row['NOM_COM,C,50'].'<br>'.$row['code_postal'].'");';//.openPopup();';
			
        }   
	//
	echo '</script>';		
        //echo '</table>';
		
		

?>  
</body>
</html>