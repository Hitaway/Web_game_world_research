<?php
	try
	{
		$bd = new PDO('mysql:host=localhost;dbname=debug_l3_web;charset=utf8', 'root', 'root');
		$bd->query('SET NAMES utf8');
		$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
	    die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
	}
?>
