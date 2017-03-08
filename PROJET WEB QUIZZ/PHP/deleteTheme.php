<?php
	$host = "localhost";
	$user = "projet";
	$pass = "projet";
	$bdd = "ProjetQuestionnaire";

	// connexion avec MySQL
	@mysql_connect($host, $user, $pass) or die("Impossible de se connecter à la base de données");
	// Le @ indique ? php de ne pas afficher de message d'erreur
	@mysql_select_db($bdd) or die("Impossible de se selectionner à la base de données");
	$id_question = mysql_query("SELECT * FROM Questions WHERE id_Theme = '" .$_GET['theme']. "'") or die("Impossible d'executer la requête à la base de données");
	while ($row = mysql_fetch_array($id_question)) {
		$delRep = mysql_query("DELETE FROM Reponses WHERE id_Questions = '" .$row['id']. "'") or die("Impossible d'executer la requête à la base de données");
		$delScore = mysql_query("DELETE FROM Score WHERE id_Questions = '" .$row['id']. "'") or die("Impossible d'executer la requête à la base de données");
	}
	$delQuestion = mysql_query("DELETE FROM Questions WHERE id_Theme = '" .$_GET['theme']. "'") or die("Impossible d'executer la requête à la base de données");
	$sql = mysql_query("DELETE FROM Theme WHERE id = '" .$_GET['theme']. "'") or die("Impossible d'executer la requête à la base de données");
	
	mysql_close;
?>
