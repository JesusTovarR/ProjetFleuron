<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL

include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


// ***************************************************************
// Suppression de la référence à source de la vignette (SOURCEVIGNETTE) dans la table RESSOURCES
// ***************************************************************
$requete ='UPDATE `ressources` SET ';
$requete =$requete.'`Transcription`="" WHERE id='.$_GET["idressource"]; 

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

$requete ='UPDATE `ressources` SET ';
$requete =$requete.'`sourcetranscription`="" WHERE id='.$_GET["idressource"]; 

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

// ***************************************************************
// Suppression du fichier $idressource.$extension du répertoire "ressources"
// ***************************************************************
$filename = 'ressources/'.$_GET["idressource"].'.srt';
unlink($filename);

include('include/close_connectionBase.inc');

// redirection
echo '<script>';
echo 'top.window.location="ressources_media.php?lg='.$lg.'&retour='.$_GET["retour"].'&idressource='.$_GET["idressource"].'&idprofil='.$idprofil.'"';
echo '</script>';
?>
