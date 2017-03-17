<?php
include('include/open_connectionBase.inc'); 



$lg = $_POST["lg"];

$donnee=mysql_query('SELECT refVL FROM liencategories ORDER BY id DESC LIMIT 1');
while ($donnee = mysql_fetch_assoc($donnee))
{ $dernierrefVL = $donnee['refVL']; }

$dernierrefVL = $dernierrefVL + 10;

$requete ='INSERT INTO `liencategories` (`id`,`refVL`,'; // début de la composition de la requete de mise à jour
//**************************
// Récup des codes langues de la table LG
//************************
$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'`'.$donneeslg['code'].'`,';
		}


$requete = substr($requete,0,strlen($requete)-1).') VALUES (NULL,'.$dernierrefVL.','; // recomposition de la requete - dernière virgule retirée et fin de la requete ajouté


//**************************
// Récup des champs formulaires d'après les codes langues de la table LG
//************************

$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'\''.addslashes($_POST[$donneeslg['code']]).'\',';
		}

$requete = substr($requete,0,strlen($requete)-1).')'; // recomposition de la requete - dernière virgule retirée et fin de la requete ajouté


mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 

header('Location: liens.php?lg='.$_POST["langue"]); // redirection

?>
