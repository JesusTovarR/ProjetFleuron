<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

//$categorie=$_GET["categorie"];

$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];
$retour=$_GET["retour"];

$_SESSION['idressource']=$idressource;

// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');

$nbmedia=0;
$filename = 'ressources/'.$idressource.'.srt';
if (file_exists($filename)) {
$nbmedia=$nbmedia+1;
}
?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>
	</head>

	<body topmargin="4" leftmargin="4" marginheight="4" marginwidth="4">
		<table width="100%">
			<tr>
				<td>
					<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
						<tr>
							<td align="center">
								<a href="<?php echo $retour ?>?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center">
<?php if ($sourcetranscription<>"") {
	echo '<span class="Texte_default">'.versionlinguistique(48).' '.versionlinguistique(121).' :</span><span class="texte_note"><br>'.$sourcetranscription.'</span><br>';
	
}
?>
	<br>				<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
						<tr>
							<td align="center">
								<a href="ressources_transcription_supprimer_oui.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo versionlinguistique(103) //oui ?></span></a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>


	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>