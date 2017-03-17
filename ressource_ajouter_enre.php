<?php
include('include/open_connectionBase.inc'); 


$lg = $_POST["lg"];

$requete ='INSERT INTO `ressources` (`id`,'; // début de la composition de la requete de mise à jour
//**************************
// Récup des codes langues de la table LG
//************************
$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'`nom_'.$donneeslg['code'].'`,';
			$requete = $requete.'`description_'.$donneeslg['code'].'`,';
		}

$requete = substr($requete,0,strlen($requete)-1).',categorie,offline) VALUES (NULL,'; // recomposition de la requete - dernière virgule retirée et fin de la requete ajouté


//**************************
// Récup des champs formulaires d'après les codes langues de la table LG
//************************

$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'\''.addslashes($_POST['nom_'.$donneeslg['code']]).'\',';
			$requete = $requete.'\''.addslashes($_POST['description_'.$donneeslg['code']]).'\',';
		}

$requete = substr($requete,0,strlen($requete)-1).','.$_POST["categorie"].',1)'; // recomposition de la requete - dernière virgule retirée et fin de la requete ajouté

//echo $requete;
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: ressources_list.php?lg='.$lg.'&action=ok&categorie='.$_POST["categorie"]); // redirection

?>
