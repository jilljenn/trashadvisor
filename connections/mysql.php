<?php
	// On définit les 4 variables nécessaires à la connexion MySQL :
	$hostname = "XXXX";
	$user     = "XXXX";
	$pdbd = "XXXXX";
	$nom_base_donnees = "XXXXXX";

	// Connexion au serveur MySQL

	$mysqli = mysqli_connect($hostname, $user, $pdbd, $nom_base_donnees);
	
	if (mysqli_connect_errno($mysqli)) 
	{
    			echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
	}

?>