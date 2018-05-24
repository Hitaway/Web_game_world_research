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
	    <p id="texte_play"><a data-toggle="modal" data-target="#modalChoixQuestionnaire" style="text-decoration: none; color: white;">Jouer au jeu</a></p>
	</div>

  	<!--########################## Modal #################-->

	<div id="modalChoixQuestionnaire" class="modal fade" role="dialog">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	            	<h4 class="modal-title">Choix du questionnaires</h4>
	            </div>
	            <div class="modal-body">      
	                <?php       
						try
						{
							$req = $bd->prepare('SELECT * FROM QUESTIONNAIRES');
							$req->execute();
							$res = $req->fetch(PDO::FETCH_ASSOC);

							//Il y a au moins une ligne
							if($res)
							{
						 		do
								{
									if(isset($_SESSION['pseudo']) && trim($_SESSION['pseudo'])!="" || $res['nom_questionnaire']=="7 merveille du monde")
									{
										echo '<a href="carte.php?nom_questionnaire='.urlencode($res['nom_questionnaire']).'">
													<button class="btn btn-primary btn_questionnaire">'.$res['nom_questionnaire'].'</button>
												</a>';
									}
									else
									{
										echo '<a>
												<button class="btn btn-secondary btn_questionnaire_lock btn_questionnaire">
													<span class="glyphicon glyphicon glyphicon-lock" disabled></span> '
													.$res['nom_questionnaire'].'</button>
												</a>';
									}
								}while($res = $req->fetch(PDO::FETCH_ASSOC));
							}
							else
								echo '<p style="text-align: center;">Aucun questionnaires dans la base de données </p>';
						}
						catch(PDOException $e)
						{
						  	// On termine le script en affichant le n de l'erreur ainsi que le message 
						   	die('<p> Erreur : ' . $e->getMessage() . '</p>');
						}
					?>
	            </div>
	            <div class="modal-footer">
	            	<button type="button" class="btn btn-danger btn_annuler">Fermer</button>
	            </div>
	        </div>
	    </div>
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