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
		}
		catch(PDOException $e)
		{
		  	// On termine le script en affichant le n de l'erreur ainsi que le message 
	    	die('<p> Erreur : ' . $e->getMessage() . '</p>');
		}	
		echo '</table>';
	}
?>
