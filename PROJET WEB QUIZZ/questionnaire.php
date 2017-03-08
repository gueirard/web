<html>

<head>
<meta charset="UTF-8">
<title>Questionnaire avec indices</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="CSS/style.css" />


<script>
"use strict";

//Variables json contenant informations BDD
var choix;
var theme;
var questions;

var indiceTheme = 0;

var questionExistante=0;
var questionValider=0;

<?php session_start(); ?>

$(document).ready(function(){ 
	loadTheme();
	affSuivant();
});

function affSuivant(){
	var $input = $('<br><button id=ThemeSuivant>Suivant</button>');
	$input.appendTo('body');
	$('#ThemeSuivant').prop("disabled", true);
}

//Charge le thème actuel
var loadTheme = function(){
		$.ajax({
			type:"GET",
			url:"PHP/getTheme.php"
		}).done(function(data){
			console.log(data);
			theme = JSON.parse(data);
			try{
				document.getElementById('theme').innerHTML = "<h3 style=text-align:center;text-decoration:underline;font-size:3em;color:red>"+theme[indiceTheme].theme +"</h3>";
			}catch(err){
				window.location.replace("fin.php");
			}
			loadQuestions(theme[indiceTheme].id);
	});
};

//Charge les questions de la base de données en fonction de l'identifiant du theme
var loadQuestions = function(id){
	$.ajax({
		type:"GET",
		url:"PHP/getQuestions.php",
		data:{idTheme : id}
	}).done(function(data){
		console.log(data);
		questions = JSON.parse(data);
		$.each(questions,function(key,value){
			var indiceQuestions=0;
			
				//Création d'un fielset avec en legend la question
				$('<fieldset id=Q'+value.id+'></fieldset>').html("<legend>"+value.question+"</legend>").appendTo('body');
				loadChoix(value.id, questions);
				
				//Création d'un div pour afficher les points
				$("<div class=point id='pointsQ"+value.id+"'></div>").html("Points :").appendTo('#Q'+value.id);
				affPoints(value.id,2);
				
				//Création d'un bouton indice
				var $input = $('<button id=btnIndice'+value.id+' onclick=loadIndice('+value.id+')>Afficher un indice</button>');
				$input.appendTo($("#Q"+value.id));
				
				//Création d'un bouton pour afficher le score
				var $input = $("<button name=score id=btnScoreQ"+value.id+" onclick=addScore("+value.id+")>VALIDER</button><br>");
				$input.appendTo($("#Q"+value.id));
				
				questionExistante++;
			
		});
	});
};

//Charge les choix de la base de données en fonction de l'identifiant de la question
var loadChoix = function(id){
	$.ajax({
		type:"GET",
		url:"PHP/getChoix.php",
		data:{idQuestion : id}
	}).done(function(data){
		console.log(data);
		choix = JSON.parse(data);
		$.each(choix,function(key,value){
			$("<input type='radio' name='quizQ"+id +"' value='"+value.value+"'</input> "+value.choix+"<br>").html("").insertBefore('#pointsQ'+id);
		});
	});
};

//Charge l'indice d'une question
var loadIndice = function(id){
	var session = "<?php echo "'".$_SESSION['nom']."'"; ?>";
	$.ajax({
		type: "GET",
		url: "PHP/isScoreExist.php",
		data:{	id_Question: id,
				nomSession : session}
	}).done(function(data){
		console.log(data);
		
		$('#btnIndice'+id).prop("disabled", true);
		if(data == 1){
			$.ajax({
				type:"GET",
				url:"PHP/getIndice.php",
				data:{idQuestion : id,
					nomSession : session}
			}).done(function(data){
				console.log(data);		
				var indice = JSON.parse(data);
				document.getElementById("indice").innerHTML=indice[0].indice;
				affPoints(id, 1);
			});
		}else{
			$('#btnScoreQ'+id).prop("disabled", true);
			questionValider++;
			alert("Vous avez déjà répondu à cette question.");
			verifQuestionValidation();
		}
	});
}

//Ajoute le score d'une question
var addScore = function(id){
	questionValider++;
	var session = "<?php echo "'".$_SESSION['nom']."'"; ?>";
	$.ajax({
		type: "GET",
		url: "PHP/isScoreExist.php",
		data:{	id_Question: id,
				nomSession : session}
	}).done(function(data){
		console.log(data);
		$('#btnScoreQ'+id).prop("disabled", true);
		$('#btnIndice'+id).prop("disabled", true);
		if(data == 1){
			
			var rep = "";
			for(var radio of document.getElementsByName("quizQ"+id)){
				if(radio.checked)
					rep=radio.value;
			}
			$.ajax({
				type: "GET",
				url: "PHP/addScore.php",
				data:{	id_Question: id,
						reponse :rep,
						nomSession : session}
			}).done(function(data){
				console.log(data);	
				affPoints(id, data);	
			});
		}else{
			alert("Vous avez déjà répondu à cette question.");
		}
		
		verifQuestionValidation();
	})
};

function verifQuestionValidation(){
	if(questionValider==questionExistante){		
			questionValider = 0;
			questionExistante = 0;
			$('#ThemeSuivant').prop("disabled", false);
		}
}

//Affichage des points d'une question
function affPoints(id, points){ 
	document.getElementById("pointsQ"+id).innerHTML= "Points : "+points;
}

//Changement de thème
$(document).ready(function(){ 
	$("#ThemeSuivant").click(function(){
		
			indiceTheme++;
			$('fieldset').remove();
			$('.point').remove();
			loadTheme();
		
	});
});

</script>

</head>

<header>
	<div id=theme>
	</div>
</header>

<body>
</body>

<footer>
	<h3>Indices
	<div id=indice>
	</div>
</footer>

</html>
