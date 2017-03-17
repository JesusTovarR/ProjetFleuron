<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$categorie=$_GET["categorie"];

$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];
$retour=$_GET["retour"];

$_SESSION['idressource']=$idressource;

// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');

?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>
	</head>

	<body topmargin="4" leftmargin="4" marginheight="4" marginwidth="4" bgcolor="#EDECE7">
		<table width="100%">
			<tr>
				<td>
					<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
						<tr>
							<td align="center">
								<a href="ressources_media_editer_media.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
							</td>
						</tr>
					</table>
				</td>
				<td align="center">
<?php // Affichage du nom du media source
if ($_SESSION['niveau']>0) {
	if ($sourcemedia<>"") { echo '<span class="texte_note">'.$sourcemedia.'</span>'; }
	if ($sourcemedia2<>"") { echo '<br><span class="texte_note">'.$sourcemedia2.'</span>'; }
}
?>
				</td>
			</tr>
		</table>
<span class="texte_note">Audio : .mp3 et .ogg - Video : .mp4 et .ogv</span>
		<form method="POST" action="ressources_media_editer_media_fichier_upload.php" enctype="multipart/form-data">				
			<table border="0" cellpadding="4" cellspacing="2" width="400">
				<tr>
					<td align="center">
						<input type="file" name="media">
					</td>
					<td align="center">
						<button id="buton1"  type="submit" class="stbuttonImp" ><?php echo versionlinguistique(112) //Publier ?></button>
					</td>
				</tr>
			</table>
	<input type="hidden" value="<?php echo $idressource ?>" name="idressource">
	<input type="hidden" value="<?php echo $retour ?>" name="retour">
											</form> 

	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>