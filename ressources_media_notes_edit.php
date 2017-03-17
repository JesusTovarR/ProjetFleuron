<?php
include('include/open_connectionBase.inc'); 




$requete ='UPDATE `notes` SET ';
$requete =$requete.'`notes`="'.addslashes($_POST["notes"]).'",';
$requete =$requete.'`regarder`="'.addslashes($_POST["regarder"]).'",'; 
$requete =$requete.'`comprendre`="'.addslashes($_POST["comprendre"]).'",'; 
$requete =$requete.'`aimer`="'.addslashes($_POST["aimer"]).'",'; 
$requete =$requete.'`suivre`="'.addslashes($_POST["suivre"]).'" WHERE id='.$_POST["id"]; 


echo $requete;


mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: ressources_media_notes_enre_ok.php?lg='.$_POST["lg"].'&idressource='.$_POST["idressource"].'&idprofil='.$_POST["idprofil"]); // redirection

?>
