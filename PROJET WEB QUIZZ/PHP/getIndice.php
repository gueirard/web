<?php
	include 'ConnexionBaseDeDonnees.php';
	session_start();
	
	$return_arr =array();
	$sql = mysql_query("SELECT indice FROM Questions WHERE id =".$_GET['idQuestion']) or die("Impossible d'executer la requête 1");
	while ($row = mysql_fetch_array($sql)) {
		$return_arr[] = array('indice' => $row['indice']);
	}
	
	
	$sql = "SELECT id FROM Utilisateur WHERE nom =".$_GET['nomSession'];
	$sqlUser = mysql_query($sql) or die("Probleme session");
	$rowUser = mysql_fetch_array($sqlUser);
	
	
	$sql = mysql_query("INSERT INTO Score(indiceUtilise,id_Questions, id_Utilisateur)VALUES(1,".$_GET['idQuestion'].",".$rowUser['id'].")") or die("Impossible d'executer la requête 3");
	//AJOUTER LA LE TRUE INDICE D'UN UTILISATEUR DANS LA TABLE SCORE EN FONCTION DE LA QUESTION
	mysql_close;
	
	echo json_encode($return_arr);
?>