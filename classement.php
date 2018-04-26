<?php 
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
		<?php require("header.php"); ?>
		<div class="panel panel-default">
			<div class="panel-heading">Classement</div>
			<?php afficheClassement($bd); ?>
		</div>
	</body>
</html>