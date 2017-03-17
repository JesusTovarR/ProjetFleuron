<?php
include('include/open_connectionBase.inc'); 



$requete = "DELETE FROM `lg` WHERE `id` =".$_POST["id"]; // suppression de la langue dans la table LG
mysql_query($requete) or die('<br>Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** CATEGORIE *********************************************
$requete = 'ALTER TABLE `categorie` DROP `'.$_POST["code"].'`';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

//****************************************** LIENCATEGORIE *********************************************
$requete = 'ALTER TABLE `liencategories` DROP `'.$_POST["code"].'`';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

//****************************************** PAGE *********************************************
$requete = 'ALTER TABLE `page` DROP `'.$_POST["code"].'`';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

//****************************************** RESSOURCES *********************************************
$requete = 'ALTER TABLE `ressources` DROP `nom_'.$_POST["code"].'`';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = 'ALTER TABLE `ressources` DROP `description_'.$_POST["code"].'`';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

//****************************************** GLOSSAIRE *********************************************
$requete = 'ALTER TABLE `glossaire` DROP `titre_'.$_POST["code"].'`';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = 'ALTER TABLE `glossaire` DROP `description_'.$_POST["code"].'`';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//************************************ VERSIONS LINGUISTIQUE **************************************
$requete = 'ALTER TABLE `versionlinguistique` DROP `'.$_POST["code"].'`';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: langueutilisation.php?lg='.$_POST["lg"].'#'.$id); // redirection

?>
