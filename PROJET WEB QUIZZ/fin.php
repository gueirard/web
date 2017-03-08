<html>

<head>
<meta charset="utf-8">
<title>Questionnaire avec indices</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="CSS/style.css" />


<script>
<?php session_start();?>
$(document).ready(function(){ 
		
		var sessionC = "<?php echo "'".$_SESSION['nom']."'"; ?>";
		$.ajax({
			type:"GET",
			url:"PHP/scoreTotalUtilisateur.php",
			data:{session : sessionC}
		}).done(function(data){
			console.log(data);
			$('<fieldset></fieldset>').html('Votre Score Total est de :'+data).appendTo('body');
			<?php session_destroy(); ?>
			
			var $input = $("<button onclick=self.location.href='http://10.0.2.20/'>Retour page d'accueil</button>");
			$input.appendTo('body');
			
	});
});

</script>

