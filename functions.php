<?php
	function afficheClassement($bd, $nbJoueurAAfficher)
	{
		try
		{
			$req = $bd->prepare('SELECT * FROM CLASSEMENT');
			$req->execute();
			$res = $req->fetch(PDO::FETCH_ASSOC);

			//Il y a au moins une ligne
			if($res)
			{
				//stocker les requetes dans un tableau pour pouvoir les mettre dans un l'ordre ensuite
				$val = 1;
				do{
			    	$tableau[] = $res;
			    	if($val == $nbJoueurAAfficher)
			    		break;
			    	$val ++;
				}while($res = $req->fetch(PDO::FETCH_ASSOC));
				
				// Obtient une liste de colonnes
				foreach ($tableau as $key => $row)
   					$score[$key]  = $row['score'];

   				// Trie les données par rang croissant
				// Ajoute $tableau en tant que dernier paramètre, pour trier par la clé commune
				array_multisort($score,SORT_DESC,$tableau);
				
				echo '<table class="table">';
				//On affiche les en-têtes
				echo '<thead>';
				echo '<tr> <th>#</th> <th>Pseudo</th> <th>Score</th></tr>';
				echo '</thead>';
				echo '<tbody>';
				$place = 1;		//place du joueur dans le classement
		 		foreach($tableau as $cle)
				{
					//On affiche chaque ligne de résultat
					echo '<tr>';
					echo '<th scope="row">'.$place.'</th>';
					echo '<td>'.$cle['pseudo'].'</td><td>'.$cle['score'].'</td>';
					echo '</tr>';
					$place ++;
				}
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

	    /*if (!(filter_var($email, FILTER_VALIDATE_EMAIL)))
	        return "email a un format non adapté";*/
	        
	    try
	    {
	      $req = $bd->prepare('SELECT * FROM UTILISATEURS');
	      $req->execute();
	      $res = $req->fetch(PDO::FETCH_ASSOC);

	      do{
	          if($res['email'] == $tableau['email'])
	            return "mail deja utiliser";
	      }while($res = $req->fetch(PDO::FETCH_ASSOC));
	      $req->CloseCursor();
	    }
	    catch(PDOException $e)
	    {
	        // On termine le script en affichant le n de l'erreur ainsi que le message 
	        die('<p> Erreur : ' . $e->getMessage() . '</p>');
	    }

	    try
	    {
	      $req = $bd->prepare('SELECT * FROM UTILISATEURS');
	      $req->execute();
	      $res = $req->fetch(PDO::FETCH_ASSOC);

	      do{
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

 	function longOuLatValide($value){
 		return preg_match("#^[-]?(([0-9]+\.[0-9]+)|([0-9]+))$#", $value);
 	}

?>
