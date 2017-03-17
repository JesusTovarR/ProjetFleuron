<?php


include('include/open_connectionBase.inc'); // connexion à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$id = $_GET["id"];
$categorie = $_GET["categorie"];
$idprofil=$_GET["idprofil"];
$page=$_GET["pageencours"];

$requete = "DELETE FROM `ressources` WHERE `id` =".$id; // suppression de la ressource dans la table RESSOURCES
mysql_query($requete) or die('<br>Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


$requete = "DELETE FROM `favoris` WHERE `ressource`=".$id; // requete de suppression de la ressource dans la table FAVORIS
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = "DELETE FROM `notes` WHERE `ressource`=".$id; // requete de suppression de la ressource dans la table FAVORIS
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = "DELETE FROM `commentaires` WHERE `ressource`=".$id; // requete de suppression de la ressource dans la table FAVORIS
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

include('include/close_connectionBase.inc'); // Déconnexion à la base MYSQL

$redirection='Location: '.$page.'?lg='.$lg.'&action2=ok&categorie='.$categorie.'&idprofil='.$idprofil;
header($redirection); // redirection
?>
