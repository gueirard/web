<?php
	$host = "localhost";
	$user = "projet";
	$pass = "projet";
	$bdd = "ProjetQuestionnaire";

	// connexion avec MySQL
	@mysql_connect($host, $user, $pass) or die("Impossible de se connecter à la base de données");
	// Le @ indique ? php de ne pas afficher de message d'erreur
	@mysql_select_db($bdd) or die("Impossible de se selectionner à la base de données");

	$sql = mysql_query("INSERT INTO Theme (nom, nbQuestion) VALUES ('" .$_GET['theme']. "','".$_GET['nbQuest']."')") or die("Impossible d'executer la requête à la base de données");
	
	mysql_close;
?>
