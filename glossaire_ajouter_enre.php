<?php
include('include/open_connectionBase.inc'); 

$id = $_POST["id"];
$lg = $_POST["lg"];

$requete ='INSERT INTO `glossaire` (`id`,`item`,'; // début de la composition de la requete de mise à jour
//**************************
// Récup des codes langues de la table LG
//************************
$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'`'.addslashes("description_".$donneeslg['code']).'`,';
		}




$requete = substr($requete,0,strlen($requete)-1).') VALUES (NULL,'; // recomposition de la requete - dernière virgule retirée et fin de la requete ajouté

$requete = $requete.'\''.addslashes($_POST[item]).'\',';
//**************************
// Récup des champs formulaires d'après les codes langues de la table LG
//************************

$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'\''.addslashes($_POST["description_".$donneeslg['code']]).'\',';
		}

$requete = substr($requete,0,strlen($requete)-1).')'; // recomposition de la requete - dernière virgule retirée et fin de la requete ajouté


echo $requete;
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


$donnee=mysql_query('SELECT id FROM glossaire ORDER BY id DESC LIMIT 1');
while ($donnee = mysql_fetch_assoc($donnee))
{ $dernierid = $donnee['id']; }



include('include/close_connectionBase.inc'); 

header('Location: glossaire.php?lg='.$lg.'&action2=ok&id='.$dernierid.'#'.$dernierid); // redirection

?>
