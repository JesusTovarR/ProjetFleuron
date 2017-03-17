<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

//$total=$_POST["total"];
$idressource=$_POST["idressource"];


$file ='ressources/'.$idressource.'.srt';

$sauvegardeBD = "";

$fileopen=(fopen("$file",'w'));

				fwrite($fileopen,utf8_encode($_POST["texte"])."\r\n");
				fwrite($fileopen,"\r\n");

				$sauvegardeBD = $sauvegardeBD.$_POST["texte"]."\r\n";
				$sauvegardeBD = $sauvegardeBD."\r\n";


fclose($fileopen);



// Enregistrement de la transcription dans la base de données
	$requete ='UPDATE `ressources` SET ';

	$requete = $requete.'`Transcription`="'.addslashes($sauvegardeBD).'"';

	$requete =$requete.' WHERE id='.$idressource;



	mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

	include('include/close_connectionBase.inc');


	$lien='ressources_transcription_editer_modifier.php?lg='.$lg.'&idressource='.$_POST["idressource"].'&refpage='.$_POST["refpage"];
	echo '<script>';
		echo 'top.window.location="'.$lien.'"';
	echo '</script>';

?>
