<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$categorie=$_GET["categorie"];

$idressource=$_GET["idressource"];
$idprofil=$_GET["idprofil"];
$retour=$_GET["retour"];

$_SESSION['idressource']=$idressource;

// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');

$filename = 'ressources/'.$idressource.'.srt';
if (file_exists($filename)) {
	$fichierserveur=$idressource.'.srt';
}

?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>
	</head>

	<body topmargin="4" leftmargin="4" marginheight="4" marginwidth="4">
		<table border="0" width="100%">
			<tr>
				<td align="left">
					<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
						<tr>
							<td align="center">
								<a href="<?php echo $retour ?>?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
							</td>
						</tr>
					</table>
				</td>
				<td align="right">
<?php if ($fichierserveur=="") { ?>
					<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
						<tr>
							<td align="center">
								<a href="<?php echo $retour ?>?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo versionlinguistique(110) //créer ?></span></a>
							</td>
						</tr>
					</table>

<?php } else { ?>
					<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
						<tr>
							<td align="center">
								<a href="ressources_transcription_editer_modifier.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>" target="_top"><span class="texte_menu"><?php echo versionlinguistique(41) //Modifier ?></span></a>
							</td>
						</tr>
					</table>
<?php } ?>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
<?php // Affichage du nom du media source
if ($_SESSION['niveau']>0) {
	if ($sourcetranscription<>"") { echo '<span class="texte_note">'.$sourcetranscription.'</span>'; }
}
?>
				</td>
			</tr>
		</table>
<span class="texte_note">Fichier .srt</span>
		<form method="POST" action="ressources_transcription_editer_upload.php" enctype="multipart/form-data">				
			<table border="0" cellpadding="4" cellspacing="2" width="300">
				<tr>
					<td align="center">
						<input type="file" name="media">
					</td>
				</tr>
				<tr>
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