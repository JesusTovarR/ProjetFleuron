<?php
include('include/open_connectionBase.inc'); 

$id = $_GET["id"];
$lg = $_GET["lg"];



$requete = "DELETE FROM `couleur_memo` WHERE `id` =".$id;
mysql_query($requete) or die('<br>Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete




include('include/close_connectionBase.inc'); 

header('Location: couleurs.php?lg='.$lg.'&action2=ok'); // redirection

?>
