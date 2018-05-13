<?php
	function afficheClassement($bd, $nbJoueurAAfficher)
	{
		try
		{
			$req = $bd->prepare('SELECT * FROM CLASSEMENT ORDER BY score DESC');
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);

			//Il y a au moins une ligne
			if($res)
			{	
				echo '<table class="table">';
				//On affiche les en-têtes
				echo '<thead>';
				echo '<tr> <th>#</th> <th>Pseudo</th> <th>Score</th></tr>';
				echo '</thead>';
				echo '<tbody>';
				$place = 1;		//place du joueur dans le classement
		 		do{
					//On affiche chaque ligne de résultat
					echo '<tr>';
					echo '<th scope="row">'.$place.'</th>';
					echo '<td>'.$res['pseudo'].'</td><td>'.$res['score'].'</td>';
					echo '</tr>';
					if($place >= $nbJoueurAAfficher)
						break;
					$place ++;
				}while($res = $req->fetch(PDO::FETCH_ASSOC));
				echo '</tbody>';
				echo '</table>';
			}
			else
				echo '<p style="text-align: center;">Aucun joueur dans la base de données </p>';
			$req->CloseCursor();
		}
		catch(PDOException $e)
		{
		  	// On termine le script en affichant le n de l'erreur ainsi que le message 
	    	die('<p> Erreur : ' . $e->getMessage() . '</p>');
		}
		echo '</table>';
	}

	function afficheJoueurs($bd)
	{
		try
		{
			$req = $bd->prepare('SELECT * FROM UTILISATEURS');
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);

			//Il y a au moins une ligne
			if($res)
			{
				echo '<table class="table">';
				//On affiche les en-têtes
				echo '<thead>';
				echo '<tr><th>Pseudo</th> <th>prenom</th><th>nom</th><th>email</th><th>date inscription</th><th>droit</th></tr>';
				echo '</thead>';
				echo '<tbody>';
		 		do
				{
					echo '<tr>';
					echo '<td>'.$res['pseudo'].'</td><td>'.$res['prenom'].'</td><td>'.$res['nom'].'</td><td>'
						.$res['email'].'</td><td>'.$res['date_inscription'].'</td><td>'
						.$res['droit'].'</td>';
					echo '<td><a href="gerer_utilisateur.php?delete='.urlencode($res['pseudo']).'"><span class="glyphicon glyphicon-trash"></span></a></td>';
					echo '</tr>';
				}while($res = $req->fetch(PDO::FETCH_ASSOC));
			}
			else
				echo '<p style="text-align: center;">Aucun joueur dans la base de données </p>';
		}
		catch(PDOException $e)
		{
		  	// On termine le script en affichant le n de l'erreur ainsi que le message 
		   	die('<p> Erreur : ' . $e->getMessage() . '</p>');
		}	
		echo '</table>';
	}

	function afficheQuestionnaires($bd)
	{
		try
		{
			$req = $bd->prepare('SELECT * FROM QUESTIONS ORDER BY nom_questionnaire');
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);

			//Il y a au moins une ligne
			if($res)
			{
				echo '<table class="table">';
				//On affiche les en-têtes
				echo '<thead>';
				echo '<tr><th>Nom questionnaire</th><th>intitule question</th><th>latitude</th><th>longitude</th></tr>';
				echo '</thead>';
				echo '<tbody>';
				$num_question = 1;
		 		do
				{
					echo '<tr>';
					if($num_question == 1)
						echo '<td>'.$res['nom_questionnaire'].'</td>';
					else
						echo '<td></td>';
					echo'<td>'.$res['intitule'].'</td><td>'.$res['latitude'].'</td>
					<td>'.$res['longitude'].'</td>';
					if($num_question == 1)
						echo '<td><a href="gerer_questionnaire.php?delete='.urlencode($res['nom_questionnaire']).'"><span class="glyphicon glyphicon-trash"></span></a></td>';
					echo '</tr>';
					if($num_question == 7)
						$num_question = 1;
					else
						$num_question ++;
				}while($res = $req->fetch(PDO::FETCH_ASSOC));
			}
			else
				echo '<p style="text-align: center;">Aucun joueur dans la base de données </p>';
		}
		catch(PDOException $e)
		{
		  	// On termine le script en affichant le n de l'erreur ainsi que le message 
		   	die('<p> Erreur : ' . $e->getMessage() . '</p>');
		}	
		echo '</table>';
	}

	function afficheHistorique($bd, $pseudo)
	{
		try
		{
			$req = $bd->prepare('SELECT * FROM HISTORIQUE WHERE pseudo = :pseudo ORDER BY date_partie DESC');
			$req->bindValue(':pseudo',$pseudo);
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);

			//Il y a au moins une ligne
			if($res)
			{	
				echo '<table class="table">';
				//On affiche les en-têtes
				echo '<thead>';
				echo '<tr><th>Date</th> <th>Pseudo</th> <th>Score</th></tr>';
				echo '</thead>';
				echo '<tbody>';
				do{
					//On affiche chaque ligne de résultat
					echo '<tr>';
					echo '<td>'.$res['date_partie'].'</td><td>'.$res['nom_questionnaire'].'</td><td>'.$res['score'].'</td>';
					echo '</tr>';
				}while($res = $req->fetch(PDO::FETCH_ASSOC));
				echo '</tbody>';
				echo '</table>';
			}
			else
				echo '<p style="text-align: center;"> Historique vide </p>';
			$req->CloseCursor();
		}
		catch(PDOException $e)
		{
		  	// On termine le script en affichant le n de l'erreur ainsi que le message 
	    	die('<p> Erreur : ' . $e->getMessage() . '</p>');
		}	
		echo '</table>';
	}

	//Test si les valeurs du premier tableau ($cle) sont des clés du deuxième
	function testValeurExist($cle,$tableau)
	{
	  	foreach($cle as $v){
	      	if(!isset($tableau[$v]))
	        	return false;
	    }
	    return true;
	}
	  
	//Test si les valeurs ne sont pas vides
	function testPasVide($cle,$tableau)
	{
	    foreach($cle as $v){
	      	if(trim($tableau[$v])== '')
	        	return false;
	    }
	    return true;
	}

	function verifSaisieUtilisateur($bd, $tableau)
  	{
  		$error = array();
	    if(strlen($tableau['nom']) >= 35)
	      $error['nom_long'] = "Nom trop long";

	    if(strlen($tableau['prenom']) >= 35)
	      $error['prenom_long'] = "Prenom trop long";

	    if(strlen($tableau['pseudo2']) >= 35)
	      $error['pseudo_long'] = "Pseudo trop long";

	    if(strlen($tableau['mail']) >= 60)
	      $error['mail_court'] = "Adresse mail trop long";

	    if(strlen($tableau['mdp2']) >= 150 || strlen($tableau['mdp3']) >= 150)
	      $error['mdp_long'] = "Mot de passe trop long";

	    if(strlen($tableau['mdp3']) < 8 || strlen($tableau['mdp2']) < 8)
	      $error['mdp_court'] = "Mot de passe trop court";

	    if($tableau['mdp3'] != $tableau['mdp2'])
	      $error['different'] = "Mot de passe de confirmation different";
	        
	    try
	    {
	      $req = $bd->prepare('SELECT * FROM UTILISATEURS');
	      $req->execute();
	      $res = $req->fetch(PDO::FETCH_ASSOC);

	      do{
	          if($res['email'] == $tableau['email'])
	            $error['email_utilise'] = "Mail déja utilisé";
	          if($res['pseudo'] == $tableau['pseudo2'])
	            $error['pseudo_utilise'] =  "Pseudo déja utilisé";
	      }while($res = $req->fetch(PDO::FETCH_ASSOC));
	      $req->CloseCursor();
	    }
	    catch(PDOException $e)
	    {
	        // On termine le script en affichant le n de l'erreur ainsi que le message 
	        die('<p> Erreur : ' . $e->getMessage() . '</p>');
	    }

	    return $error;
 	}

 	//Verifier si la Longitude et Latitude rentrer est bien un entier
 	function longOuLatValide($value){
 		return preg_match("#^[-]?(([0-9]+\.[0-9]+)|([0-9]+))$#", $value);
 	}

 	function VerifQuestionEnDouble($tableau){
 		for ($i = 1; $i <= 7; $i++){
 			for ($j = 1; $j <= 7; $j++){
 				if($tableau['question'.$i] == $tableau['question'.$j] && $i!=$j)
 					return false;	//Deux questions sont identique on retourne false
 			}
 		}
 		return true;	//S'il n'y a pas de doublons dans les questions on retourne true
 	}

 	function VerifQuestionnaireDejaExistant($bd, $tableau)
 	{
 		try
	    {
		    $req = $bd->prepare('SELECT * FROM QUESTIONNAIRES');
		    $req->execute();
		    $res = $req->fetch(PDO::FETCH_ASSOC);

		    do{
		        if($res['nom_questionnaire'] == $tableau['nom_questionnaire'])
		     	    return false;
		    }while($res = $req->fetch(PDO::FETCH_ASSOC));
		    $req->CloseCursor();
	    }
	    catch(PDOException $e)
	    {
	        // On termine le script en affichant le n de l'erreur ainsi que le message 
	        die('<p> Erreur : ' . $e->getMessage() . '</p>');
	    }
	    return true;
 	}

 	function formulaire_ajouter_question_valide($bd,$cle,$tableau)
 	{
 		$error = array();
 		if(testPasVide($cle,$tableau) == false)
			$error['champ_vide'] = "Veillez saisir tout les champs";
		else
		{
	 		if((longOuLatValide($tableau['latitude1']) && longOuLatValide($tableau['latitude2']) &&
	 			longOuLatValide($tableau['latitude3']) && longOuLatValide($tableau['latitude4']) &&
				longOuLatValide($tableau['latitude5']) && longOuLatValide($tableau['latitude6']) &&
				longOuLatValide($tableau['latitude7'])) == false)
					$error['latitude']= "Valeur pour la latitude non valide";

			if((longOuLatValide($tableau['longitude1']) && longOuLatValide($tableau['longitude2']) &&
				longOuLatValide($tableau['longitude3']) && longOuLatValide($tableau['longitude4']) &&
				longOuLatValide($tableau['longitude5']) && longOuLatValide($tableau['longitude6']) &&
				longOuLatValide($tableau['longitude7'])) == false)
					$error['longitude'] = "Valeur pour la longitude non valide";

			if(VerifQuestionEnDouble($tableau) == false)
				$error['question_double'] = "Saisir des questions différente pour chaque champ";

			if(VerifQuestionnaireDejaExistant($bd, $tableau) == false)
				$error['questionnaire_existant'] = "Le questionnaire que vous voulez ajoutez éxiste déja";
		}

		return $error;
 	}

 	//Renvoi une chaine de caractère aléatoire
 	function random_str()
 	{
 		$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
 		return substr(str_shuffle(str_repeat($alphabet, 60)), 0, 60);
 	}
?>
