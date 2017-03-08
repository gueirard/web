<?php
	include 'ConnexionBaseDeDonnees.php';	
	
	$sqlUser = mysql_query("SELECT id FROM Utilisateur WHERE nom = ".$_GET['nomSession']) or die("req 1");
	$rowUser = mysql_fetch_array($sqlUser);
	
	
	$sqlReponse = mysql_query("SELECT juste FROM Reponses WHERE id_Questions =" .$_GET['id_Question']." AND value = '".$_GET['reponse']."'")  or die("req 2");
	$sqlIndice = mysql_query("SELECT indiceUtilise FROM Score WHERE id_Questions =".$_GET['id_Question']." AND id_Utilisateur =".$rowUser['id']) or die("req 3");
	
	$rowReponse = mysql_fetch_array($sqlReponse);
	$rowIndice = mysql_fetch_array($sqlIndice);
	
	
	if($rowIndice['indiceUtilise']==true){
		if($rowReponse['juste']==true){
			$point = 1;
			$sql = mysql_query("UPDATE Score SET nbPoint = 1 WHERE id_Questions = ".$_GET['id_Question']." AND id_Utilisateur =".$rowUser['id']) or die("req 4");
		}else{
			$point = 0;
			$sql = mysql_query("UPDATE Score SET nbPoint = 0 WHERE id_Questions = ".$_GET['id_Question']." AND id_Utilisateur =".$rowUser['id']) or die("req 5");
		}
	}else{
		if($rowReponse['juste']==true){
			$point = 2;
			$sql = mysql_query("INSERT INTO Score (nbPoint, indiceUtilise, id_Questions, id_Utilisateur) VALUES (2,0,".$_GET['id_Question'].",".$rowUser['id'].")") or die("req 6");
		}else{
			$point = 0;
			$sql = mysql_query("INSERT INTO Score (nbPoint, indiceUtilise, id_Questions, id_Utilisateur) VALUES (0,0,".$_GET['id_Question'].",".$rowUser['id'].")")or die("req 7");
		}
	}
	mysql_close;
	echo $point;
?>