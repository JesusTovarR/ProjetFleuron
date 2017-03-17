<?php
include('include/open_connectionBase.inc'); 

$id = $_GET["id"];
$lg = $_GET["lg"];
$flag = $_GET["flag"];
$categorie = $_GET["categorie"];
$page = $_GET["pageencours"];
$idprofil = $_GET["idprofil"];


$requete ='UPDATE `lg` SET `online`='.$flag.' WHERE id='.$id; // requete de mise à jour
echo $requete.'<br>';
mysql_query($requete) or die('<br>Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc');  // Fin de connexion à la base MySQL

$route='Location: langueutilisation.php?lg='.$lg.'&action=ok&idprofil='.$idprofil.'#'.$id;

header($route); // redirection


?>
