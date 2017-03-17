<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$ressource=$_GET["ressource"];
$id=$_GET["id"];


$requete = "DELETE FROM `favoris` WHERE `profil`=".$id.' AND `ressource`='.$ressource; // Retirer la ressource de l'ID de la table FAVORIS
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

include('include/close_connectionBase.inc');  // fermeture de la connexion MySQL

header('Location: favoris.php?id='.$id.'&ressource='.$ressource); // redirection
?>
