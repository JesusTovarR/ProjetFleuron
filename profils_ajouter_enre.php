<?php
include('include/open_connectionBase.inc'); 



$requete ='INSERT INTO `profil` (`id`,`utilisateur`,`motdepasse`,`nom`,`prenom`,`email`,`pays`,`langue`,`niveau`,`jour`,`heure`) VALUES (NULL,'; // début de la composition de la requete de mise à jour
$requete = $requete.'\''.addslashes($_POST["utilisateur"]).'\',';
$requete = $requete.'\''.addslashes($_POST["motdepasse"]).'\',';
$requete = $requete.'\''.addslashes($_POST["nom"]).'\',';
$requete = $requete.'\''.addslashes($_POST["prenom"]).'\',';
$requete = $requete.'\''.$_POST["email"].'\',';
$requete = $requete.'\''.$_POST["pays"].'\',';
$requete = $requete.'\''.$_POST["langue"].'\',';
$requete = $requete.'\''.$_POST["niveau"].'\',';

$today = date("Y-m-d");
$requete = $requete.'\''.$today.'\',';
$heure = date("H:i:s");
$requete = $requete.'\''.$heure.'\')';

//echo $requete;

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


$donnee=mysql_query('SELECT id FROM profil ORDER BY id DESC LIMIT 1');
while ($donnee = mysql_fetch_assoc($donnee))
{ $dernierid = $donnee['id']; }



include('include/close_connectionBase.inc'); 

header('Location: profils_pays_list.php?lg='.$_POST["lg"].'&niveau='.$_POST["niveau"].'&pays='.$_POST["pays"].'&action2=ok&profil='.$dernierid.'#'.$dernierid); // redirection

?>
