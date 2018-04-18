<?php
session_start();
include("includes/identifiants.php");
include("includes/accueil.php");
include("includes/menu.php");
echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> --> Connexion';


$bd->query('SET NAMES utf8');
$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$req = $bd->prepare('SELECT * FROM utilisateurs');
$req->execute();
$res = $req->fetch(PDO::FETCH_ASSOC);

var_dump($res);


//On reprend la suite du code
echo '<h1>Connexion</h1>';
if ($id!=0) erreur(ERR_IS_CO);


?>
