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
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"> 

<link rel="shortcut icon" href="favicon.ico" >
<link rel="icon" type="image/gif" href="animated_favicon1.gif" >
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="jquery-ui-1.11.4.custom/jquery-ui.min.css">
<link rel="stylesheet" href="css/leaflet.css">
<link rel="stylesheet" href="css/leaflet-search.css">
<script src="jquery-ui-1.11.4.custom/external/jquery/jquery.js"></script> 
<script src="jquery-ui-1.11.4.custom/jquery-ui.min.js"></script>
<script src="jquery-ui-1.11.4.custom/external/jquery.ui.touch-punch/jquery.ui.touch-punch.min.js"></script> 
<script src="js/bootstrap.min.js"></script>
<link href="./css/carousel.css" rel="stylesheet">
<script  charset="charset" src="js/leaflet.js"></script>
<script  charset="charset" src="js/leaflet-search.js"></script>
<style> 

html { 
	height: 100%; } 
body { 
	height: 95%; 
	margin: 0; 
	padding: 0; 
	} 
	
.logo-beta{
text-align:center;
text-transform:uppercase;
position:absolute;
top:26px;
right:-35px;
-webkit-transform:rotate(45deg);
transform:rotate(45deg);
-webkit-filter: opacity(40%);
filter: opacity(40%); 
width:150px;
background-color:#4B950F;
color:#fff;
padding:3px;
font-size:14px;
font-weight:400;
z-index:9999}
}

#menu_3 {
    margin-bottom: 0;
    border: 0;
	-webkit-filter: opacity(90%) ;
	filter: opacity(90%) ; 
    border-radius: 0;
}
.center {
     margin: auto;
    // width: 50%;
    // border: 3px solid green;
    padding: 10px;
	position: relative;
	padding-top: 12px;
	
}
.centrage {
margin: auto;
text-align: center;
}

#map { 
margin-top : 60px;
height: 97% ;
} 



/* Smartphones ----------- */
@media only screen and (max-width: 760px) {
  #xs { display: none; }
}
</style> 


</head>
<body>
<div id="xs"></div>
<div id="fb-root"></div>
				<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
				</script>
<div class="logo-beta">bêta</div>

