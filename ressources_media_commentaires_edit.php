<?php
include('include/open_connectionBase.inc'); 


if ($_POST["commentaire"]<>'') {

$requete ='UPDATE `commentaires` SET ';
$requete =$requete.'`commentaire`="'.addslashes($_POST["commentaire"]).'" WHERE id='.$_POST["id"]; 
//echo $requete;

} else {

$requete = "DELETE FROM `commentaires` WHERE `id`=".$_POST["id"]; // Retirer le commentaire de la table COMMENTAIRES
}

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

include('include/close_connectionBase.inc'); 


header('Location: ressources_media_commentaires_enre_ok.php?lg='.$_POST["lg"].'&idressource='.$_POST["idressource"].'&idprofil='.$_POST["idprofil"]); // redirection

?>
