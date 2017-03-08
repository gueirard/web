 <?php
 session_start() ;
 ?>
 <!DOCTYPE html >
 <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="CSS/style.css"/>
		<link rel="stylesheet" type="text/css" href="CSS/accueil.css"/>
		<meta charset="utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$( function() {
  $("#create").click( function(){
   $("#contenu").load("create.php?nom=" + $("#nom").val() );
  }) ;  
});
</script>
		<title>Connexion au questionnaire</title>
	</head>
	
	<body>
		<div id="entete">

			<img src="IMG/Logo_transparent.png" class="logo" id="logo"/>

		</div>
	
		<div id="contenu" align="center" >
		
			<form action="PHP/connexion.php" method="POST">
			
				<div>Identifiant Session : <input type="text" id="nom" name="nom"/> </div> <br/> <br/>
				<button type="submit" id="create" value="Connexion"> Connexion </button>
				
			</form>
		</div>
	</body>
</html>