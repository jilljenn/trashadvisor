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


//echo "hello";		

if (isset($_GET['codepostal'])) {
//print_r("GET ok");
	
$sql = 'SELECT b.`code_INSEE` as code_INSEE, b.`code_postal`, b.`nom_commune` 
		FROM `code_insee_postal` b WHERE CAST(code_postal as CHAR)  like "'.GetSQLValueString($_GET['codepostal'],"int").'%";';
		
		$sql = 'SELECT b.`code_INSEE` as code_INSEE, b.`code_postal`, b.`nom_commune` 
		FROM `code_insee_postal` b WHERE code_postal = "'.GetSQLValueString($_GET['codepostal'],"int").'";';


$res = $mysqli->query($sql);
$row = $res->fetch_assoc();
$res->data_seek(0);
while ($row = $res->fetch_assoc()) 	
    {
        $data []= $row;
    }
$encode_donnees = json_encode($data);
echo $encode_donnees;
				
	
};
  ?>