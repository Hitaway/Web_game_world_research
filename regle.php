<?php 
	session_start();
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
		<?php require("header.php"); ?>
		<div class="container">
			<div class="bloc">
				<div class="col-xs-2 col-sm-2 col-md-2 sol-lg-2 bloc_img">
					<img src="Image/Logo_liste.png" alt="img_explicative" class="bloc_taille_img">
				</div>
				<div class="col-xs-9 col-sm-9 col-md-9 sol-lg-9">
					<h3>Règles du Jeu</h3>
					<p>
					Le jeu est composé d'un ensemble de questionnaires de 7 questions. Le but est de trouver les lieux, monument ... Vous disposez pour cela de cinq essais pour localiser la cible. Si la difficulté est trop grande vous pouvez vous aider d'un mode langue au chat qui s’affiche après les 5 essais.
					Lorsque vous cliquez sur la map des pop-ups apparaissent pour vous avertir de la proximité du lieu recherché.
					</p>
				</div>
			</div>
			<div class="bloc">
				<div class="col-xs-2 col-sm-2 col-md-2 sol-lg-2 bloc_img">
					<img src="Image/logo_bareme.png" alt="img_explicative" class="bloc_taille_img">
				</div>
				<div class="col-xs-9 col-sm-9 col-md-9 sol-lg-9">
					<h3>Barème</h3>
					<p>
						Le score maximum est de 70 points. L'attribution des points est calculée en fonction de l'écart entre votre sélection et le lieu à trouver.
						Si vous êtes à une distance supérieure à 4500 km vous gagnez 0 point, pour une distance entre 2251 km et 4250 km vous gagnez 2 points, pour une distance entre 2249 km et 451 km vous gagnez 5 points, pour une distance entre 450 km et 251 km vous gagnez 9 points et pour une distance inférieure à 250 km vous obtenez le score maximum soit 10 points.
					</p>
				</div>
			</div>
			<div class="bloc">
				<div class="col-xs-2 col-sm-2 col-md-2 sol-lg-2 bloc_img">
					<img src="Image/logo_info.png" alt="img_explicative" class="bloc_taille_img">
				</div>
				<div class="col-xs-9 col-sm-9 col-md-9 sol-lg-9">
					<h3>Informations</h3>
					<p>
						Un onglet "Infos" est à votre disposition, il permet de vous donner des indices sur les lieux à rechercher par exemple il peut vous indiquer dans quel continent il se trouve. Il vous donnera aussi d'information historique sur les lieux qui ont pour but d'enrichir votre culture générale. Cet onglet ne vous enlève pas de point si vous l'utilisez.
					</p>
				</div>
			</div>
			<div class="bloc">
				<div class="col-xs-2 col-sm-2 col-md-2 sol-lg-2 bloc_img">
					<img src="Image/podium.png" alt="img_explicative" class="bloc_taille_img">
				</div>
				<div class="col-xs-9 col-sm-9 col-md-9 sol-lg-9" style="margin-bottom: 160px;">
					<h3>Classement</h3>
					<p>
						Un classement général est présent regroupant les 10 meilleurs joueurs qui ont obtenu le meilleur score tout questionnaire confondu.
						Un ensemble de questionnaires est proposé, vous pouvez y jouer seulement si vous êtes connectés sinon vous n'aurezaurai accès qu'aux questionnaires 7 merveilles du monde.
						Vous avez la possibilité de voir sur votre compte toutes les parties que vous avez jouées regroupant la date, le score final ainsi que le nom du questionnaire. À vous maintenant de jouer et d'essayer d'être dans le top 10.
					</p>
				</div>
			</div>
		</div>
		<?php require("footer.php"); ?>
	</body>
</html>