<?php
include('include/open_connectionBase.inc'); 

$couleur1 = $_GET["couleur1"];
$couleur2 = $_GET["couleur2"];
$lg = $_GET["lg"];



$requete ='UPDATE couleur SET couleur="#'.$couleur1.'" WHERE id=1'; // couleur foncée id = 1

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


$requete ='UPDATE couleur SET couleur="#'.$couleur2.'" WHERE id=2'; // couleur foncée id = 1

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete



include('include/close_connectionBase.inc'); 

header('Location: couleurs.php?lg='.$lg.'&action2=ok'); // redirection

?>
