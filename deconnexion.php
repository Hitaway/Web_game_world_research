<?php
session_start();
session_destroy();		//détruire les variables de session
$titre="Déconnexion";
include("includes/debut.php");
include("includes/menu.php");

if ($id==0) erreur(ERR_IS_NOT_CO);	//vérifie que le visiteur est bien connecté

echo '<p>Vous êtes à présent déconnecté <br />
Cliquez <a href="'.htmlspecialchars($_SERVER['HTTP_REFERER']).'">ici</a> 
pour revenir à la page précédente.<br />
Cliquez <a href="./index.php">ici</a> pour revenir à la page principale</p>';
echo '</div></body></html>';
?>
