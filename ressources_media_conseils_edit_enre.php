<?php
include('include/open_connectionBase.inc'); 




$requete ='UPDATE `conseils_page` SET ';
$requete =$requete.'`page`="'.addslashes($_POST["page"]).'",';
$requete =$requete.'`ressource`="'.addslashes($_POST["idressource"]); 
$requete =$requete.'" WHERE id='.$_POST["id"]; 


//echo $requete;


mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: ressources_media_conseils_edit_enre_ok.php?lg='.$_POST["lg"].'&idressource='.$_POST["idressource"].'&idprofil='.$_POST["idprofil"]); // redirection

?>
