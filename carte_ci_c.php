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
<script  charset="charset" src="js/leaflet-search.js"></script>
<script  charset="charset" src="commune.json"></script>

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
<div class="logo-beta">bêta</div>
<div id="map"></div>

<ul id="menu" class="nav nav-pills">
	<li role="presentation" ><a href="./">accueil</a></li>	
	<li role="presentation" ><a href="contribuer.php">contribuer</a></li>
	<li role="presentation" class="active"><a href="#">consulter</a></li>		
</ul>
<script>





var OpenStreetMap_BlackAndWhite = L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});

/*var OpenStreetMap_BlackAndWhite = L.tileLayer('http://mapsref.brgm.fr/wxs/carmen_refcom/FXX_RefIGN-RGF?version=1.3.0&service=WMS&request=GetLegendGraphic&sld_version=1.1.0&layer=GEOFLA_COMMUNE&format=image/png&STYLE=default', {
	maxZoom: 18,
	//attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});*/







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
	$sql1 = 'SELECT a.`code_postal`, a.`code_INSEE` as code_INSEE, c.`NOM_COM,C,50`, c.`X_CENTROID,N,7,0`, c.`Y_CENTROID,N,7,0` 
			FROM `couleur_dechet` a, `commune_geofla` c WHERE a.`code_INSEE` = c.`INSEE_COM,C,5` AND dechet_type = "'.$row['dechet_type'].'";';
	//echo $sql1;
	$res1 = $mysqli->query($sql1);
	$row1 = $res1->fetch_assoc();
	$res1->data_seek(0);
	$v = "";
	while ($row1 = $res1->fetch_assoc()) { 	
	
		$layer .= $v.$type."_".$row1['code_INSEE']; 
		$v = ", ";
		$point = lambert93ToWgs84($row1['X_CENTROID,N,7,0'],$row1['Y_CENTROID,N,7,0']);		
		$circle = "var ".$type."_".$row1['code_INSEE']." = L.circle([".$point['wgs84']['lat'].",".$point['wgs84']['long']."], 1000, {";
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
		$circle .= "color: '".$couleur."',
				fillColor: '".$couleur."',
				fillOpacity: 0.1,
				dashArray: '1, 5'
			})".'.bindPopup("'.$popup.'");';
		} else {
		$circle .= "color: '".$couleur."',
				fillColor: '".$couleur."',
				fillOpacity: 0.7,
			})".'.bindPopup("'.$popup.'");';	
		};

			
		echo $circle ;
	
	}  ; 				
	$layer .="]);";
	echo $layer	;
}  ; 
////////////////////////
?>  




var baseMaps = {
    "Fond N&B": OpenStreetMap_BlackAndWhite
};

var overlayMaps = {
	<?php echo $overlayMaps;?>
  
};

var m = L.map('map', {
    center: [46.861, 2.343],
    zoom:  6,
	//zoom: 5,
      center: center,
      maxZoom:11,
      minZoom:5,
      maxBounds:new L.LatLngBounds(new L.LatLng(-90,-180), new L.LatLng(90,180)),
      attributionControl:false,
    layers: [OpenStreetMap_BlackAndWhite, <?php //echo $layers;?>]
});
////////////




////////////
  var geojsonLayer = new L.geoJson("",
   {
      style: {
         fill:true,
         weight: 2,
         color: "#ff2b2b",
         fillOpacity:0,
         opacity: 1.0
      },
	  setZIndex: 999
   }
   );
   m.addLayer(geojsonLayer);


var search_url = 'https://cartoradon.irsn.fr/commune.py/communes/search/'+region+'/{s}?';
	var searchControl = new L.Control.Search({
			url: search_url,
			jsonpParam: 'json_callback',
			propertyName: 'display_name',
			propertyLoc: ['lat','lon'],
			//markerLocation: true,
			autoType: false,
			autoCollapse: false,
			minLength: 1,
			setZIndex: 1000,
         zoom:10,
         animateLocation:false,
         position:'topright'
      });
   m.addControl(searchControl);
   //searchControl.setZIndex(10000)
   searchControl.expand();

   function onMapClick(e) {
      search_by_click(e.latlng);
   }
   m.on('click', onMapClick);
  

  
 function getParameterByName(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
      results = regex.exec(location.search);
  return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

   var region = getParameterByName("region");
   var center = new L.latLng([46.575730,1.002411]);
   var bounds = {
      FR:[-5.13901728543322,41.3627574255214,9.55982331816636,51.0890003095844],
      GUY:[-54.60235713437,2.11315570119411,-51.6190658242322,5.74779996205998],
      WFU:[-178.18168289749,-14.3619799344606,-176.125334496582,-13.1832208905756],
      ANT:[-63.1533454198157,14.3886464183116,-60.8096712277906,18.1249059280772],
      PF:[-154.688170100842,-27.912553373677,-134.468501910636,-7.82849979400622],
      NC:[163.570240062785,-22.7619312515325,168.134104579206,-19.5257662015969],
      MAY:[45.0180759429933,-12.9993705749512,45.299524307251,-12.6367092132568],
      SPM:[-56.5179318370501,46.749023080844,-56.0829265481349,47.1444958490042],
      REU:[55.2175488082356,-21.3880649846678,55.8343097099672,-20.8717263092887]
   };

   var texts = [];
   texts[0] = "Potentiel faible";
   texts[1] = "Potentiel faible mais facteurs géologiques susceptibles de faciliter les transferts";
   texts[2] = "Potentiel moyen ou élevé";
   if(!(region in bounds)) {
     region = 'FR';
   }
   if(region in bounds) {
     var bnds = bounds[region];
   /* make our bounds squareish so we get to choose a reasonable zoom level */
     var dx = bnds[2]-bnds[0];
     var dy = bnds[3]-bnds[1];
     var my = (bnds[1]+bnds[3])/2.0;
     var mx = (bnds[0]+bnds[2])/2.0;
     if(dx>dy) {
       /* expand y */
       var f = dx/dy;
       bnds[1] = my + (bnds[1]-my)*f;
       bnds[3] = my + (bnds[3]-my)*f;
     } else {
       /* expand y */
       var f = dy/dx;
       bnds[0] = mx + (bnds[0]-mx)*f;
       bnds[2] = mx + (bnds[2]-mx)*f;
     }
     m.fitBounds(new L.LatLngBounds(
           new L.LatLng(bnds[1],bnds[2]),
           new L.LatLng(bnds[3],bnds[0])),null);

   }

////////////////// test geoJSON geofla simplifié

var myLayer = L.geoJson().addTo(m);
myLayer.addData(communes);
  
   
   
   
///////////////////


var ctrlo = L.control.layers(baseMaps, overlayMaps,{collapsed: false}).addTo(m);
</script>
</body>
</html>