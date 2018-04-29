<?php 
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>

<body>
	<!--########################## En-tête #################-->

	<div id="entête_img">
		<?php require("header.php"); ?>

	<!--########################## Entête avec le titre #################-->
   
	    <div id="img_map_marqueur"><img src="Image/map_marqueur.png" alt="img_monde"></div>
	    <h1 id="titre_research">RESEARCH</h1>
	    <hr class="trait_entête">
	    <hr class="trait_entête">
	    <p id="texte_play">Play</p>
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

    <div id="classement">
	    <div class="container">
		    <h1 class="display-3">Classement</h1>
		   	<div id="div_img_podium">
		   		<a href="classement.php"><img src="Image/podium.png" alt="img_podium" id="img_podium"></a>
		   	</div>
			<div class="panel panel-default">
				<div class="panel-heading col-lg-12 col-md-12 col-sm-12">Classement</div>
				<?php afficheClassement($bd, 3); ?>
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

	<!--########################## Pied de page #################-->
	<?php require("footer.php"); ?>
</body>
</html>