<?php 
	session_start();
	require("debut.php");
	require("identifiants.php"); 	
	require("functions.php");
?>
	<body>
		<?php require("header.php"); ?>
		<?php require("footer.php"); ?>


		<form method="post" action="regle.php" enctype="multipart/form-data">
		<input type="hidden" name="MAX_FILE_SIZE" value="16777216" /> <!-- taille max total de tout les fichiers à upload 16Mo -->
		<label for="photo1">Photo au format (JPG, PNG ou GIF | max. 2 Mo) :</label>
        <input type="file" name="photo1" id="photo1"/>
        <label for="photo2">Photo au format (JPG, PNG ou GIF | max. 2 Mo) :</label>
        <input type="file" name="photo2" id="photo2"/>
        <input type="submit" name="submit" value="Envoyer"/>
		</form>

<?php

/*echo 'Name:'.$_FILES['photo1']['name'].'<br>';     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
echo ' Type:'.$_FILES['photo1']['type'].'<br>';     //Le type du fichier. Par exemple, cela peut être « image/png ».
echo ' Size:'.$_FILES['photo1']['size'].'<br>';     //La taille du fichier en octets.
echo ' Tmp_name:'.$_FILES['photo1']['tmp_name'].'<br>'; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
echo ' Error:'.$_FILES['photo1']['error'].'<br>';    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.


if ($_FILES['icone']['error'] > 0) $erreur = "Erreur lors du transfert";

//16777216 c'est la taille max que l'on a donné aux fichiers
$maxsize = 16777216;
if ($_FILES['icone']['size'] > $maxsize) $erreur = "Le fichier est trop gros";


$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.
$extension_upload = strtolower(  substr(  strrchr($_FILES['icone']['name'], '.')  ,1)  );
if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte";

$image_sizes = getimagesize($_FILES['icone']['tmp_name']);
$maxwidth = 1000;
$maxheight = 1000;
if ($image_sizes[0] > $maxwidth OR $image_sizes[1] > $maxheight) $erreur = "Image trop grande";



$nom_questionnaire = "7 merveilles du monde";
//Créer un dossier
//0777 c'est les droit CHMOD
  mkdir('Image/'.$nom_questionnaire.'/', 0777, true);

//Créer un identifiant difficile à deviner
  $nom_image = "img_q1";

$resultat = move_uploaded_file($_FILES['photo1']['tmp_name'],'Image/'.$nom_questionnaire.'/'.$nom_image);

if ($resultat) echo "Transfert réussi";
else echo "Transfert échoué";

	echo '<img src="Image/'.$nom_questionnaire.'/img_q1">';*/


/*function upload($index,$destination,$maxsize,$extensions)
{
	$error = array();
   //Test1: fichier correctement uploadé
    if (!isset($_FILES[$index]) OR ($_FILES[$index]['error'] > 0)) 
     	$error['upload'] = "erreur opload";

   //Test2: taille limite
    if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) 
    	$error['taille'] = "taille de fichier supérieur à la taille indiqué";

   //Test3: extension
    $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);
    if ($extensions !== FALSE AND !in_array($ext,$extensions)) 
     	$error['extension'] = "extension du fichier non pris en charge";

    return $error;

}

echo 'Name:'.$_FILES['photo1']['name'].'<br>';     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
echo ' Type:'.$_FILES['photo1']['type'].'<br>';     //Le type du fichier. Par exemple, cela peut être « image/png ».
echo ' Size:'.$_FILES['photo1']['size'].'<br>';     //La taille du fichier en octets.
echo ' Tmp_name:'.$_FILES['photo1']['tmp_name'].'<br>'; //L'adresse vers le fichier uploadé dans le répertoire temporaire.
echo ' Error:'.$_FILES['photo1']['error'].'<br>';    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.

 $nom_questionnaire = "7 merveilles du monde";

//EXEMPLES

  $upload1 = upload('photo1','Image/'.$nom_questionnaire.'/img_q1',2097152, array( 'jpg' , 'jpeg' , 'gif' , 'png' ));

  /*$upload2 = upload('photo2','Image/'.$nom_questionnaire.'/img_q2',2097152, array( 'jpg' , 'jpeg' , 'gif' , 'png' ));*/

 

  /*if ($error != "Ok") "Upload du fichier réussi!<br />";
  else {echo 'TESTTTT:'.$upload1;
mkdir('Image/'.$nom_questionnaire.'/', 0777, true);
  	move_uploaded_file($_FILES['photo1']['tmp_name'],'Image/'.$nom_questionnaire.'/img_q1');
  }*/

  /*if ($upload2 == "Ok") "Upload du fichier réussi!<br />";
  else echo "erreur";*/

  $nom_questionnaire="azerzarzarzar";

  echo '<img src="Image/'.$nom_questionnaire.'/img_q1">';

  echo '<img src="Image/'.$nom_questionnaire.'/img_q2">';

?>
	</body>
</html>