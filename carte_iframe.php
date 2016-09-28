<?php 
require("connections/mysql.php"); 
//
function couleur_to_html ($x) {
	switch ($x) {
		case "vert":
			return "green";
			break;
		case "rouge":
			return "red";
			break;
		case "bleu":
			return "blue";
			break;
		case "vert":
			return "green";
			break;
		case "blanc":
			return "white";
			break;
		case "jaune":
			return "yellow";
			break;
		case "gris":
			return "#585858";
			break;
		case "marron":
			return "#8A4B08";
			break;
		default:
		  return "black";
	}
};

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
;
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="jquery-ui-1.11.4.custom/jquery-ui.min.css">
<link rel="stylesheet" href="css/leaflet.css">
<link rel="stylesheet" href="css/gh-pages.css">
<script  charset="charset" src="js/leaflet.js"></script>
<script src="js/catiline.js"></script> 
<script src="js/leaflet.shpfile.js"></script> 
<script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script> 
<script src="jquery-ui-1.11.4.custom/external/jquery.ui.touch-punch/jquery.ui.touch-punch.min.js"></script> 
<script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<style> 

html { 
	height: 100%; } 
body { 
	height: 100%; 
	margin: 0; 
	padding: 0; 
	} 
#map { 
height: 95% ;
width:99%;
} 
#menu { 
height: 5% ;
} 
.logo-beta{
text-align:center;
text-transform:uppercase;
position:absolute;
top:26px;
right:-35px;
-webkit-transform:rotate(45deg);
transform:rotate(45deg);
width:150px;
background-color:#4B950F;
color:#fff;
padding:3px;
font-size:14px;
font-weight:400;
z-index:1000}

}
</style> 


</head>

<div id="map"></div>


<script>
var OpenStreetMap_BlackAndWhite = L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});


</script>
<script  charset="charset">

