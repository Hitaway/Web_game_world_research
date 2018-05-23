<?php
  	require("identifiants.php");
?>

<?php
  $erreur_connexion = array();

  echo 'TEST 1='.$_POST['erreurConnexion'];

  if (isset($_POST['pseudo1']) && isset($_POST['mdp1'])){ //On verifie que les variable existe
      if (empty($_POST['pseudo1']) || empty($_POST['mdp1']) || !(trim($_POST['pseudo1'])) || !(trim($_POST['mdp1']))) //Oublie d'un champ
      {
        $erreur_connexion['saisie'] = "Veillez saisir tout les champs";

        $_POST['erreurConnexion']='false';
      }
      else 
      {
        $query=$bd->prepare('SELECT * FROM utilisateurs WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo1'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
        //On check le mot de passe
        if ($data['mdp'] == md5($_POST['mdp1'].$data['grain_de_sel'])) // MDP correct
        {
          $_SESSION['pseudo'] = $data['pseudo'];
          $_SESSION['droit'] = $data['droit'];
          echo '<div class="alert alert-success alert-dismissible notification" role="alert" id="notification_connexion">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Bienvenue <strong>'.$_SESSION['pseudo'].'</strong> ! Vous êtes maintenant connecté.
                </div>';

          $_POST['erreurConnexion']='true';

            echo 'TEST 2='.$_POST['erreurConnexion'];
        }
        else //si MDP incorrect
        {
          $erreur_connexion['identifiant'] = "Identifiant ou pseudo incorrect";

          $_POST['erreurConnexion']='false';
        }
        $query->CloseCursor();
      }
        echo 'TEST 3='.$_POST['erreurConnexion'];
        
        $arr = array('erreurConnexion' => $_POST['erreurConnexion']);
        echo json_encode($arr);
  }

  $param = array('nom','prenom','email','pseudo2','mdp2','mdp3');
  $erreur_inscription = array();
  //Si $_POST contient les clés nom, prenom, email... et qu'il y a des valeurs associées
  if(testValeurExist($param,$_POST))
  { 
      if(testPasVide($param,$_POST))
      {
        $erreur_inscription = verifSaisieUtilisateur($bd, $_POST);
        if(empty($erreur_inscription)){
          $sql = 'INSERT INTO UTILISATEURS (pseudo, prenom, nom, email, mdp, grain_de_sel, date_inscription, droit) VALUES (:pseudo, :prenom, :nom, :email, :mdp, :grain_de_sel, :date_inscription, :droit)';
          $grain_de_sel = random_str();
          try
          {
              $req = $bd->prepare($sql);
              $req->bindValue(':pseudo',htmlspecialchars($_POST['pseudo2']));
              $req->bindValue(':nom',htmlspecialchars($_POST['nom']));
              $req->bindValue(':prenom',htmlspecialchars($_POST['prenom']));
              $req->bindValue(':email',htmlspecialchars($_POST['email']));
              $req->bindValue(':mdp',htmlspecialchars(md5($_POST['mdp2'].$grain_de_sel)));
              $req->bindValue(':grain_de_sel',htmlspecialchars($grain_de_sel)); 
              $req->bindValue(':date_inscription',date("Y-m-d"));
              $req->bindValue(':droit',"user");
              $req->execute();
          }
          catch(PDOException $e)
          {
            die('<p>Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
          }
          echo '<div class="alert alert-success alert-dismissible notification" role="alert" id="notification_creer_compte">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Merci pour votre inscription ! Votre compte a bien été créé. 
                </div>';
        }
      }
      else
      {
        $erreur_inscription['saisie'] = "Veillez saisir tout les champs";
      }
  }
?>

<header>
	<nav class="navbar navbar-inverse" id="navbar">
  		<div class="container-fluid">
  			<!-- regroupe tout pour un meilleur affichage mobile -->
   			<div class="navbar-header">
      			<a class="navbar-brand navbar-left" href="accueil.php" id="titre_entete_logo">
      			<img src="Image/logo.png" width="30" height="30" class="d-inline-block align-top navbar-left" id="img_logo" alt="logo_page">  Research</a>
		    </div>
        <div id="li_entête">
          <ul class="nav navbar-nav">
            <li><a href="accueil.php">Accueil</a></li>
            <li class="li_entête"> <a href="classement.php" >Classement</a></li>
            <li><a href="regle.php" class="li_entête">Règles</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php 
  	          if($_SESSION['pseudo']==""){    //s'il n'est pas connecté on affiche les boutton Inscrire ou Connexion
  	            echo '<li><a data-toggle="modal" data-target="#modalConnexion" class="li_entête"><span class="glyphicon glyphicon-log-in"></span> Connexion</a></li>';
  	            echo '<li><a data-toggle="modal" data-target="#modalInscrire" class="li_entête"><span class="glyphicon glyphicon-user" ></span> S\'inscrire</a></li>';
  	          }
  	          if($_SESSION['pseudo']!=""){    //s'il est connecté on affiche
  	            echo '<li class="dropdown">
  	          			<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
  	          			<span class="glyphicon glyphicon-user"></span> '.$_SESSION['pseudo'].'<span class="caret"></span></a>
  		          		<ul class="dropdown-menu">
  		            	<li><a href="historique.php" style="color: black;">Historique</a></li>';
    		        if($_SESSION['droit']=="admin"){	//Si la personne connecter est admin il peut ajouter des questions
    		           echo '<li><a href="ajouter_question.php" style="color: black;">Ajouter Questions</a></li>';
                   echo '<li><a href="gerer_utilisateur.php" style="color: black;">Gerer utilisateurs</a></li>';
                   echo '<li><a href="gerer_questionnaire.php" style="color: black;">Gerer questionnaires</a></li>';
                }
  	          	echo '</ul></li>';
  	            echo '<li><a href="deconnexion.php" class="li_entête"><span class="glyphicon glyphicon-log-out"></span> Déconexion</a></li>';
  	          }
            ?>
          </ul>
        </div>
  		</div>
	</nav>

  <!--########################## Modal #################-->

      <div id="modalConnexion" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                  <h4 class="modal-title">Identification</h4>
                </div>
            <form class="form-horizontal" method="post">
              <!-- stocker valeur, si true aucune erreur si false erreur -->
              <input id="erreurConnexion" name="erreurConnexion" type="hidden" value="true">
              <div class="modal-body">
                <div class="form-group">
                  <label for="pseudo1" class="col-sm-3 control-label">Pseudo</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="pseudo1" id="pseudo1" value="Hitaway" placeholder="Entrez votre pseudo..." />
                  </div>
                </div>
                <div class="form-group">
                  <label for="mdp1" class="col-sm-3 control-label">Mot de passe</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="mdp1" id="mdp1" value="azerty" placeholder="Entrez votre mot de passe..." />
                    </div>
                </div>          
                  <?php
                    if(isset($erreur_connexion) && !(empty($erreur_connexion))){
                      echo '<div class="form-group">';
                      echo '<div class="col-sm-3"></div>';
                      echo '<div class="col-sm-9">';
                      echo '<div class="alert alert-danger">';
                        foreach ($erreur_connexion as $error)
                          echo $error;
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                    }
                  ?>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary btn_valider" id="btn_connexion">Connexion</button>
                    <button type="button" class="btn btn-danger btn_annuler">Fermer</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div id="modalInscrire" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
                <h4 class="modal-title">Inscription</h4>
              </div>
          <form class="form-horizontal" method="post">
            <div class="modal-body">
              <div class="form-group">
                <label for="nom" class="col-sm-3 control-label">Nom</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez votre nom..." />
                </div>
                </div>
              <div class="form-group">
                <label for="prenom" class="col-sm-3 control-label">Prenom</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez votre prenom..." />
                </div>
              </div>
              <div class="form-group">
                <label for="pseudo2" class="col-sm-3 control-label">Pseudo</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="pseudo2" id="pseudo2" placeholder="Entrez votre Pseudo..." />
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre adresse email..." />
                </div>
              </div>
              <div class="form-group">
                <label for="mdp2" class="col-sm-3 control-label">Mot de passe</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" name="mdp2" id="mdp2" placeholder="Entrez votre mot de passe..." />
                </div>
              </div>
              <div class="form-group">
                <label for="mdp3" class="col-sm-3 control-label">Confirmer mot de passe</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" name="mdp3" id="mdp3" placeholder="Veuillez confirmer votre mot de passe..." />
                </div>
              </div>
              <div class="form-group"> 
              <?php  
                if(isset($erreur_inscription) && !(empty($erreur_inscription))){
                  echo '<div class="col-sm-3"></div>';
                   echo '<div class="col-sm-9">';
                  echo '<div class="alert alert-danger ">';
                  echo '<p>Vous n\'avez pas rempli le formulaire correctement</p>';
                  echo '<ul>';
                    foreach ($erreur_inscription as $error)
                      echo '<li>'.$error.'</li>';
                  echo '</ul>';
                  echo '</div>';
                  echo '</div>';
                }
              ?>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                  <button type="submit" class="btn btn-primary btn_valider">S'inscrire</button>
                  <button type="button" class="btn btn-danger btn_annuler">Fermer</button>     
                </div>
              </div>
            </div>        
          </form>
        </div>
      </div>
    </div>
</header>