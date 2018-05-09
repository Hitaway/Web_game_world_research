<?php 
	session_start();
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
	<?php require("header.php"); ?>
	<form class="form-horizontal container" method="post" id="formulaire">
       	<div class="row form-group">
        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
           	<label for="nom_questionnaire" class="col-xs-4 col-sm-4 col-md-4 col-lg-4 control-label" id="nom_questionnaire_titre">Nom du questionnaire</label>
        </div>
        <div class="row form-group">
           	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
           	<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"><input type="text" class="form-control" name="nom_questionnaire" placeholder="Entrez le nom du questionnaire..." /></div>
        </div>

    	<?php
    		//Générer le code html pour afficher le formulaire des 7 questions
    		for ($i = 1; $i <= 7; $i++){
		        echo '<hr class="trait_separateur_question">
		        <div class="row form-group">
		        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"></div>
		           	<label for="question'.$i.'" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Question '.$i.'</label>
		           	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		           		<input type="text" class="form-control" name="question'.$i.'" placeholder="Entrez la question..." />
		            </div>
		        </div>
		        <div class="row form-group">
		        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
		        	<label for="Latitude'.$i.'" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Latitude</label>
		            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		                <input type="text" class="form-control" name="latitude'.$i.'" placeholder="Entrez la Longitude..." />
		            </div>
		            <label for="longitude'.$i.'" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Longitude</label>
		            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		                <input type="text" class="form-control" name="longitude'.$i.'" placeholder="Entrez la Latitude..." />
		            </div>
				</div>';   
			}
	    ?>
	    <div class="row">
        	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10"></div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <button type="submit" class="btn btn-primary" id="btn_enregistrer">Enregistrer</button>   
            </div>
        </div> 
    </form>

	<?php 
	$param = array('nom_questionnaire','question1','latitude1','longitude1',
							'question2','latitude2','longitude2',
							'question3','latitude3','longitude3',
							'question4','latitude4','longitude4',
							'question5','latitude5','longitude5',
							'question6','latitude6','longitude6',
							'question7','latitude7','longitude7');

	if(testValeurExist($param,$_POST))
  	{
  		if(testPasVide($param,$_POST))
  		{
  			//Test si la longitude et latitude sont bien des float
        	if(longOuLatValide($_POST['latitude1']) && longOuLatValide($_POST['longitude1']) &&
        		longOuLatValide($_POST['latitude2']) && longOuLatValide($_POST['longitude2']) &&
    			longOuLatValide($_POST['latitude3']) && longOuLatValide($_POST['longitude3']) &&
				longOuLatValide($_POST['latitude4']) && longOuLatValide($_POST['longitude4']) &&
				longOuLatValide($_POST['latitude5']) && longOuLatValide($_POST['longitude5']) &&
				longOuLatValide($_POST['latitude6']) && longOuLatValide($_POST['longitude6']) &&
				longOuLatValide($_POST['latitude7']) && longOuLatValide($_POST['longitude7']))
        	{
        		if(VerifQuestionEnDouble($_POST)){
	        		$sql = 'INSERT INTO QUESTIONNAIRES (nom_questionnaire) VALUES (:nom_questionnaire)';
	        		$req = $bd->prepare($sql);
		            $req->bindValue(':nom_questionnaire',htmlspecialchars($_POST['nom_questionnaire']));
		            $req->execute();
		            $req->CloseCursor();

		          	try
		          	{
		          		$sql = 'INSERT INTO QUESTIONS (intitule, nom_questionnaire, latitude, longitude) VALUES (:intitule, :nom_questionnaire, :latitude, :longitude)';
		          		//Ajouter les 7 questions
		          		for ($i = 1; $i <= 7; $i++)
		          		{
			            	$req = $bd->prepare($sql);
			              	$req->bindValue(':intitule',htmlspecialchars($_POST['question'.$i]));
			              	$req->bindValue(':nom_questionnaire',htmlspecialchars($_POST['nom_questionnaire']));
			              	$req->bindValue(':latitude',htmlspecialchars($_POST['latitude'.$i]));
			              	$req->bindValue(':longitude',htmlspecialchars($_POST['longitude'.$i]));
			              	$req->execute();
			              	$req->CloseCursor();
			            }
		          	}
		         	catch(PDOException $e)
		          	{
		            	die('<p>Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
		          	}
		        }
		        else
		        {
		        	echo "Il y a des questions en double";
		        }
  			}
  			else
  			{
  				echo "La longitude et latitude ne sont pas des float";
  			}
  		}
  		else
  		{
  			echo "des valeurs sont vide transmettre en JSON au JS pour voir qu'es qui est vide et mettre le contour en rouge";
  		}
  	} 
	?>

	<?php require("footer.php"); ?>
	</body>
</html>