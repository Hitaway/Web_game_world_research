<?php
	session_start();
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>

<body>
	<!--########################## En-tête #################-->

	<div id="entête_img">
		<?php require("header.php"); ?>

	<!--########################## Entête avec le titre #################-->
   
	    <div id="div_img_map_marqueur"><img src="Image/map_marqueur.png" alt="img_monde" id="img_marqueur"></div>
	    <h1 id="titre_research">RESEARCH</h1>
	    <hr class="trait_entête">
	    <hr class="trait_entête">
	    <p id="texte_play">Jouer au jeu</p>
	</div>

	<!--########################## Texte descriptif du jeu #################-->

  	<div class="jumbotron" id="texte_intro">
    	<div class="container">
        	<h1 class="display-3">Explore le monde!</h1>
        	<p>Notre jeu interactif est à connotation culturelle. Le principe général est de vous proposez des questionnaires constitueś de 7 questions. Le « plateau » du jeu est constitué de carte du monde. Chaque question consiste à localiser l’emplacement du lieu mentionné dans la question. Pour chaque question vous devrez donc cliquer sur un endroit de la carte. Des points vous seront alors attribuer en fonction de l'éloignement de la cible à trouver.</p>
        	<p><a class="btn btn-primary btn-lg" href="regle.php" role="Règle">Règle »</a></p>
      	</div>
    </div>

    <!--########################## Classement #################-->

    <div class="classement">
	    <div class="container">
		    <h1 class="display-3" id="titre_classement">CLASSEMENT</h1>
        <p id="phrase_classement">Bravo aux trois meilleurs joueurs qui ont obtenue les meilleurs scores !</p>
        <hr class="trait_classement">
        <hr class="trait_classement">
		   	<div id="div_img_podium">
		   		<a href="classement.php"><img src="Image/podium.png" alt="img_podium" id="img_podium"></a>
		   	</div>
			<div class="panel panel-default tableau_classement">
				<div class="panel-heading col-lg-12 col-md-12 col-sm-12">Classement</div>
				<?php afficheClassement($bd, 3); ?>
			</div>
		</div>
	</div>

	<!--########################## Pied de page #################-->
	<?php require("footer.php"); ?>
</body>
</html>