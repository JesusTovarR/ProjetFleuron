<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$id = $_GET["id"];


$requete = "DELETE FROM `liens` WHERE `id` =".$id;
echo $requete;

mysql_query($requete) or die('<br>Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

include('include/close_connectionBase.inc'); 


header('Location: liens.php?lg='.$lg.'&action2=ok'); // redirection
?>
