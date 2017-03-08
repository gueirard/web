<?php
	include 'ConnexionBaseDeDonnees.php';
	
	$return_arr =array();
	$sql = mysql_query("SELECT * FROM Theme") or die("Impossible d'executer la requête à la base de données");
	while ($row = mysql_fetch_array($sql)) {
		$return_arr[] = array('id' => $row['id'], 'theme' => $row['nom'], 'nbQuestions' => $row['nbQuestion']);
	}
	mysql_close;
	
	echo json_encode($return_arr);
?>