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


$filename = 'ressources/'.$idressource.'.jpg';
if (file_exists($filename)) {
	$fichierserveur=$idressource.'.jpg';
}

$filename = 'ressources/'.$idressource.'.jpeg';
if (file_exists($filename)) {
	$fichierserveur=$idressource.'.jpg';
}

$filename = 'ressources/'.$idressource.'.gif';
if (file_exists($filename)) {
	$fichierserveur=$idressource.'.gif';
}

$filename = 'ressources/'.$idressource.'.png';
if (file_exists($filename)) {
	$fichierserveur=$idressource.'.png';
}
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
								<a href="ressources_media_editer_vignette.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center">
<?php // Affichage du nom du media source
if ($_SESSION['niveau']>0) {
	if ($sourcevignette<>"") { echo '<span class="Texte_default"><?php echo versionlinguistique(48) //Supprimer ?> "</span><span class="Texte_defaultGras">'.$sourcevignette.' / '.$fichierserveur.'</span>"<span class="Texte_default"> ?</span>'; }
}
?>
					<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
						<tr>
							<td align="center">
								<a href="ressources_media_editer_vignette_fichier_supprimer_oui.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo versionlinguistique(103) //oui ?></span></a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>


	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>