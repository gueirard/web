<?php
	$host = "localhost";
	$user = "projet";
	$pass = "projet";
	$bdd = "ProjetQuestionnaire";
	// connexion avec MySQL

	@mysql_connect($host, $user, $pass) or die("Impossible de se connecter à la base de
	données");
	// Le @ indique ? php de ne pas afficher de message d'erreur
	@mysql_select_db($bdd) or die("Impossible de se selectionner à la base de données");
?>