<?php 
require("connections/mysql.php"); 
?>  
<?php  
//if (isset($_GET['maVariable'])) { echo $_GET['maVariable'];}; 
//if (isset($_GET['codepostal'])) { echo $_GET['codepostal'];}; 
?>
<?php

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
};

//////////


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





///////


if (isset($_GET['q'])) {
//print_r("GET ok");


/*
echo '
L.Control.Search.callJsonp
	(
	[
		{
			"display_name": "Paris 10e Arrondissement, Paris", 
			"name": "Paris 10e Arrondissement", 
			"lon": 2.3565258020968098, 
			"dept": "Paris", 
			"lat": 48.871595094678597, 
			"classr": 0, 
			"id": "75110"
		}, 
		{
			"display_name": "Paris 11e Arrondissement, 
			Paris", "name": "Paris 11e Arrondissement", "lon": 2.3784985205795701, "dept": "Paris", "lat": 48.858221069458203, "classr": 0, "id": "75111"}, 
		{"display_name": "Paris 12e Arrondissement, Paris", "name": "Paris 12e Arrondissement", "lon": 2.3868874905350999, "dept": "Paris", "lat": 48.840277265895601, "classr": 0, "id": "75112"}, 
		{"display_name": "Paris 13e Arrondissement, Paris", "name": "Paris 13e Arrondissement", "lon": 2.3542898492135902, "dept": "Paris", "lat": 48.832011440735599, "classr": 0, "id": "75113"}, 
		{"display_name": "Paris 14e Arrondissement, Paris", "name": "Paris 14e Arrondissement", "lon": 2.3256721656030002, "dept": "Paris", "lat": 48.8327528890445, "classr": 0, "id": "75114"}, 
		{"display_name": "Paris 15e Arrondissement, Paris", "name": "Paris 15e Arrondissement", "lon": 2.2996814713437699, "dept": "Paris", "lat": 48.840697880808399, "classr": 0, "id": "75115"}, 
		{"display_name": "Paris 16e Arrondissement, Paris", "name": "Paris 16e Arrondissement", "lon": 2.2762082468009202, "dept": "Paris", "lat": 48.863042220521997, "classr": 0, "id": "75116"},
		{"display_name": "Paris 17e Arrondissement, Paris", "name": "Paris 17e Arrondissement", "lon": 2.3209177535531902, "dept": "Paris", "lat": 48.883989093441997, "classr": 0, "id": "75117"}, 
		{"display_name": "Paris 18e Arrondissement, Paris", "name": "Paris 18e Arrondissement", "lon": 2.3440075650733001, "dept": "Paris", "lat": 48.891312442599997, "classr": 0, "id": "75118"}, 
		{"display_name": "Paris 19e Arrondissement, Paris", "name": "Paris 19e Arrondissement", "lon": 2.3809357914658502, "dept": "Paris", "lat": 48.882515811420703, "classr": 0, "id": "75119"}, 
		{"display_name": "Paris 1er Arrondissement, Paris", "name": "Paris 1er Arrondissement", "lon": 2.3403151006949199, "dept": "Paris", "lat": 48.859815366902197, "classr": 0, "id": "75101"}, 
		{"display_name": "Paris 20e Arrondissement, Paris", "name": "Paris 20e Arrondissement", "lon": 2.39886921509795, "dept": "Paris", "lat": 48.864620534528299, "classr": 0, "id": "75120"}, 
		{"display_name": "Paris 2e Arrondissement, Paris", "name": "Paris 2e Arrondissement", "lon": 2.3402353843413, "dept": "Paris", "lat": 48.866110357388301, "classr": 0, "id": "75102"}, 
		{"display_name": "Paris 3e Arrondissement, Paris", "name": "Paris 3e Arrondissement", "lon": 2.36071483473556, "dept": "Paris", "lat": 48.863523467580102, "classr": 0, "id": "75103"}, 
		{"display_name": "Paris 4e Arrondissement, Paris", "name": "Paris 4e Arrondissement", "lon": 2.3512632793484598, "dept": "Paris", "lat": 48.856277818280098, "classr": 0, "id": "75104"}
	]
	)
';	

L.Control.Search.callJsonp
	( 
	[
		{
			"display_name":"PAUCOURT",
			"name":"PAUCOURT",
			"id":"45249",
			"lon":"684298",
			"lat":"6770109",
			"dept":"LOIRET"
		},
		{	
			"display_name":"PAUVRES",
			"name":"PAUVRES",
			"id":"08338",
			"lon":"808345",
			"lat":"6924077",
			"dept":"ARDENNES"
		},{"display_name":"PAULMY","name":"PAULMY","id":"37181","lon":"534684","lat":"6656371","dept":"INDRE-ET-LOIRE"},
		{"display_name":"PAULE","name":"PAULE","id":"22163","lon":"220930","lat":"6811714","dept":"COTES-D'ARMOR"},
		{"display_name":"PAUDY","name":"PAUDY","id":"36152","lon":"617548","lat":"6660602","dept":"INDRE"},
		{"display_name":"PAULNAY","name":"PAULNAY","id":"36153","lon":"559944","lat":"6640502","dept":"INDRE"},
		{"display_name":"PAULHE","name":"PAULHE","id":"12178","lon":"708790","lat":"6339099","dept":"AVEYRON"},
		{"display_name":"PAUILLAC","name":"PAUILLAC","id":"33314","lon":"405217","lat":"6462913","dept":"GIRONDE"},
		{"display_name":"PAULIGNE","name":"PAULIGNE","id":"11274","lon":"630463","lat":"6219383","dept":"AUDE"},
		{"display_name":"PAULX","name":"PAULX","id":"44119","lon":"337104","lat":"6662672","dept":"LOIRE-ATLANTIQUE"},
		{"display_name":"PAULHAC","name":"PAULHAC","id":"43147","lon":"727049","lat":"6466443","dept":"HAUTE-LOIRE"},
		{"display_name":"PAULHAC-EN-MARGERIDE","name":"PAULHAC-EN-MARGERIDE","id":"48110","lon":"730175","lat":"6427983","dept":"LOZERE"},
		{"display_name":"PAULIN","name":"PAULIN","id":"24317","lon":"568943","lat":"6434695","dept":"DORDOGNE"},
		{"display_name":"PAUNAT","name":"PAUNAT","id":"24318","lon":"530609","lat":"6425329","dept":"DORDOGNE"},
		{"display_name":"PAULHIAC","name":"PAULHIAC","id":"47202","lon":"527915","lat":"6389560","dept":"LOT-ET-GARONNE"},
		{"display_name":"PAU","name":"PAU","id":"64445","lon":"428428","lat":"6253262","dept":"PYRENEES-ATLANTIQUES"},
		{"display_name":"PAUSSAC-ET-SAINT-VIVIEN","name":"PAUSSAC-ET-SAINT-VIVIEN","id":"24319","lon":"507572","lat":"6474612","dept":"DORDOGNE"},
		{"display_name":"PAULHAC","name":"PAULHAC","id":"31407","lon":"583944","lat":"6295445","dept":"HAUTE-GARONNE"},
		{"display_name":"PAUILHAC","name":"PAUILHAC","id":"32306","lon":"509290","lat":"6312691","dept":"GERS"},
		{"display_name":"PAULINET","name":"PAULINET","id":"81203","lon":"654530","lat":"6305464","dept":"TARN"},
		{"display_name":"PAULHAN","name":"PAULHAN","id":"34194","lon":"737189","lat":"6271422","dept":"HERAULT"},
		{"display_name":"PAULHAGUET","name":"PAULHAGUET","id":"43148","lon":"740182","lat":"6457898","dept":"HAUTE-LOIRE"},
		{"display_name":"PAULHAC","name":"PAULHAC","id":"15148","lon":"691512","lat":"6435877","dept":"CANTAL"},
		{"display_name":"PAULHENC","name":"PAULHENC","id":"15149","lon":"685443","lat":"6420592","dept":"CANTAL"}
		] 
	)






*/
		
$sql = 'SELECT `NOM_COM,C,50` as display_name, `NOM_COM,C,50` as name, `INSEE_COM,C,5` as id, `X_CENTROID,N,7,0` as lon, `Y_CENTROID,N,7,0` as lat, `NOM_DEPT,C,30` as dept FROM `commune_geofla` WHERE `NOM_COM,C,50` LIKE "'.$_GET['q'].'%" ;';

//echo $sql;
$res = $mysqli->query($sql);
$row = $res->fetch_assoc();
$res->data_seek(0);
while ($row = $res->fetch_assoc()) 	
    {
		//print_r($row);
		$row['classr']=0;
		$point = lambert93ToWgs84($row['lon'],$row['lat']);	
		//print_r($point);		
		$row['lon'] = $point['wgs84']['long'];
		$row['lat'] = $point['wgs84']['lat'];
        $data []= $row ;
    }
$encode_donnees = json_encode($data);
echo "L.Control.Search.callJsonp( ".$encode_donnees." )";;
					
};
  ?>