<?php
$overlayMaps="";
$layers="";
$sql = 'SELECT Distinct (couleur_dechet.dechet_type) as dechet_type FROM couleur_dechet;'; 
$res = $mysqli->query($sql);
$row = $res->fetch_assoc();
$res->data_seek(0);
$v1 = "";	
$type = "";
while ($row = $res->fetch_assoc()) { 		
	$type .= "A";
	$overlayMaps .= $v1.' "'.$row['dechet_type'].'": '.$type;
	$layers .= $v1.$type;
	$v1=", ";

	$layer = "var ".$type." = L.layerGroup(["; 	
	
	//requete des code postaux correspondant au type de déchet et donc au layer 
	
	/*SELECT a.`code_postal`, b.`code_postal` as `ID,C,5`, c.`NOM_COM,C,50`, 
			c.`X_CENTROID,N,7,0`, c.`Y_CENTROID,N,7,0` 
			FROM `couleur_dechet` a LEFT JOIN `code_insee_postal` b ON a.`code_postal` = b.`code_postal` LEFT JOIN `commune_geofla` c ON  b.`code_INSEE` = c.`INSEE_COM,C,5`
			WHERE dechet_type = "verre"; */
	
	$sql1 = 'SELECT Distinct(couleur_dechet.code_postal), `code_insee_postal`.`code_postal` as `ID,C,5`, commune_geofla.`NOM_COM,C,50`, 
			commune_geofla.`X_CENTROID,N,7,0`, commune_geofla.`Y_CENTROID,N,7,0` 
			FROM couleur_dechet, code_insee_postal, commune_geofla 
			WHERE couleur_dechet.code_postal = `code_insee_postal`.`code_postal` AND `code_insee_postal`.`code_INSEE` = commune_geofla.`INSEE_COM,C,5` AND dechet_type = "'.$row['dechet_type'].'";'; 
	$sql1 = 'SELECT a.`code_postal`, b.`code_postal` as `ID,C,5`, c.`NOM_COM,C,50`, 
			c.`X_CENTROID,N,7,0`, c.`Y_CENTROID,N,7,0` 
			FROM `couleur_dechet` a LEFT JOIN `code_insee_postal` b ON a.`code_postal` = b.`code_postal` LEFT JOIN `commune_geofla` c ON  b.`code_INSEE` = c.`INSEE_COM,C,5`
			WHERE dechet_type = "'.$row['dechet_type'].'";';
	$sql1 = 'SELECT a.`code_postal`, a.`code_INSEE` as code_INSEE, c.`NOM_COM,C,50`, c.`X_CENTROID,N,7,0`, c.`Y_CENTROID,N,7,0`, c.`geometrie`  
			FROM `couleur_dechet` a, `commune_geofla` c WHERE a.`code_INSEE` = c.`INSEE_COM,C,5` AND dechet_type = "'.$row['dechet_type'].'";';
	//echo $sql1;
	$res1 = $mysqli->query($sql1);
	$row1 = $res1->fetch_assoc();
	$res1->data_seek(0);
	$v = "";
	while ($row1 = $res1->fetch_assoc()) { 	
	
		$layer .= $v.$type."_".$row1['code_INSEE']; 
		$v = ", ";
		//$point = lambert93ToWgs84($row1['X_CENTROID,N,7,0'],$row1['Y_CENTROID,N,7,0']);		
		//$circle = "var ".$type."_".$row1['code_INSEE']." = L.circle([".$point['wgs84']['lat'].",".$point['wgs84']['long']."], 1000, {";
		$polygone = "var ".$type."_".$row1['code_INSEE']." = L.polygon(".$row1['geometrie'].", {";
		$popup = $row1['NOM_COM,C,50'].' ('.$row1['code_postal'].')<br><b>'.$row['dechet_type'].'</b><br>---------<br>';
				
		$sql2 = 'SELECT couleur_dechet.dechet_type, couleur_dechet.conteneur_couleur, count(*) as nb 
					FROM couleur_dechet
					WHERE couleur_dechet.code_INSEE = "'.$row1['code_INSEE'].'" AND couleur_dechet.dechet_type = "'.$row['dechet_type'].'" 
					GROUP BY conteneur_couleur 
					ORDER BY nb DESC ';
		$res2 = $mysqli->query($sql2);
		$row2 = $res2->fetch_assoc();
		$res2->data_seek(0);
		$nb = 0;
		while ($row2 = $res2->fetch_assoc()) { 	
		
			$popup .= $row2['conteneur_couleur']." : ".$row2['nb']." fois<br>";
	
			if ($nb == 0) {
				$couleur = couleur_to_html($row2['conteneur_couleur']);
				$nb = $row2['nb'];
			} else {
				if ($nb == $row2['nb']) { 
				$couleur = "black";
				} 
				else { 
					if ($nb < $row2['nb']) {$couleur = couleur_to_html($row2['conteneur_couleur']);};				
				};
			};
		}; 
		
		if($couleur == "black") {
		$polygone .= "color: '".$couleur."',
				fillColor: '".$couleur."',
				fillOpacity: 0.1,
				dashArray: '1, 5'
			})".'.bindPopup("'.$popup.'");';
		} else {
		$polygone .= "color: '".$couleur."',
				fillColor: '".$couleur."',
				fillOpacity: 0.7,
			})".'.bindPopup("'.$popup.'");';	
		};

			
		echo $polygone ;
	
	}  ; 				
	$layer .="]);";
	echo $layer	;
}  ; 
////////////////////////
?>  

var baseMaps = {
    //"Fond N&B": OpenStreetMap_BlackAndWhite
};

var overlayMaps = {
	<?php // echo $overlayMaps;?>
	  "bouteille plastique": AA,
  "canette": AAA, 
   "emballage carton": AAAAAA,
    "papier": AAAAAAA, 
	 "verre": AAAAAAAA,
 "dechet alimentaire": AAAA,  
  "barquette plastique": A,  
 "dechet non recyclable": AAAAA  
  
};

var m = L.map('map', {
    center: [46.861, 2.343],
    zoom:  6,
    layers: [OpenStreetMap_BlackAndWhite, AA<?php //echo $layers;?>]
});

var ctrlo = L.control.layers(overlayMaps,baseMaps,{collapsed: false}).addTo(m);
</script>
</body>
</html>