<?php
require("accueil.php");
  	session_start();
	session_destroy();		//détruire les variables de session
	header('Location: accueil.php');
?>
