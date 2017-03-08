<?php
	include 'ConnexionBaseDeDonnees.php';
	session_start();
	$sqlUser = mysql_query("SELECT id FROM Utilisateur WHERE nom = ".$_GET['nomSession']) or die("req 1");
	$rowUser = mysql_fetch_array($sqlUser);
	
	
	$req = "SELECT nbPoint FROM Score WHERE id_Questions =".$_GET['id_Question']." AND id_Utilisateur =".$rowUser['id'];
	$sql = mysql_query($req);
	$row = mysql_fetch_array($sql);
	
	if($row['nbPoint']!=NULL)
		$exist = 0;
	else
		$exist = 1;
	
	echo $exist;
	mysql_close;
?>