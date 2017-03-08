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

	$sqlUsers = mysql_query("SELECT id, nom FROM Utilisateur") or die("Impossible d'executer la requête à la base de données");
	
	while ($rowUsers = mysql_fetch_array($sqlUsers)) {
		$sql = mysql_query("SELECT SUM(Score.nbPoint) as sommePoint FROM Score WHERE id_Utilisateur = ".$rowUsers['id']) or die("Impossible d'executer la requête à la base de données");
		$row = mysql_fetch_array($sql);
		if($row['sommePoint'] != null){
			$return_arr[] = array('nom' => $rowUsers['nom'], 'scoreTotal' => $row['sommePoint']);
		}
	}
	
	/*
	
	$sql = mysql_query("SELECT DISTINCT Utilisateur.nom ,SUM(Score.nbPoint) as sommePoint FROM Utilisateur, Score WHERE Utilisateur.id = Score.id_Utilisateur") or die("Impossible d'executer la requête à la base de données");
	while ($row = mysql_fetch_array($sql)) {
	$return_arr[] = array('nom' => utf8_encode($row['nom']), 'scoreTotal' => utf8_encode($row['sommePoint']));
	}*/
	mysql_close;
	echo json_encode($return_arr);
?>