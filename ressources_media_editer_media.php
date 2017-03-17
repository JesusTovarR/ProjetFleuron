<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

//$categorie=$_GET["categorie"];

$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];
//$retour=$_GET["retour"];

$_SESSION['tmp']=0;

// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');
?>
	<head>

		<?php include('include/head.inc');  // header ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>
	</head>

	<body topmargin="4" leftmargin="4" marginheight="4" marginwidth="4" bgcolor="#E5E4DF">


<table border="0"width="100%">
	<tr>
		<td align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="120">
				<tr>
					<td align="center">
						<a href="ressources_media_editer_media_fichier.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&categorie=<?php echo $categorie ?>&retour=<?php echo $retour ?>"><span class="texte_info12"><?php echo versionlinguistique(101) //Editer media ?></span></a>
					</td>
				</tr>
			</table>
		</td>
		<td align="right">
<?php if ($sourcemedia<>'') { ?>
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="120">
				<tr>
					<td align="center">
						<a href="ressources_media_editer_media_fichier_supprimer.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&categorie=<?php echo $categorie ?>&retour=<?php echo $retour ?>"><span class="texte_info12"><?php echo versionlinguistique(48) //Supprimer ?></span></a>
					</td>
				</tr>
			</table>
<?php } ?>
		</td>
	</tr>
	<tr>
		<td align="left" colspan="2">
<?php // Affichage du nom du media source
if ($_SESSION['niveau']>0) {
	if ($sourcemedia<>"") { echo '<span class="Texte_note">'.$sourcemedia.'</span>'; }
	if ($sourcemedia2<>"") { echo '<br><span class="Texte_note">'.$sourcemedia2.'</span>'; }
}
?>


<br><br> <span class="Texte_note">ID ressource : <?php echo $idressource ?></span>
		</td>
	</tr>
</table>

	</body>
</html>
<?php include('include/close_connectionBase.inc');  ?>