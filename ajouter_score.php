<?php
session_start();
require ("identifiants.php");
require("carte.php");

 
        try
        {
           
            //$pseudo=$_POST['pseudo'];
            //$nom_questionnaire=$_GET['nom_questionnaire'];
            $score=$_POST['score'];
            $nom_questionnaire="7 merveille du monde";
            //$score=28;
            $pseudo="Slimane93";
            //$nom_questionnaire="7 merveille du monde";
            //$score=28;
            //Insérer la partie courante dans l'historique
            $req = $bd->prepare('INSERT INTO HISTORIQUE (id, pseudo, nom_questionnaire, date_partie, score) VALUES (:id, :pseudo, :nom_questionnaire, :date_partie, :score)');
            $req->bindValue(':id',NULL);
            $req->bindValue(':pseudo',htmlspecialchars($pseudo));
            $req->bindValue(':nom_questionnaire',htmlspecialchars($nom_questionnaire));
            $req->bindValue(':date_partie',date("Y-m-d"));
            $req->bindValue(':score',htmlspecialchars($score));
            $req->execute();
            $req->CloseCursor();

            //Récupérer le score min dans la classement pour tester si le joueur a éfectuer un record
            $req = $bd->prepare('SELECT * FROM CLASSEMENT WHERE score = (SELECT MIN(score) FROM CLASSEMENT) LIMIT 1');
            $req->execute();
            $res = $req->fetch(PDO::FETCH_ASSOC);
            //Si score du joueur courant est supérieur au score min de la table classement
            if($res['score'] < $score){
                //On supprime le joueur qui a le plus petit score de la table classement
                $req_delete = $bd->prepare('DELETE FROM CLASSEMENT WHERE id = :id');
                $req_delete->bindValue(':id', $res['id']);
                $req_delete->execute();

                //On ajoute le joueur courant
                $req_insert = $bd->prepare('INSERT INTO CLASSEMENT (id, score, pseudo) VALUES (:id, :score, :pseudo)');
                $req_insert->bindValue(':id',NULL);
                $req_insert->bindValue(':pseudo',htmlspecialchars($pseudo));
                $req_insert->bindValue(':score',htmlspecialchars($score));
                $req_insert->execute();
            }
            $req->CloseCursor();
        }
        catch(PDOException $e)
        {
            die('<p>Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
        }
        //header('Location: accueil.php');
?>        