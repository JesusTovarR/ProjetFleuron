<?php


include('include/open_connectionBase.inc'); // connection ? la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$total=$_POST["total"];
$idressource=$_POST["id_res"];
$lg=$_POST["code_lg"];
$table=$_POST["table"];


$file ='ressources/'.$idressource.$lg.$_SESSION["id"].'.srt';

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

// Enregistrement de la transcription dans la base de donn?es
$requete ='UPDATE `soustitres` SET ';

$requete = $requete.'`text`="'.addslashes($sauvegardeBD).'"';

$requete =$requete.' WHERE id_resource='. $_POST['id_res'].' AND code="'.$_POST['code_lg'].'" AND id_user='.$_SESSION['id'];



mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

include('include/close_connectionBase.inc');

unlink($file);

$lien='traducteur.php';
echo '<script>';
echo 'top.window.location="'.$lien.'"';
echo '</script>';

?>
