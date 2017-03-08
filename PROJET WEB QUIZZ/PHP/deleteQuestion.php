<?php
	$host = "localhost";
	$user = "projet";
	$pass = "projet";
	$bdd = "ProjetQuestionnaire";
	$return_arr =array();	
	// connexion avec MySQL
	@mysql_connect($host, $user, $pass) or die("Impossible de se connecter à la base de données");
	// Le @ indique ? php de ne pas afficher de message d'erreur
	@mysql_select_db($bdd) or die("Impossible de se selectionner à la base de données");

	$sql = mysql_query("DELETE FROM Reponses WHERE id_Questions = '".$_GET['question']."'") or die("Impossible d'executer la requête à la base de données");
	$sql = mysql_query("DELETE FROM Score WHERE id_Questions = '".$_GET['question']."'") or die("Impossible d'executer la requête à la base de données");
	$sql = mysql_query("DELETE FROM Questions WHERE id_Theme = '".$_GET['theme']."' AND id = '".$_GET['question']."'") or die("Impossible d'executer la requête à la base de données");
	mysql_close;
?>