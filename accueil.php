<?php
	require("identifiants.php");
	require("debut.php");
?>
<body>
	<!--########################## En-tête #################-->
	<?php require("header.php"); ?>

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
                          					<p class="text-danger">Identifiant incorrect</p>
                 						</span>


									</div>
								</div>
							</div>
							<div class="modal-footer">
								<div class="row">
									<div class="col-sm-3"></div>
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary btn_valider">Connexion</button>
										<button type="button" class="btn btn-danger btn_retour">Annuler</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>


<div class="container">
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
</div>

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
									<button type="button" class="btn btn-danger btn_retour">Annuler</button>			
								</div>
							</div>
						</div>				
					</form>
				</div>
			</div>
		</div>
<?php
//Attribution des variables de session
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	if (isset($_POST['pseudo1']) && isset($_POST['mdp1']) /*&& trim($_POST['pseudo1']) && trim($_POST['mdp1'])*/){ //On est dans la page de formulaire
	    if (empty($_POST['pseudo1']) || empty($_POST['password1']) ) //Oublie d'un champ
	    {
	        $message = '<script>alert("une erreur sest produite pendant votre identification.");</script>';
	    }
	    else //On check le mot de passe
	    {
	        $query=$db->prepare('SELECT pseudo, mdp FROM utilisateurs WHERE pseudo = :pseudo');
	        $query->bindValue(':pseudo',$_POST['pseudo'], PDO::PARAM_STR);
	        $query->execute();
	        $data=$query->fetch();

			if ($data['mdp'] == $_POST['password']) // Acces OK !
			{
			    $_SESSION['pseudo'] = $data['membre_pseudo'];
			    $_SESSION['level'] = $data['membre_rang'];
			    $_SESSION['id'] = $data['membre_id'];
			    $message = '<p>Bienvenue '.$data['membre_pseudo'].', 
					vous êtes maintenant connecté!</p>';  
			}
			else // Acces pas OK !
			{
			    $message = '<p>Le mot de passe ou le pseudo 
		            entré n\'est pas correcte.</p>';
			}
		    $query->CloseCursor();
	    }
	    echo $message;
	}
?>

	<!--########################## Pied de page #################-->
	<?php include("footer.php"); ?>
</body>
</html>