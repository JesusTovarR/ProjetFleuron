<?php
include('include/open_connectionBase.inc'); 




$requete ='INSERT INTO `commentaires` (`id`,';
$requete =$requete.'`jour`,';
$requete =$requete.'`ressource`,';
$requete =$requete.'`profil`,';
$requete =$requete.'`reponse`,';
$requete =$requete.'`commentaire`';
$requete =$requete.') VALUES (NULL,'; 

$today = date("y-m-d");
$requete =$requete.'\''.$today.'\',';
$requete =$requete.'\''.$_POST["idressource"].'\',';
$requete =$requete.'\''.$_POST["idprofil"].'\',';
$requete =$requete.'\''.$_POST["idcommentaire"].'\',';
$requete =$requete.'\''.addslashes($_POST["commentaire"]).'\')';


//echo $requete;
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: ressources_media.php?lg='.$_POST["lg"].'&idressource='.$_POST["idressource"].'&idprofil='.$_POST["idprofil"]); // redirection

?>
