<?php
include('include/open_connectionBase.inc'); 

$couleur1 = $_POST["couleur1"];
$couleur2 = $_POST["couleur2"];



$requete ='UPDATE couleur SET couleur="'.$couleur1.'" WHERE id=1'; // couleur foncée id = 1

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


$requete ='UPDATE couleur SET couleur="'.$couleur2.'" WHERE id=2'; // couleur foncée id = 1

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete



$requete ='INSERT INTO `couleur_memo` (`id`,`jour`,`couleur1`,`couleur2`) VALUES (NULL,'; // mémorisation des couleurs
$today = date("y-m-d");
$requete = $requete.'\''.$today.'\',';
$requete = $requete.'\''.$couleur1.'\',';
$requete = $requete.'\''.$couleur2.'\')';
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

include('include/close_connectionBase.inc'); 

header('Location: couleurs.php?lg='.$lg.'&action2=ok'); // redirection

?>
