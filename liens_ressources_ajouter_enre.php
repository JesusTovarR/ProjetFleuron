<?php
include('include/open_connectionBase.inc'); 




$requete ='INSERT INTO `liens` (`id`,`nom`,`lien`,`aff`,`liencategories`) VALUES (NULL,'; // d�but de la composition de la requete de mise � jour
$requete = $requete.'\''.addslashes($_POST["nom"]).'\',';
$requete = $requete.'\''.$_POST["lien"].'\',';
$requete = $requete.'1,';
$requete = $requete.'\''.$_POST["liencategories"].'\')';



echo $requete;



mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 

header('Location: liens.php?lg='.$_POST["langue"]); // redirection

?>
