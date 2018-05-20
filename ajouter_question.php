<?php 
	session_start();
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
	<?php 
		echo '<div class="alert alert-success alert-dismissible" role="alert" id="notification_questionnaire">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                  	Le questionnaires <strong>'.$_POST['nom_questionnaire'].'</strong> à bien été créer.
              </div>';
	?>
	<?php require("header.php"); ?>
	<form class="form-horizontal container" method="post" id="formulaire" action="ajouter_question.php" enctype="multipart/form-data">
       	<div class="row form-group">
        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
           	<label for="nom_questionnaire" class="col-xs-8 col-sm-8 col-md-8 col-lg-8 control-label" id="nom_questionnaire_titre">Nom du questionnaire</label>
        </div>
        <div class="row form-group">
           	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
           	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
           		<input type="text" class="form-control" name="nom_questionnaire" placeholder="Entrez le nom du questionnaire..." />
           	</div>
        </div>
        <input type="hidden" name="MAX_FILE_SIZE" value="16777216" /> <!-- taille max total de tout les fichiers à upload 16Mo -->

    	<?php
    		//Générer le code html pour afficher le formulaire des 7 questions
    		for ($i = 1; $i <= 7; $i++){
		        echo '<hr class="trait_separateur_question">
		        <div class="row form-group">     	
		           	<label for="question'.$i.'" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Question '.$i.'</label>
		           	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		           		<input type="text" class="form-control" name="question'.$i.'" placeholder="Entrez la question..." />
		            </div>
		        </div>
		        <div class="row form-group">
		        	<label for="Latitude'.$i.'" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Latitude</label>
		            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		                <input type="text" class="form-control" name="latitude'.$i.'" placeholder="Entrez la Longitude..." />
		            </div>
		            <label for="longitude'.$i.'" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Longitude</label>
		            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		                <input type="text" class="form-control" name="longitude'.$i.'" placeholder="Entrez la Latitude..." />
		            </div>
				</div>
				<div class="row form-group">
					<label for="information1_q'.$i.'" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Information 1</label>
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
						<textarea id="information1_q'.$i.'" name="information1_q'.$i.'" class="form-control"  rows="2" style="width: 100%;"></textarea>
		       		</div>
       			</div>
       			<div class="row form-group">
					<label for="information2_q'.$i.'" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Information 2</label>
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
						<textarea id="information2_q'.$i.'" name="information2_q'.$i.'" class="form-control"  rows="2" style="width: 100%;"></textarea>
		       		</div>
       			</div>
       			<div class="row form-group">
					<label for="information3_q'.$i.'" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Information 3</label>
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
						<textarea id="information3_q'.$i.'" name="information3_q'.$i.'" class="form-control"  rows="2" style="width: 100%;"></textarea>
		       		</div>
       			</div>
				<div class="row form-group">
       					<label for="photo'.$i.'" class="col-xs-6 col-sm-6 col-md-6 col-lg-6 control-label">Photo au format (JPG, PNG ou GIF | max. 2 Mo) </label>
        				<input type="file" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" name="photo'.$i.'" id="photo'.$i.'"/>
        		</div>';
			}

			$error_ajout_question = array();
			$param = array('nom_questionnaire','question1','latitude1','longitude1','information1_q1','information2_q1','information3_q1',
							'question2','latitude2','longitude2','information1_q2','information2_q2','information3_q2',
							'question3','latitude3','longitude3','information1_q3','information2_q3','information3_q3',
							'question4','latitude4','longitude4','information1_q4','information2_q4','information3_q4',
							'question5','latitude5','longitude5','information1_q5','information2_q5','information3_q5',
							'question6','latitude6','longitude6','information1_q6','information2_q6','information3_q6',
							'question7','latitude7','longitude7','information1_q7','information2_q7','information3_q7');

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
				        $sql = 'INSERT INTO QUESTIONS (intitule, nom_questionnaire, latitude, longitude, information1, information2, information3) VALUES (:intitule, :nom_questionnaire, :latitude, :longitude, :info1, :info2, :info3)';
				        //Ajouter les 7 questions
				        for ($i = 1; $i <= 7; $i++)
				        {
					        $req = $bd->prepare($sql);
					        $req->bindValue(':intitule',htmlspecialchars($_POST['question'.$i]));
					        $req->bindValue(':nom_questionnaire',htmlspecialchars($_POST['nom_questionnaire']));
					        $req->bindValue(':latitude',htmlspecialchars($_POST['latitude'.$i]));
					        $req->bindValue(':longitude',htmlspecialchars($_POST['longitude'.$i]));
					        $req->bindValue(':info1',htmlspecialchars($_POST['information1_q'.$i]));
					        $req->bindValue(':info2',htmlspecialchars($_POST['information2_q'.$i]));
					        $req->bindValue(':info3',htmlspecialchars($_POST['information3_q'.$i]));
					        $req->execute();
					        $req->CloseCursor();

					        mkdir('Image/'.$_POST['nom_questionnaire'].'/', 0777, true);
					        move_uploaded_file($_FILES['photo1']['tmp_name'],'Image/'.$_POST['nom_questionnaire'].'/img_q1');
					        move_uploaded_file($_FILES['photo2']['tmp_name'],'Image/'.$_POST['nom_questionnaire'].'/img_q2');
					        move_uploaded_file($_FILES['photo3']['tmp_name'],'Image/'.$_POST['nom_questionnaire'].'/img_q3');
					        move_uploaded_file($_FILES['photo4']['tmp_name'],'Image/'.$_POST['nom_questionnaire'].'/img_q4');
					        move_uploaded_file($_FILES['photo5']['tmp_name'],'Image/'.$_POST['nom_questionnaire'].'/img_q5');
					        move_uploaded_file($_FILES['photo6']['tmp_name'],'Image/'.$_POST['nom_questionnaire'].'/img_q6');
					        move_uploaded_file($_FILES['photo7']['tmp_name'],'Image/'.$_POST['nom_questionnaire'].'/img_q7');
					        
					        //suprimer variable POST après insertion
					        unset($_POST['question'.$i], $_POST['latitude'.$i], $_POST['longitude'.$i]);
					    }
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
                echo '<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">';
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