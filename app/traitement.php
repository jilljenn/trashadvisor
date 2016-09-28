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


		

if (isset($_GET['maVariable']) AND isset($_GET['codepostal']) AND isset($_GET['codeINSEE'])) {
	//print_r("GET ok");
	
    $get_array = str_getcsv($_GET['maVariable']);
	//print_r($get_array); 
	$date = date_create();

	
	foreach ($get_array as $key => $value) {	
		$value1 = str_getcsv($value,";","","");
		$value2 = str_getcsv($value1[0],"_","","");
		
		$insertSQL = sprintf("INSERT INTO couleur_dechet (id_declarant, conteneur_type, conteneur_couleur, dechet_type, code_postal, code_INSEE,declaration_date) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(date_timestamp_get($date), "int"),
                       GetSQLValueString($value2[0], "text"),
                       GetSQLValueString($value2[1], "text"),
					   GetSQLValueString($value1[1], "text"),
					   GetSQLValueString($_GET['codepostal'], "int"),
					   GetSQLValueString($_GET['codeINSEE'], "text"),
					   GetSQLValueString(date("Y-m-d"), "date"));
			//print_r($insertSQL);
			$res = $mysqli->query($insertSQL) or die(mysql_error());
			
		};
	echo date_timestamp_get($date);
		//print_r($value);
		
		/*echo "test";
		function gototo($adresse)
	{
	echo "<script language='JavaScript'> 
    document.location.replace('".$adresse."'); 
       </script>"; } ;
	gototo('feedback.php');*/
				
	
};
  ?>