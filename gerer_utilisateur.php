<?php 
	session_start();
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
		<?php require("header.php"); ?>
	    <div class="container classement">
			<div class="panel panel-default tableau">
				<div class="panel-heading col-lg-12 col-md-12 col-sm-12">Utilisateurs</div>
				<?php  
					if(isset($_GET['delete']) && trim($_GET['delete'])){
						try
			          	{
				            $req = $bd->prepare('DELETE FROM `CLASSEMENT` WHERE pseudo = :pseudo');
				            $req->bindValue(':pseudo',htmlspecialchars($_GET['delete']));
				            $req->execute();
				            $req->CloseCursor();

				            $req = $bd->prepare('DELETE FROM `HISTORIQUE` WHERE pseudo = :pseudo');
				            $req->bindValue(':pseudo',htmlspecialchars($_GET['delete']));
				            $req->execute();
				            $req->CloseCursor();

				           	$req = $bd->prepare('DELETE FROM `UTILISATEURS` WHERE pseudo = :pseudo');
				            $req->bindValue(':pseudo',htmlspecialchars($_GET['delete']));
				            $req->execute();
				            $req->CloseCursor();
			          	}
			         	catch(PDOException $e)
			          	{
			            	die('<p>Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
			          	}
					}
					afficheJoueurs($bd); 
				?>
			</div>
		</div>
		<?php require("footer.php"); ?>
	</body>
</html>