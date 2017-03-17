<?php
include('include/open_connectionBase.inc'); 

$id = $_POST["id"];
$lg = $_POST["lg"];

if ($_POST["nom"]=="") {header('Location: langueutilisation.php?lg='.$lg);}
if (strlen($_POST["code"])<2) {header('Location: langueutilisation.php?lg='.$lg);}



if (strlen($_POST["code"])>1) {
	if (strlen($_POST["nom"])>2) {
		$requete ='INSERT INTO `lg` (`id`,`nom`,`code`,`online`) VALUES (NULL,'; // début de la composition de la requete de mise à jour
		$requete = $requete.'\''.addslashes($_POST["nom"]).'\',';
		$requete = $requete.'\''.$_POST["code"].'\',';
		$requete = $requete.'0)';

		mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


		$donnee=mysql_query('SELECT id FROM lg ORDER BY id DESC LIMIT 1');
		while ($donnee = mysql_fetch_assoc($donnee))
		{ $dernierid = $donnee['id']; }
	}


//****************************************** CATEGORIE *********************************************
$requete = 'ALTER TABLE `categorie` ADD `'.$_POST["code"].'` TINYTEXT NOT NULL';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

//****************************************** LIENCATEGORIE *********************************************
$requete = 'ALTER TABLE `liencategories` ADD `'.$_POST["code"].'` TINYTEXT NOT NULL';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** PAGE *********************************************
$requete = 'ALTER TABLE `page` ADD `'.$_POST["code"].'` TINYTEXT NOT NULL';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** RESSOURCES *********************************************
$requete = 'ALTER TABLE `ressources` ADD `nom_'.$_POST["code"].'` TINYTEXT NOT NULL';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = 'ALTER TABLE `ressources` ADD `description_'.$_POST["code"].'` TINYTEXT NOT NULL';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** GLOSSAIRE *********************************************
$requete = 'ALTER TABLE `glossaire` ADD `titre_'.$_POST["code"].'` TINYTEXT NOT NULL';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete = 'ALTER TABLE `glossaire` ADD `description_'.$_POST["code"].'` TINYTEXT NOT NULL';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


//****************************************** VERSIONS LINGUISTIQUE *********************************************
$requete = 'ALTER TABLE `versionlinguistique` ADD `'.$_POST["code"].'` TINYTEXT NOT NULL';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


}

include('include/close_connectionBase.inc'); 

header('Location: langueutilisation.php?lg='.$lg.'#'.$dernierid); // redirection

?>