<!-- NAVBAR
================================================== -->	 
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<ul id="menu_3" class="nav nav-pills center text-center">
				<!--menu smartphone -->
				<li  role="presentation"  class="dropdown  visible-xs-block">				 
						<a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu3" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-menu-hamburger"></span>
						</a>			
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu3">
								<li role="presentation"><a href="./"><span class="glyphicon glyphicon-home"></span> accueil</a></li>
								<li role="presentation"><a href="contribuer.php"><span class="glyphicon glyphicon-hand-right"></span> contribuer</a></li>
								<li role="presentation"><a href="carte.php"><span class="glyphicon glyphicon-eye-open"></span> consulter</a></li>
								<li role="presentation"><a href="savoir_plus.php"><span class="glyphicon glyphicon-info-sign"></span> en savoir plus</a></li>				
						</ul>
					
				</li>
				<!--menu smartphone -->
				
				<!--menu pc tablette -->
				<li role="presentation" class="hidden-xs"><a href="./"><span class="glyphicon glyphicon-home"></span><span class="hidden-xs"> accueil</span></a></li>
				<li role="presentation" class="hidden-xs"><a href="contribuer.php"><span class="glyphicon glyphicon-hand-right"></span> <span class="hidden-xs">contribuer</span></a></li>
				<li role="presentation" class="hidden-xs"><a href="carte.php"><span class="glyphicon glyphicon-eye-open"></span> <span class="hidden-xs">consulter</span></a></li>
				<li role="presentation" class="hidden-xs"><a href="savoir_plus.php"><span class="glyphicon glyphicon-info-sign"></span> <span class="hidden-xs">en savoir plus</span></a></li>				
				<!--menu pc tablette -->
				
				<!--menu dropdown twitter -->
				<li  role="presentation" class="dropdown">
						 <a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenuTwt3" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<span>
							<img class="img-responsive" style="height : 20px; width :20px;" src="img/twt.png">
							</span>
						</a>
						
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuTwt3">
								<li role="presentation">
									<a href="https://twitter.com/ruche_pp" target="_blank">
										<span>
											<img class="img-responsive" style="height : 20px; width :20px;" src="img/twt.png">
										</span>
									</a>
								</li>
								<li role="separator" class="divider"></li>
								<li role="presentation" style="padding-left: 10px;padding-right: 10px;">		
									<a href="https://twitter.com/ruche_pp" class="twitter-follow-button" data-lang="fr" data-show-count="true">Follow @ruche_pp</a>
										<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
								</li>
								<li role="presentation" style="padding-left: 10px;padding-right: 10px;">
									<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://communeruche.fr/trashadvisor/" data-via="ruche_pp" data-lang="fr" 
											data-related="ruche_pp" data-hashtags="trashadvisor, poubselfy">Tweeter</a> 
									<script>
										!function(d,s,id){
												var js,
												fjs=d.getElementsByTagName(s)[0],
												p=/^http:/.test(d.location)?'http':'https';
												if(!d.getElementById(id)){
													js=d.createElement(s);
													js.id=id;
													js.src=p+'://platform.twitter.com/widgets.js';
													fjs.parentNode.insertBefore(js,fjs);
													}
											}(document, 'script', 'twitter-wjs');
									</script>
								</li>								
						</ul>
					
				</li>
				<!--menu dropdown twitter -->
				<!--menu dropdown facebook -->
				<li  role="presentation" class="dropdown">
					
						<a class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenuFB3" href="#" role="button" aria-haspopup="true" aria-expanded="false">
							<span>
							<img class="img-responsive" style="height : 20px; width :20px;" src="img/fb.png">
							</span>
						</a>
						
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuFB3">
								<li role="presentation">
									<a href="https://www.facebook.com/trashadvisorcommuneruche/" target="_blank">
										<span>
											<img class="img-responsive" style="height : 20px; width :20px;" src="img/fb.png">
										</span>
									</a>
								</li>
								<li role="separator" class="divider"></li>
								<li  role="presentation" style="padding-left: 10px;padding-right: 10px;"><div class="fb-follow" data-href="https://www.facebook.com/trashadvisorcommuneruche/" data-layout="standard" data-size="small" data-show-faces="true"></div></li>
								<li  role="presentation" style="padding-left: 10px;padding-right: 10px;"><div class="fb-like" data-href="http://communeruche.fr/trashadvisor/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div></li>
								
						</ul>
				</li>
				<!--menu dropdown facebook -->
				
		</ul>
	</div>		
 </nav>			
 


<?php /*

<ul id="menu_" class="nav nav-pills">
	<li role="presentation" ><a href="./"><span class="glyphicon glyphicon-home"></span></a></li>	
	<li role="presentation" ><a href="contribuer.php">contribuer</a></li>
	<?php /*<li role="presentation" class="active"><a href="#">consulter</a></li> ***?>
	<li role="presentation"><a href="savoir_plus.php"><span class="glyphicon glyphicon-info-sign"></span></a></li>	
<li role="presentation">
		<a href="https://twitter.com/ruche_pp" target="_blank">
			<span >
				<img class="img-responsive" style="height : 20px; width :20px;" src="img/twt.png">
			</span>
		</a>
	</li>
	<li role="presentation">
		<a href="https://www.facebook.com/trashadvisorcommuneruche/" target="_blank">
			<span >
				<img class="img-responsive" style="height : 20px; width :20px;" src="img/fb.png">
			</span>
		</a>
	</li>	
</ul>
*/?>
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
			FROM `couleur_dechet` a, `commune_geofla` c WHERE a.`code_INSEE` = c.`INSEE_COM,C,5` AND dechet_type = "'.$row['dechet_type'].'" GROUP BY c.`INSEE_COM,C,5`;';
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

$( document ).ready(function() {      
    var is_mobile = false;

    if( $('#xs').css('display')=='none') {
        is_mobile = true;       
    }

    // now i can use is_mobile to run javascript conditionally

    if (is_mobile == false) {
        //Conditional script here
		
/*
var searchControl = new L.Control.Search({
			url: "traitement_Lsearch.php?q={s}",
			jsonpParam: 'json_callback',
			propertyName: 'display_name',
			propertyLoc: ['lat','lon'],
			//markerLocation: true,
			autoType: false,
			autoCollapse: false,
			minLength: 1,
			 zoom:10,
			 animateLocation:false,
			 position:'topleft'
      });
   m.addControl(searchControl);
   searchControl.expand();
*/
    }
 });




</script>
<?php 

?>

</body>
</html>