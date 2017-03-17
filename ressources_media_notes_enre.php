<?php
include('include/open_connectionBase.inc'); 




$requete ='INSERT INTO `notes` (`id`,';
$requete =$requete.'`jour`,';
$requete =$requete.'`ressource`,';
$requete =$requete.'`profil`,';
$requete =$requete.'`notes`,';
$requete =$requete.'`regarder`,'; 
$requete =$requete.'`comprendre`,'; 
$requete =$requete.'`aimer`,'; 
$requete =$requete.'`suivre`'; 
$requete =$requete.') VALUES (NULL,'; 

$today = date("Y-m-d");
$requete =$requete.'\''.$today.'\',';
$requete =$requete.'\''.$_POST["idressource"].'\',';
$requete =$requete.'\''.$_POST["idprofil"].'\',';
$requete =$requete.'\''.addslashes($_POST["notes"]).'\',';
$requete =$requete.'\''.addslashes($_POST["regarder"]).'\',';
$requete =$requete.'\''.addslashes($_POST["comprendre"]).'\',';
$requete =$requete.'\''.addslashes($_POST["aimer"]).'\',';
$requete =$requete.'\''.addslashes($_POST["suivre"]).'\')';



//echo $requete;
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: ressources_media_notes_enre_ok.php?lg='.$_POST["lg"].'&idressource='.$_POST["idressource"].'&idprofil='.$_POST["idprofil"]); // redirection

?>
