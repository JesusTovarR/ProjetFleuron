<?php
include('include/open_connectionBase.inc'); 

$idressource = $_POST["idressource"];
$lien = $_POST["lien"];
$liens = $_POST["liens"];
$id = $_POST["id"];
$lg = $_POST["lg"];

$compillien = $liens.$lien;


$requete ='UPDATE ressources SET '; // d�but de la composition de la requete de mise � jour

$requete = $requete.'lien="'.$compillien.';"';

$requete = $requete.' WHERE id='.$idressource; // recomposition de la requete - derni�re virgule retir�e et fin de la requete ajout�

echo $requete;
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 

header('Location: ressources_liens.php?lg='.$_POST["lg"].'&idressource='.$_POST["idressource"].'&idprofil='.$_POST["idprofil"]); // redirection


?>
