<?php 
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
		<?php require("header.php"); ?>
	    <div class="container" id="container_classement">
			<div class="panel panel-default" id="onglet_classement">
				<div class="panel-heading col-lg-12 col-md-12 col-sm-12">Classement</div>
				<?php afficheClassement($bd, 10); ?>
			</div>
		</div>
		<?php require("footer.php"); ?>
	</body>
</html>