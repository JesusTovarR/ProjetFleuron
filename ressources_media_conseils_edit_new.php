<?php
include('include/open_connectionBase.inc'); 




$requete ='INSERT INTO `conseils_page` (`id`,';
$requete =$requete.'`jour`,';
$requete =$requete.'`ressource`,';
$requete =$requete.'`page`';
$requete =$requete.') VALUES (NULL,'; 

$today = date("Y-m-d");
$requete =$requete.'\''.$today.'\',';
$requete =$requete.'\''.$_POST["idressource"].'\',';
$requete =$requete.'\''.addslashes($_POST["page"]).'\')';



//echo $requete.'<b><br>';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: ressources_media_conseils_edit_enre_ok.php?lg='.$_POST["lg"].'&idressource='.$_POST["idressource"].'&idprofil='.$_POST["idprofil"]); // redirection

?>
