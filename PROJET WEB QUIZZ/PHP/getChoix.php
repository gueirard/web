<?php
	include 'ConnexionBaseDeDonnees.php';
	
	$return_arr =array();
	
	$sqlLimite = mysql_query("SELECT nbRep FROM Questions WHERE id = ".$_GET['idQuestion']);
	$rowLimite = mysql_fetch_array($sqlLimite);
	
	$limite = $rowLimite['nbRep'] -1;
	
	$sql = mysql_query("(SELECT * FROM Reponses WHERE juste = 1 AND id_Questions=".$_GET['idQuestion']." LIMIT 1) union all (SELECT * FROM Reponses WHERE juste = 0 AND id_Questions=".$_GET['idQuestion']." LIMIT ".$limite.") ORDER BY RAND()") or die("Impossible d'executer la requête à la base de données");
	while ($row = mysql_fetch_array($sql)) {
		$return_arr[] = array('id' => $row['id'], 'choix' => utf8_encode($row['nom']),'value' => utf8_encode($row['value']), 'id_Questions' => $row['id_Questions']);
	}
	mysql_close;
	echo json_encode($return_arr);
?>