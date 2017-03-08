 <?php
	session_start() ;
	$_SESSION["nom"] = $_POST["nom"] ;
	print "Bienvennue sur le questionnaire : " . $_SESSION['nom'] . "<br/>";
	setcookie('nom', $_POST["nom"], time() + 365*24*3600,null,null,false,true);
	print " Cookie : " . $_COOKIE['nom'];
/*----------------------------------Procedural -----------------------------------------------------------------*/
	$host = "localhost";
	$user = "projet";
	$pass = "projet";
	$bdd = "ProjetQuestionnaire";
	
ini_set("display_errors","on");
$login=$_POST['nom'];
$link = mysqli_connect($host, $user, $pass, $bdd);
if(!$link) die('Erreur de connexion');	
$sql = "SELECT nom FROM Utilisateur WHERE nom = '$login'";
$result = mysqli_query($link,$sql);
$num_rows = mysqli_num_rows($result);
echo ($num_rows);
if($num_rows == 1)
{
	header('Location: ../questionnaire.php');       
	$_SESSION['nom'] = $login;
	// $_SESSION['connecte'] = true;
}
else {
	$link = mysqli_connect($host, $user, $pass, $bdd);
	$nom = $_POST['nom'];

	$requete = "INSERT INTO Utilisateur (nom) VALUES ( '$nom' )";
	mysqli_query($link,$requete);
	header('Location: ../questionnaire.php');
}
mysqli_close($link);

/*	-------------------------PDO ------------------------------------------------------------------*/
/*
	try {
		$bdd = new PDO ('mysql:host=localhost;dbname:ProjetQuestionnaire;charset=utf8','projet','projet');
	} catch (Exception $e) {
		die ('Erreur' . $e ->getMessage());
	}
	

$_SESSION["nom"] = $_POST["nom"];

 
if(($_SESSION["nom"] == "")) {
    //echo "veuillez saisir un login";
	echo "<script>alert(\"Veuillez saisir un nom\")</script>";
}
else {
    $requete = $bdd->query("SELECT COUNT(*) FROM Utilisateur WHERE login='".$_SESSION["nom"]."'")->fetch();
    if ($requete['COUNT(*)'] == 1)
        header("Location: questionnaire.php");
}
*/
/*else {
	$requete2 = $bdd->query("SELECT COUNT(*) FROM utilisateurs WHERE login='".$_SESSION["nom"]."'AND idAdmin == 1")->fetch();
	if ($requete2['COUNT(*)'] == 1)
        header("Location: creationFormulaire.php");
}*/

/* ---------------------------------------------------------------------------------------

	$host = "localhost";
	$user = "projet";
	$pass = "projet";
	$bdd = "ProjetQuestionnaire";
	// connexion avec MySQL

	@mysql_connect($host, $user, $pass) or die("Impossible de se connecter à la base de
	données");
	// Le @ indique ? php de ne pas afficher de message d'erreur
	@mysql_select_db($bdd) or die("Impossible de se selectionner à la base de données");
----------------------------------------------------------------------------------------------------*/
/*------------------------------------------------
	// si on envoie le formulaire
	if(isset($_POST['nom'])) { 
 
	// connexion à la base de données
	$link = mysqli_connect($host, $user, $pass, $bdd);
 
	// on récupère les $_POST et on en fait des variables
	//$_POST = array_map('mysql_real_escape_string', $_POST); // on applique mysql_real_escape_string sur tout le tableau $_POST
	$nom = $_POST['nom'];

	$requete = "INSERT INTO Utilisateur (nom) VALUES ( '$nom' )";
	mysqli_query($link,$requete);
	
	}
	----------------------------*/
	/*
	// on part du principe que le nom d'utilisateur est unique, on doit vérifier que le nom passé dans le formulaire n'existe pas dans la table
	// on crée la requête
	$requete = "SELECT COUNT(*) AS nb FROM Utilisateur WHERE nom = '". $nom ."'"; 
	 // on exécute la requête
	$resultat = mysql_query($requete) or die('ERREUR SQL : '. $requete . mysql_error());
	// on crée un tableau pour récupérer la valeur que renvoie la requête
	$donnees = mysql_fetch_array($resultat); 
	// on crée une variable qui contiendra le nombre de résultats renvoyé par la requête
	$nombre = $donnees['nb']; 
	// si la variable renvoie 0 c'est que le nom d'utilisateur n'existe pas dans la table donc on peut l'enregistrer
    if($nombre == 0) { 
    $requete = "INSERT INTO Utilisateur VALUES('". $nom ."')";
    $resultat = mysql_query($requete) or die('ERREUR SQL : '. $requete . mysql_error()); // on exécute la requête
    echo 'Insertion effectuée.';
    } else { // sinon ce nom existe déjà on insert aucune donnée
    echo 'L\'utilisateur '. $nom .' existe déjà.';
    }
*/
/*-------------------------------------------------------------------
if(isset($_POST) && !empty($_POST['login'])) {
		// Extraction des données
		extract($_POST);
		// Accès à la base de données
		$login = $_POST['nom'];
		// Requête SQL
		$sql = "SELECT nom FROM utilisateur WHERE nom='$login'";
		// Préparation de la requête
		$requete = $bdd->prepare($sql);
		// On exécute
		$requete -> execute();
		// Organise le résultat sous forme de tableau
		$data=$requete->fetch();


	// recupérer les données recues du formulaire
	$login = $_GET['nom'];
	
	
	//verifier le tuple login,mot de passe
	$sql=	"SELECT nom 
			FROM Utilisateur 
			WHERE nom = '$login'";
	
	//    2: executer la requete
	$result = mysql_query($sql);
	
	if(mysql_num_rows($result) != 0) {
	header('Location: questionnaire.php');
	}
	else {
	echo "<script>alert(\"C'EST CASSE !!!! \")</script>";
	}
mysql_close(); 
-----------------------------------------------------------------------*/

?>