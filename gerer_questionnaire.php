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
				<div class="panel-heading col-lg-12 col-md-12 col-sm-12">Questionnaires</div>
				<?php 
					if(isset($_GET['delete']) && trim($_GET['delete'])){
						try
			          	{
				            $req = $bd->prepare('DELETE FROM `QUESTIONS` WHERE nom_questionnaire = :nom_questionnaires');
				            $req->bindValue(':nom_questionnaires',htmlspecialchars($_GET['delete']));
				            $req->execute();
				            $req->CloseCursor();

				            $req = $bd->prepare('DELETE FROM `QUESTIONNAIRES` WHERE nom_questionnaire = :nom_questionnaires');
				            $req->bindValue(':nom_questionnaires',htmlspecialchars($_GET['delete']));
				            $req->execute();
				            $req->CloseCursor();
			          	}
			         	catch(PDOException $e)
			          	{
			            	die('<p>Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
			          	}
					}
					afficheQuestionnaires($bd); ?>
			</div>
		</div>
		<?php require("footer.php"); ?>
	</body>
</html>