<?php
	include("debut.php");
?>
<body>
	<!--########################## En-tête #################-->
	<header>
			<h1>Titre</h1>
			<button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalInscrire">S'INSCRIRE</button>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalConnexion">CONNEXION</button>
	</header>
	<!--########################## Corps #################-->

	<!--########################## Pied de page #################-->

	<footer>
		<div class="footer-copyright py-3 text-center">
			<p>Site réalisé par : Quentin Rat et Slimane Kouba || © 2018</p>
		</div>
	</footer>
</body>
</html>

	<!--########################## Modal #################-->
<?php
//Attribution des variables de session
$lvl=(isset($_SESSION['level']))?(int) $_SESSION['level']:1;
$id=(isset($_SESSION['id']))?(int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))?$_SESSION['pseudo']:'';

	if (!isset($_POST['pseudo'])){ //On est dans la page de formulaire
	echo'<div id="modalConnexion" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<form class="form-horizontal">
							<div class="form-group">
								<label for="pseudo1" class="col-sm-3 control-label">Pseudo</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="pseudo1" placeholder="Entrez votre pseudo..." />
								</div>
							</div>
							<div class="form-group">
								<label for="mdp1" class="col-sm-3 control-label">Mot de passe</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="mdp1" placeholder="Entrez votre mot de passe..." />
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3"></div>
								<div class="col-sm-9">
									<button type="submit" class="btn btn-primary">Connexion</button>
									<button type="button" class="btn btn-danger btn_retour">Annuler</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>';
	}
	else
	{
	    $message='';		//pour stocker le message d'erreur
	    if (empty($_POST['pseudo']) || empty($_POST['password']) ) //Oublie d'un champ
	    {
	        $message = '<p>une erreur s\'est produite pendant votre identification.
		Vous devez remplir tous les champs</p>
		<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
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
					vous êtes maintenant connecté!</p>
					<p>Cliquez <a href="./index.php">ici</a> 
					pour revenir à la page d accueil</p>';  
			}
			else // Acces pas OK !
			{
			    $message = '<p>Une erreur s\'est produite 
			    pendant votre identification.<br /> Le mot de passe ou le pseudo 
		            entré n\'est pas correcte.</p><p>Cliquez <a href="./connexion.php">ici</a> 
			    pour revenir à la page précédente
			    <br /><br />Cliquez <a href="./index.php">ici</a> 
			    pour revenir à la page d accueil</p>';
			}
		    $query->CloseCursor();
	    }
	    echo $message.'</div></body></html>';

	}

	if (empty($_POST['pseudo'])){ // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
	echo'<div id="modalInscrire" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<form class="form-horizontal">
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
								<label for="mdp2" class="col-sm-3 control-label">Confirmer mot de passe</label>
								<div class="col-sm-9">
									<input type="password" class="form-control" id="mdp2" placeholder="Veuillez confirmer votre mot de passe..." />
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3">
								</div>
								<div class="col-sm-9">
									<button type="submit" class="btn btn-primary">S\'inscrire</button>
									<button type="button" class="btn btn-danger btn_retour">Annuler</button>			
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>';
	}
?>