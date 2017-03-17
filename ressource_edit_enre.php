<?php
include('include/open_connectionBase.inc'); 

$id = $_POST["id"];
$lg = $_POST["lg"];
$page = $_POST["page"];
$idprofil = $_POST["idprofil"];

$requete ='UPDATE `ressources` SET '; // début de la composition de la requete de mise à jour

$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			$requete = $requete.'`nom_'.$donneeslg['code'].'`="'.addslashes($_POST['nom_'.$donneeslg['code']]).'",';
			$requete = $requete.'`description_'.$donneeslg['code'].'`="'.addslashes($_POST['description_'.$donneeslg['code']]).'",';
		}

$requete = substr($requete,0,strlen($requete)-1).',`categorie`='.$_POST["categorie"].' WHERE id='.$id; // recomposition de la requete - dernière virgule retirée et fin de la requete ajouté


mysql_query($requete) or die('<br>Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 


header('Location: '.$page.'?lg='.$lg.'&idprofil='.$idprofil.'&action=ok&categorie='.$_POST["categorie"]); // redirection

?>
