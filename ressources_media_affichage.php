<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];
$categorie=$_GET["categorie"];
$page=$_GET["page"];


//************************************************************************
//			V�rification pr�sence fichier
//************************************************************************

$nbmedia=0;
$filename = '/ressources/'.$id.'.mp4';
if (file_exists($filename)) {
	$video=1;
	$nbmedia=$nbmedia+1;
} else {
	$video=0;

}

$filename = '/ressources/'.$id.'.mp3';
if (file_exists($filename)) {
    $audio=1;
	$nbmedia=$nbmedia+1;
} else {
    $audio=0;
}




?>
<html>
	<head>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>
	<body>
<table width="100%" height="100%">
	<tr>
		<td align="center" valign="middle">
<?php 
 if ($nbmedia>0) {

	} else {
?>
				<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="220">
					<tr>
						<td align="center"><a href="ressources_media_ajouter_video.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&categorie=<?php echo $categorie ?>&page=<?php echo $page ?>"><span class="texte_info12"><?php echo new_versionlinguistique("text97") //Ajouter un fichier video ?></span></a></td>
					</tr>
				</table>


				<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="220">
					<tr>
						<td align="center"><a href="ressources_media_ajouter_audio.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&categorie=<?php echo $categorie ?>&page=<?php echo $page ?>"><span class="texte_info12"><?php echo new_versionlinguistique("text98") //Ajouter un fichier audio ?></span></a></td>
					</tr>
				</table>
<?php
	}
?>
		</td>
	</tr>
</table>




	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>