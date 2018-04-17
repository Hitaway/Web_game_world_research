<!doctype html>
<html lang="fr">
<head>
 	<meta charset="utf-8">
 	<title>Titre de la page</title>
 	<link rel="stylesheet" type="text/css" href="accueil.css">
 	<link rel="shortcut icon" href="Image/icone.ico">
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 	<script src="script.js"></script>
</head>
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
	if (!isset($_POST['pseudo1'])){ //On est dans la page de formulaire
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
									<input type="email" class="form-control" id="mdp1" placeholder="Entrez votre mot de passe..." />
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

	if (empty($_POST['pseudo1'])){ // Si on la variable est vide, on peut considérer qu'on est sur la page de formulaire
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