<?php
include('include/open_connectionBase.inc'); 

$id = $_POST["id"];
$lg = $_POST["lg"];

$requete ='INSERT INTO `versionlinguistique` (`id`,'; // d�but de la composition de la requete de mise � jour
//**************************
// R�cup des codes langues de la table LG
//************************
$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'`'.addslashes($donneeslg['code']).'`,';
		}




$requete = substr($requete,0,strlen($requete)-1).') VALUES (NULL,'; // recomposition de la requete - derni�re virgule retir�e et fin de la requete ajout�


//**************************
// R�cup des champs formulaires d'apr�s les codes langues de la table LG
//************************

$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'\''.addslashes($_POST[$donneeslg['code']]).'\',';
		}

$requete = substr($requete,0,strlen($requete)-1).')'; // recomposition de la requete - derni�re virgule retir�e et fin de la requete ajout�


mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


$donnee=mysql_query('SELECT id FROM versionlinguistique ORDER BY id DESC LIMIT 1');
while ($donnee = mysql_fetch_assoc($donnee))
{ $dernierid = $donnee['id']; }



include('include/close_connectionBase.inc'); 

header('Location: versionlinguistique.php?lg='.$lg.'&action2=ok&id='.$dernierid.'#'.$dernierid); // redirection

?>
