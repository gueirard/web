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

	$sql = mysql_query("SELECT Theme.nom, Questions.nom, Utilisateur.nom, Score.nbPoint FROM Theme, Questions, Utilisateur, Score WHERE Utilisateur.id = Score.id_Utilisateur AND Questions.id = Score.id_Questions AND Theme.id = Questions.id_Theme") or die("Impossible d'executer la requête à la base de données");
	while ($row = mysql_fetch_array($sql)) {
	$return_arr[] = array('theme' => utf8_encode($row['0']), 'question' => utf8_encode($row['1']), 'nom' => utf8_encode($row['2']), 'score' => utf8_encode($row['3']));
	}
	mysql_close;
	echo json_encode($return_arr);
?>