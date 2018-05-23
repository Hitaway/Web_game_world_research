<?php

require ("identifiants.php");

//$nom_questionnaire=$_POST['nom_questionnaire'];
$nom_questionnaire="7 sommets les plus haut du monde";
$requete=$bd->prepare("SELECT nom_questionnaire FROM questionnaires WHERE nom_questionnaire = :nom_questionnaire");
$requete->bindValue(':nom_questionnaire',$nom_questionnaire);
$requete->execute();
$res=$requete->fetch(PDO::FETCH_ASSOC);

do{

	$tableau[]=$res;

  }while($res = $requete->fetch(PDO::FETCH_ASSOC));
 
echo(json_encode($tableau));

?>