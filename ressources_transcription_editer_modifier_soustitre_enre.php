<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$total=$_POST["total"];
$idressource=$_POST["idressource"];


$file ='ressources/'.$idressource.'fr.srt';

$sauvegardeBD = "";

$fileopen=(fopen("$file",'w'));
for ($i = 1; $i <= $total; $i++) {
	if ($_POST["in".$i]<>"") {
		if ($_POST["in".$i]<>"00:00:00,000") {
			if ($_POST["texte".$i]<>"") {
				fwrite($fileopen,utf8_encode($i)."\r\n");
				fwrite($fileopen,utf8_encode($_POST["in".$i])." --> ".utf8_encode($_POST["out".$i])."\r\n");
				fwrite($fileopen,utf8_encode($_POST["texte".$i])."\r\n");
				fwrite($fileopen,"\r\n");

				$sauvegardeBD = $sauvegardeBD.$i."\r\n";
				$sauvegardeBD = $sauvegardeBD.$_POST["in".$i]." --> ".$_POST["out".$i]."\r\n";
				$sauvegardeBD = $sauvegardeBD.$_POST["texte".$i]."\r\n";
				$sauvegardeBD = $sauvegardeBD."\r\n";
$lasttimecode=$_POST["in".$i];
			}
		}
	}

}

fclose($fileopen);

$timecode=str_replace(",",".",$lasttimecode);

// Enregistrement de la transcription dans la base de donn�es
	$requete ='UPDATE `ressources` SET ';

	$requete = $requete.'`Transcription`="'.addslashes($sauvegardeBD).'"';

	$requete =$requete.' WHERE id='.$idressource;



	mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

	include('include/close_connectionBase.inc');


	$lien='ressources_transcription_editer_modifier.php?lg='.$lg.'&idressource='.$_POST["idressource"].'&refpage='.$_POST["refpage"].'&derpos='.$i.'&timecode='.$timecode;
	echo '<script>';
		echo 'top.window.location="'.$lien.'"';
	echo '</script>';

?>
