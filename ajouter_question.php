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

			$error_ajout_question = array();
			$param = array('nom_questionnaire','question1','latitude1','longitude1',
									'question2','latitude2','longitude2',
									'question3','latitude3','longitude3',
									'question4','latitude4','longitude4',
									'question5','latitude5','longitude5',
									'question6','latitude6','longitude6',
									'question7','latitude7','longitude7');

			if(testValeurExist($param,$_POST))
		  	{
		  		$error_ajout_question = formulaire_ajouter_question_valide($bd,$param,$_POST);
		        if(empty($error_ajout_question)){
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
					        //suprimer variable POST après insertion
					        unset($_POST['question'.$i], $_POST['latitude'.$i], $_POST['longitude'.$i]);
					    }
					    echo '<div class="row form-group">';
                      	echo '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>';
                      	echo '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">';
				    	echo '<div class="alert alert-success alert-dismissible" role="alert">
                  				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  					Le questionnaires <strong>'.$_POST['nom_questionnaire'].'</strong> à bien été créer.
                			  </div>';
                      	echo '</div>';
                      	echo '</div>';
                		//suprimer variable POST après insertion
				    	unset($_POST['nom_questionnaire']);
				    }
					catch(PDOException $e)
				    {
				        die('<p>Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
				    }
				}
		  	}

		  	if(isset($error_ajout_question) && !(empty($error_ajout_question))){
		  		echo '<div class="row form-group">';
                echo '<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>';
                echo '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">';
                echo '<div class="alert alert-danger ">';
                echo '<p>Vous n\'avez pas rempli le formulaire correctement</p>';
                echo '<ul>';
                foreach ($error_ajout_question as $error)
                    echo '<li>'.$error.'</li>';
                echo '</ul>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            unset($_POST);
			?>
		    <div class="row">
        		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10"></div>
	            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
	                <button type="submit" class="btn btn-primary" id="btn_enregistrer">Enregistrer</button>   
	            </div>
        	</div> 
    </form>
	<?php require("footer.php"); ?>
	</body>
</html>