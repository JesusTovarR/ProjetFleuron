<?php
include('include/open_connectionBase.inc'); 



$requete ='UPDATE `lg` SET ';
$requete =$requete.'`nom`="'.addslashes($_POST["nom"]).'",';
$requete =$requete.'`code`="'.$_POST["code"].'"'; 
$requete =$requete.' WHERE id='.$_POST["id"]; 



//echo $requete;
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** CATEGORIE *********************************************
$requete = 'ALTER TABLE `categorie` CHANGE `'.$_POST["oldcode"].'` `'.$_POST["code"].'` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** LIENCATEGORIE *********************************************
$requete = 'ALTER TABLE `liencategories` CHANGE `'.$_POST["oldcode"].'` `'.$_POST["code"].'` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** PAGE *********************************************
$requete = 'ALTER TABLE `page` CHANGE `'.$_POST["oldcode"].'` `'.$_POST["code"].'` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** RESSOURCES *********************************************
$requete = 'ALTER TABLE `ressources` CHANGE `nom_'.$_POST["oldcode"].'` `nom_'.$_POST["code"].'` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = 'ALTER TABLE `ressources` CHANGE `description_'.$_POST["oldcode"].'` `description_'.$_POST["code"].'` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** glossaire *********************************************
$requete = 'ALTER TABLE `glossaire` CHANGE `titre_'.$_POST["oldcode"].'` `titre_'.$_POST["code"].'` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = 'ALTER TABLE `glossaire` CHANGE `description_'.$_POST["oldcode"].'` `description_'.$_POST["code"].'` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** VERSIONS LINGUISTIQUE *********************************
$requete = 'ALTER TABLE `versionlinguistique` CHANGE `'.$_POST["oldcode"].'` `'.$_POST["code"].'` TINYTEXT CHARACTER SET utf8 COLLATE utf8_general_ci';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: langueutilisation.php?lg='.$_POST["lg"].'#'.$id); // redirection

?>
