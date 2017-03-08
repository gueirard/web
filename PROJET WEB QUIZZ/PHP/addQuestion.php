<?php
	$host = "localhost";
	$user = "projet";
	$pass = "projet";
	$bdd = "ProjetQuestionnaire";

	// connexion avec MySQL
	@mysql_connect($host, $user, $pass) or die("Impossible de se connecter à la base de données");
	// Le @ indique ? php de ne pas afficher de message d'erreur
	@mysql_select_db($bdd) or die("Impossible de se selectionner à la base de données");
	
	$sql = mysql_query("INSERT INTO Questions (nom, indice, id_Theme, nbRep) VALUES ('".$_GET['question']."','".$_GET['indice']."','".$_GET['theme']."','".$_GET['nombreReponse']."')") or die("Impossible d'executer la requête à la base de données 1");
	
	$id_question = mysql_query("SELECT id FROM Questions WHERE nom = '" .$_GET['question']. "'") or die("Impossible d'executer la requête à la base de données");
	while ($row = mysql_fetch_array($id_question)) {
		$i = 0;
		foreach ($_GET['reponses'] as $rep){
			if ($i == 0)
			{
				$sql = mysql_query("INSERT INTO Reponses (nom, value, id_Questions, juste) VALUES ('".$rep."','".$_GET['values'][$i]."','".$row['id']."','1')") or die("Impossible d'executer la requête à la base de données 2");
			}
			else
			{
				$sql = mysql_query("INSERT INTO Reponses (nom, value, id_Questions, juste) VALUES ('".$rep."','".$_GET['values'][$i]."','".$row['id']."','0')") or die("Impossible d'executer la requête à la base de données 2");
			}
			$i++;
			echo ($row);
		}
	}
	mysql_close;
?>