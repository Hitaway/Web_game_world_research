<?php
  	require("identifiants.php");
?>

<?php
  $message="PAR DEFAUT";  //stocker le message d'erreur qui sera ensuite transmit au JS

  if (isset($_POST['pseudo1']) && isset($_POST['mdp1'])){ //On verifie que les variable existe
      if (empty($_POST['pseudo1']) || empty($_POST['mdp1']) || !(trim($_POST['pseudo1'])) || !(trim($_POST['mdp1']))) //Oublie d'un champ
      {
        $message = "veillez saisir tout les champs.";
      }
      else 
      {
        $query=$bd->prepare('SELECT * FROM utilisateurs WHERE pseudo = :pseudo');
        $query->bindValue(':pseudo',$_POST['pseudo1'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
        //On check le mot de passe
        if ($data['mdp'] == $_POST['mdp1']) // MDP correct
        {
          $_SESSION['pseudo'] = $data['pseudo'];
          $_SESSION['droit'] = $data['droit'];
          $message = "vous êtes connectés.";
        }
        else //si MDP incorrect
        {
          $message = "Le mot de passe ou le pseudo entré n\'est pas correcte.";
        }
        $query->CloseCursor();
      }
  }
$message="TEST";
  $reponse = array("message" => $message, "pseudo" => $_SESSION['pseudo']);
  echo json_encode($reponse);





  $param = array('nom','prenom','email','pseudo2','mdp2','mdp3');
  //Si $_POST contient les clés nom, prenom, email... et qu'il y a des valeurs associées
  if(testValeurExist($param,$_POST))
  { 
      if(testPasVide($param,$_POST))
      {
        $verifSaisie=verifSaisieUtilisateur($bd, $_POST);
        echo '<br><h1 style="color: red;">'.$verifSaisie.'</h1>';
        if($verifSaisie == true){
          $sql = 'INSERT INTO UTILISATEURS (pseudo, prenom, nom, email, mdp, date_inscription, droit) VALUES (:pseudo, :prenom, :nom, :email, :mdp, :date_inscription, :droit)';
          try
          {
              $req = $bd->prepare($sql);
              $req->bindValue(':pseudo',htmlspecialchars($_POST['pseudo2']));
              $req->bindValue(':nom',htmlspecialchars($_POST['nom']));
              $req->bindValue(':prenom',htmlspecialchars($_POST['prenom']));
              $req->bindValue(':email',htmlspecialchars($_POST['email']));
              $req->bindValue(':mdp',htmlspecialchars($_POST['mdp2']));
              $req->bindValue(':date_inscription',date("Y-m-d"));
              $req->bindValue(':droit',"user");
              $req->execute();
          }
          catch(PDOException $e)
          {
            die('<p>Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
          }
        }
        else
        {
          $message=$verifSaisie;
        }
      }
      else
      {
        $message="Des valeurs sont vide";
      }
      echo '<br><br><br><br><br><h1 style="color: red;">'.$message.'</h1>';
  }
?>

<header>
	<nav class="navbar navbar-inverse" id="navbar">
  		<div class="container-fluid">
  			<!-- regroupe tout pour un meilleur affichage mobile -->
   			<div class="navbar-header">
      			<a class="navbar-brand navbar-left" href="accueil.php">
      			<img src="Image/logo.png" width="30" height="30" class="d-inline-block align-top navbar-left" id="img_logo" alt="logo_page">  Research</a>
		    </div>
        <ul class="nav navbar-nav">
          <li><a href="accueil.php">Accueil</a></li>
          <li><a href="classement.php">Classement</a></li>
          <li><a href="regle.php">Règle</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php 
	          if($_SESSION['pseudo']==""){    //s'il n'est pas connecté on affiche les boutton Inscrire ou Connexion
	            echo "<li><a data-toggle=\"modal\" data-target=\"#modalConnexion\"><span class=\"glyphicon glyphicon-log-in\"></span> Connexion</a></li>";
	            echo "<li><a data-toggle=\"modal\" data-target=\"#modalInscrire\"><span class=\"glyphicon glyphicon-user\" ></span> S'inscrire</a></li>";
	          }
	          if($_SESSION['pseudo']!=""){    //s'il est connecté on affiche
	            echo '<li class="dropdown">
	          			<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
	          			<span class="glyphicon glyphicon-user"></span> Nom de la personne <span class="caret"></span></a>
		          		<ul class="dropdown-menu">
		            	<li><a href="historique.php">Historique</a></li>';
		        if($_SESSION['droit']=="admin"){	//Si la personne connecter est admin il peut ajouter des questions
		           echo '<li><a href="ajouter_question.php">Ajouter Questions</a></li>';
               echo '<li><a href="gerer_utilisateur.php">Gerer utilisateurs</a></li>';
               echo '<li><a href="gerer_questionnaire.php">Gerer questionnaires</a></li>';
            }
	          	echo '</ul></li>';
	            echo "<li><a href=\"deconnexion.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Déconexion</a></li>";
	          }
          ?>
        </ul>
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
              <div class="modal-body">
                <div class="form-group">
                  <label for="pseudo1" class="col-sm-3 control-label">Pseudo</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="pseudo1" id="pseudo1" placeholder="Entrez votre pseudo..." />
                  </div>
                </div>
                <div class="form-group">
                  <label for="mdp1" class="col-sm-3 control-label">Mot de passe</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control form-control-warning" name="mdp1" id="mdp1" placeholder="Entrez votre mot de passe..." />
                      <span class="help-block" id="error-msg">
                          <p class="text-danger"></p> <!-- EN TRAVAUX -->
                      </span>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary btn_valider" id="btn_connexion">Connexion</button>
                    <button type="button" class="btn btn-danger btn_annuler">Annuler</button>
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
            </div>
            <div class="modal-footer">
              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                  <button type="submit" class="btn btn-primary btn_valider">S'inscrire</button>
                  <button type="button" class="btn btn-danger btn_annuler">Annuler</button>     
                </div>
              </div>
            </div>        
          </form>
        </div>
      </div>
    </div>
</header>