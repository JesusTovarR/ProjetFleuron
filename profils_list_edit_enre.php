<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique, variable session)


$requete ='UPDATE profil SET '; // début de la composition de la requete de mise à jour

$requete = $requete.'niveau="'.$_POST["niveau"].'"';

$requete = $requete.' WHERE id='.$_POST["id"];


mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete : modification du profil

include('include/close_connectionBase.inc');

header('Location: profils_pays_list.php?lg='.$_POST["lg"].'&action=ok&niveau='.$_POST["niveau"].'&pays='.$_POST["pays"].'&profil='.$_POST["id"].'#'.$_POST["id"]); // redirection
?>
