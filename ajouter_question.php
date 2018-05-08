<?php 
	session_start();
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
	<?php require("header.php"); ?>
	</br></br>
	<form class="form-horizontal container" method="post">
        <div class="row form-group">
           	<label for="nom_questionnaire" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Nom du questionnaire</label>
           	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
           		<input type="text" class="form-control" name="nom_questionnaire" placeholder="Entrez le nom du questionnaire..." />
            </div>
        </div>

		<!-- Question 1 -->
        <div class="row form-group">
           	<label for="question1" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Question 1</label>
           	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
           		<input type="text" class="form-control" name="question1" placeholder="Entrez la question..." />
            </div>
        </div>
        <div class="row form-group">
        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        	<label for="Latitude1" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Latitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="latitude1" placeholder="Entrez la Longitude..." />
            </div>
            <label for="longitude1" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Longitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="longitude1" placeholder="Entrez la Latitude..." />
            </div>
		</div>

		<!-- Question 2 -->
        <div class="row form-group">
           	<label for="question2" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Question 2</label>
           	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
           		<input type="text" class="form-control" name="question2" placeholder="Entrez la question..." />
            </div>
        </div>
        <div class="row form-group">
        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        	<label for="Latitude2" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Latitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="latitude2" placeholder="Entrez la Longitude..." />
            </div>
            <label for="longitude2" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Longitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="longitude2" placeholder="Entrez la Latitude..." />
            </div>
		</div>

		<!-- Question 3 -->
		<div class="row form-group">
           	<label for="question3" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Question 3</label>
           	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
           		<input type="text" class="form-control" name="question3" placeholder="Entrez la question..." />
            </div>
        </div>
        <div class="row form-group">
        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        	<label for="Latitude3" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Latitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="latitude3" placeholder="Entrez la Longitude..." />
            </div>
            <label for="longitude3" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Longitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="longitude3" placeholder="Entrez la Latitude..." />
            </div>
		</div>

		<!-- Question 4 -->
		<div class="row form-group">
           	<label for="question4" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Question 4</label>
           	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
           		<input type="text" class="form-control" name="question4" placeholder="Entrez la question..." />
            </div>
        </div>
        <div class="row form-group">
        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        	<label for="Latitude4" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Latitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="latitude4" placeholder="Entrez la Longitude..." />
            </div>
            <label for="longitude4" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Longitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="longitude4" placeholder="Entrez la Latitude..." />
            </div>
		</div>

		<!-- Question 5 -->
		<div class="row form-group">
           	<label for="question5" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Question 5</label>
           	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
           		<input type="text" class="form-control" name="question5" placeholder="Entrez la question..." />
            </div>
        </div>
        <div class="row form-group">
        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        	<label for="Latitude5" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Latitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="latitude5" placeholder="Entrez la Longitude..." />
            </div>
            <label for="longitude5" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Longitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="longitude5" placeholder="Entrez la Latitude..." />
            </div>
		</div>

		<!-- Question 6 -->
		<div class="row form-group">
           	<label for="question6" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Question 6</label>
           	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
           		<input type="text" class="form-control" name="question6" placeholder="Entrez la question..." />
            </div>
        </div>
        <div class="row form-group">
        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        	<label for="Latitude6" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Latitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="latitude6" placeholder="Entrez la Longitude..." />
            </div>
            <label for="longitude6" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Longitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="longitude6" placeholder="Entrez la Latitude..." />
            </div>
		</div>

		<!-- Question 7 -->
		<div class="row form-group">
           	<label for="question7" class="col-xs-2 col-sm-2 col-md-2 col-lg-2 control-label">Question 7</label>
           	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
           		<input type="text" class="form-control" name="question7" placeholder="Entrez la question..." />
            </div>
        </div>
        <div class="row form-group">
        	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
        	<label for="Latitude7" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Latitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="latitude7" placeholder="Entrez la Longitude..." />
            </div>
            <label for="longitude7" class="col-xs-1 col-sm-1 col-md-1 col-lg-1 control-label">Longitude</label>
            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                <input type="text" class="form-control" name="longitude7" placeholder="Entrez la Latitude..." />
            </div>
		</div>
        <div class="row">
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11"></div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <button type="submit" class="btn btn-primary" id="btn_enregistrer">Enregistrer</button>   
            </div>
        </div>       
    </form>

	<?php $param = array('nom_questionnaire','question1','latitude1','longitude1',
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