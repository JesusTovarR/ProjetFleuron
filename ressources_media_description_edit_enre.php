<?php
include('include/open_connectionBase.inc'); 

$id = $_POST["id"];

$requete ='UPDATE `ressources` SET '; // d�but de la composition de la requete de mise � jour

$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			// composition de la requete selon les langues existantes - table LG
			//$requete = $requete.'`nom_'.$donneeslg['code'].'`="'.addslashes($_POST['nom_'.$donneeslg['code']]).'",';
			$requete = $requete.'`description_'.$donneeslg['code'].'`="'.addslashes($_POST['description_'.$donneeslg['code']]).'",';
		}

$requete = substr($requete,0,strlen($requete)-1).' WHERE id='.$id; // recomposition de la requete - derni�re virgule retir�e et fin de la requete ajout�

mysql_query($requete) or die('<br>Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete



include('include/close_connectionBase.inc'); 


header('Location: ressources_media_description_edit_enre_ok.php?lg='.$_POST["lg"].'&idressource='.$_POST["id"].'&idprofil='.$_POST["idprofil"]); // redirection

?>
