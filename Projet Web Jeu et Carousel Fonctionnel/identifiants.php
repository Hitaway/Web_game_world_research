
<?php
	try
	{
		$bd = new PDO('mysql:host=localhost;dbname=bdd_projet_l3;charset=utf8', 'root', '');
		$bd->query('SET NAMES utf8');
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
	    die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
	}
?>