<?php
include('include/open_connectionBase.inc'); 

$id = $_POST["id"];
$lg = $_POST["lg"];
$page = $_POST["page"];

$requete ='UPDATE `page` SET '; // d�but de la composition de la requete de mise � jour

$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'`'.$donneeslg['code'].'`="'.addslashes($_POST[$donneeslg['code']]).'",';
		}

$requete = substr($requete,0,strlen($requete)-1).' WHERE id='.$id; // recomposition de la requete - derni�re virgule retir�e et fin de la requete ajout�


mysql_query($requete) or die('<br>Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: '.$page.'?lg='.$lg.'&action=ok'); // redirection
?>