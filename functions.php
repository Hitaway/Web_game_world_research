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
				echo '<tr><th>Pseudo</th> <th>prenom</th><th>nom</th><th>email</th><th>mot de passe</th><th>date inscription</th><th>droit</th></tr>';
				echo '</thead>';
				echo '<tbody>';
		 		do
				{
					echo '<tr>';
					echo '<td>'.$res['pseudo'].'</td><td>'.$res['prenom'].'</td><td>'.$res['nom'].'</td><td>'
						.$res['email'].'</td><td>'.$res['mdp'].'</td><td>'.$res['date_inscription'].'</td><td>'
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
		 		do
				{
					echo '<tr>';
					echo '<td>'.$res['nom_questionnaire'].'</td><td>'.$res['intitule'].'</td><td>'.$res['latitude'].'</td>
					<td>'.$res['longitude'].'</td>';
					echo '<td><a href="gerer_questionnaire.php?delete='.urlencode($res['nom_questionnaire']).'"><span class="glyphicon glyphicon-trash"></span></a></td>';
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

	function afficheHistorique($bd, $pseudo){
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
	    if(strlen($tableau['nom']) >= 35)
	      return "nom trop long";

	    if(strlen($tableau['prenom']) >= 35)
	      return "prenom trop long";

	    if(strlen($tableau['pseudo2']) >= 35)
	      return "pseudo trop long";

	    if(strlen($tableau['mail']) >= 60)
	      return "adresse mail trop long";

	    if(strlen($tableau['mdp2']) >= 150 || strlen($tableau['mdp3']) >= 150)
	      return "mdp trop long";

	    if(strlen($tableau['mdp3']) < 8 || strlen($tableau['mdp2']) < 8)
	      return "mdp trop court";

	    if($tableau['mdp3'] != $tableau['mdp2'])
	      return "mdp de confirmation different du mdp";
	        
	    try
	    {
	      $req = $bd->prepare('SELECT * FROM UTILISATEURS');
	      $req->execute();
	      $res = $req->fetch(PDO::FETCH_ASSOC);

	      do{
	          if($res['email'] == $tableau['email'])
	            return "mail deja utiliser";
	          if($res['pseudo'] == $tableau['pseudo2'])
	            return "pseudo deja utiliser";
	      }while($res = $req->fetch(PDO::FETCH_ASSOC));
	      $req->CloseCursor();
	    }
	    catch(PDOException $e)
	    {
	        // On termine le script en affichant le n de l'erreur ainsi que le message 
	        die('<p> Erreur : ' . $e->getMessage() . '</p>');
	    }
	    //Si tout les champs sont correcte on retourne true
	    return true;
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
?>
