<?php
include('include/open_connectionBase.inc'); 



$requete ='UPDATE couleur SET couleur="#371111" WHERE id=1'; // couleur foncée id = 1

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


$requete ='UPDATE couleur SET couleur="#621d1d" WHERE id=2'; // couleur foncée id = 1

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete




include('include/close_connectionBase.inc'); 

header('Location: couleurs.php?lg='.$lg.'&action=ok'); // redirection

?>
