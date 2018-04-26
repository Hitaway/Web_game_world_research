<?php 
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>

<body>
	<!--########################## En-tête #################-->
	<?php require("header.php"); ?>

	<!--########################## Corps #################-->
    <div style="position: relative;">
	    <img src="Image/monde2.png" id="img_monde" alt="img_monde">
	    <img src="Image/map_marqueur2.png" id="img_map_marqueur" alt="img_monde">
	</div>

  	<div class="jumbotron" id="texte_intro">
    	<div class="container">
        	<h1 class="display-3">Explore le monde!</h1>
        	<p>Notre jeu interactif est à connotation culturelle. Le principe général est de vous proposez des questionnaires constitueś de 7 questions. Le « plateau » du jeu est constitué de carte du monde. Chaque question consiste à localiser l’emplacement du lieu mentionné dans la question. Pour chaque question vous devrez donc cliquer sur un endroit de la carte. Des points vous seront alors attribuer en fonction de l'éloignement de la cible à trouver.</p>
        	<p><a class="btn btn-primary btn-lg" href="regle.php" role="Règle">Règle »</a></p>
      	</div>
    </div>



    <!--########################## Classement #################-->

    <div id="classement">
	    <h2 class="display-3">Classement</h2>
	    <img src="Image/podium.png" alt="img_podium">
		<div class="panel panel-default">
			<div class="panel-heading">Classement</div>
			<?php afficheClassement($bd); ?>
		</div>
	</div>

	<!--########################## Modal #################-->
			<div id="modalConnexion" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
       						<h4 class="modal-title">Identification</h4>
       					</div>
						<form class="form-horizontal" method="post">
							<div class="modal-body">
								<div class="form-group">
									<label for="pseudo1" class="col-sm-3 control-label">Pseudo</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="pseudo1" id="pseudo1" placeholder="Entrez votre pseudo..." />
									</div>
								</div>
								<div class="form-group">
									<label for="mdp1" class="col-sm-3 control-label">Mot de passe</label>
									<div class="col-sm-9">
										<input type="password" class="form-control form-control-warning" name="mdp1" id="mdp1" placeholder="Entrez votre mot de passe..." />
   										<span class="help-block" id="error-msg">
                          					<p class="text-danger"></p>
                 						</span>


									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary btn_valider">Connexion</button>
										<button type="button" class="btn btn-danger btn_annuler">Annuler</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>


<!--<div class="container">
  <form>
    <div class="form-group row has-success">
      <label for="inputHorizontalSuccess" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control form-control-success" id="inputHorizontalSuccess" placeholder="name@example.com">
        <div class="form-control-feedback">Success! You've done it.</div>
        <small class="form-text text-muted">Example help text that remains unchanged.</small>
      </div>
    </div>
    <div class="form-group row has-warning">
      <label for="inputHorizontalWarning" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control form-control-warning" id="inputHorizontalWarning" placeholder="name@example.com">
        <div class="form-control-feedback">Shucks, check the formatting of that and try again.</div>
        <small class="form-text text-muted">Example help text that remains unchanged.</small>
      </div>
    </div>
    <div class="form-group row has-danger">
      <label for="inputHorizontalDnger" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control form-control-danger" id="inputHorizontalDnger" placeholder="name@example.com">
        <div class="form-control-feedback">Sorry, that username's taken. Try another?</div>
        <small class="form-text text-muted">Example help text that remains unchanged.</small>
      </div>
    </div>
  </form>
</div>-->

		<div id="modalInscrire" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
       					<h4 class="modal-title">Inscription</h4>
       				</div>
					<form class="form-horizontal">
						<div class="modal-body">
							<div class="form-group">
								<label for="nom" class="col-sm-3 control-label">Nom</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="nom" placeholder="Entrez votre nom..." />
								</div>
								</div>
							<div class="form-group">
								<label for="prenom" class="col-sm-3 control-label">Prenom</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="prenom" placeholder="Entrez votre prenom..." />
								</div>
							</div>
							<div class="form-group">
								<label for="pseudo2" class="col-sm-3 control-label">Pseudo</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="pseudo2" placeholder="Entrez votre Pseudo..." />
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-3 control-label">Email</label>
								<div class="col-sm-9">
									<input type="email" class="form-control" id="email" placeholder="Entrez votre adresse email..." />
								</div>
							</div>
							<div class="form-group">
								<label for="mdp2" class="col-sm-3 control-label">Mot de passe</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="mdp2" placeholder="Entrez votre mot de passe..." />
								</div>
							</div>
							<div class="form-group">
								<label for="mdp3" class="col-sm-3 control-label">Confirmer mot de passe</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="mdp3" placeholder="Veuillez confirmer votre mot de passe..." />
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
									<button type="submit" class="btn btn-primary btn_valider">S'inscrire</button>
									<button type="button" class="btn btn-danger btn_annuler">Annuler</button>			
								</div>
							</div>
						</div>				
					</form>
				</div>
			</div>
		</div>
<?php
		//stocker le message d'erreur qui sera ensuite transmit au JS

	/*if (isset($_POST['pseudo1']) && isset($_POST['mdp1']) && trim($_POST['pseudo1']) && trim($_POST['mdp1'])){ //On est dans la page de formulaire
	    if (empty($_POST['pseudo1']) || empty($_POST['mdp1']) ) //Oublie d'un champ
	    {
	        $message = "veillez saisir tout les champs.";
	    }
	    else //On check le mot de passe
	    {
	        $query=$db->prepare('SELECT * FROM utilisateurs WHERE pseudo = :pseudo');
	        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
	        $query->execute();
	        $data=$query->fetch();

			if ($data['mdp'] == $_POST['password']) // MDP correct
			{
			    $_SESSION['pseudo'] = $data['pseudo'];
			    $_SESSION['droit'] = $data['droit'];
			    $message = "vous êtes connectés.";  
			}
			else // MDP incorrect
			{
			    $message = "Le mot de passe ou le pseudo 
		            entré n\'est pas correcte.";
			}
		    $query->CloseCursor();
	    }*/
//echo $message;
	    $message = "zaeae1";
		    $reponse = array("message" => $message);
			header('Content-type: application/json');
			json_encode($reponse);
	//}
?>

	<!--########################## Pied de page #################-->
	<?php include("footer.php"); ?>
</body>
</html>