<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL

include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



// ***************************************************************
// Suppression du commentaire idcommentaire dans la table COMMENTAIRES
// ***************************************************************

$requete = "DELETE FROM `commentaires` WHERE `id`=".$_GET["idcommentaire"];


mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete



include('include/close_connectionBase.inc');

// redirection
echo '<script>';
echo 'top.window.location="commentaires_tous_list.php?lg='.$lg.'"';
echo '</script>';
?>
