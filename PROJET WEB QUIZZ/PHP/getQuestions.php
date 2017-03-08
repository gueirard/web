<?php
	include 'ConnexionBaseDeDonnees.php';

	$sqlLimite = mysql_query("SELECT nbQuestion FROM Theme WHERE id = ".$_GET['idTheme']);
	$rowLimite = mysql_fetch_array($sqlLimite);
	
	
	$sql = mysql_query("SELECT id, nom, id_Theme FROM Questions WHERE id_Theme = ".$_GET['idTheme']." ORDER BY RAND() LIMIT ".$rowLimite['nbQuestion']) or die("Impossible d'executer la requête Ã  la base de donnÃ©es");
	
	while ($row = mysql_fetch_array($sql)) {
		$return_arr[] = array('id' => $row['id'], 'question' => utf8_encode($row['nom']), 'id_Theme' => $row['id_Theme']);
	}
	mysql_close;
	echo json_encode($return_arr);
?>