<?php
	// On définit les 4 variables nécessaires à la connexion MySQL :
	$hostname = "db";
	$user     = "dev";
	$pdbd = "123456";
	$nom_base_donnees = "myapp";

	// Connexion au serveur MySQL

	$mysqli = mysqli_connect($hostname, $user, $pdbd, $nom_base_donnees);

	if (mysqli_connect_errno($mysqli))
	{
    			echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
	}

?>
