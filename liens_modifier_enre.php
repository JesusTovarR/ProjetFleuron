<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique, variable session)


$requete ='UPDATE liens SET '; // début de la composition de la requete de mise à jour

$requete = $requete.'nom="'.$_POST["nom"].'",';

$requete = $requete.'lien="'.$_POST["lien"].'",';

$requete = $requete.'liencategories="'.$_POST["liencategories"].'"';


$requete = $requete.' WHERE id='.$_POST["id"];


mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete : modification du profil

include('include/close_connectionBase.inc');

header('Location: liens.php?lg='.$_POST["langue"].'&action=ok'); // redirection
?>
