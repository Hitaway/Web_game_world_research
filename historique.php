<?php 
	session_start();
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
		<?php require("header.php"); ?>
	    <div class="container" id="container_historique">
			<div class="panel panel-default" id="onglet_historique">
				<div class="panel-heading col-lg-12 col-md-12 col-sm-12">Historique</div>
				<?php afficheHistorique($bd, $_SESSION['pseudo']); ?>
			</div>
		</div>
		<?php require("footer.php"); ?>
	</body>
</html>