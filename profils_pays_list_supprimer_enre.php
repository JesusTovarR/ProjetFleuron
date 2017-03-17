<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$id = $_GET["id"];
$niveau = $_GET["niveau"];
$pays = $_GET["pays"];

$requete = "DELETE FROM `profil` WHERE `id` =".$id; // requete supression profil
mysql_query($requete) or die('<br>Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = "DELETE FROM `favoris` WHERE `profil`=".$id; // requete de suppression des notes du profil
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = "DELETE FROM `notes` WHERE `profil`=".$id; // requete de suppression des notes du profil
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = "DELETE FROM `commentaires` WHERE `profil`=".$id; // requete de suppression des notes du profil
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

include('include/close_connectionBase.inc'); 


header('Location: profils_pays_list.php?lg='.$lg.'&action3=ok&niveau='.$niveau.'&pays='.$pays); // redirection
?>
