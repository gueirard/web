<?php

	include 'ConnexionBaseDeDonnees.php';
	session_start();
	$sqlUser = mysql_query("SELECT id FROM Utilisateur WHERE nom = ".$_GET['session']) or die("req 1");
	$rowUser = mysql_fetch_array($sqlUser);
	
	$sqlScore = mysql_query("SELECT SUM(nbPoint) AS scoreTotal FROM Score WHERE id_Utilisateur = ".$rowUser['id']) or die("Erreur requête");
	$rowScore = mysql_fetch_array($sqlScore);
	
	echo $rowScore['scoreTotal'];
	
	
	
?>