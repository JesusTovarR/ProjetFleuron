<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


if (isset($_GET["categorie"])) {
	$categorie=$_GET["categorie"];
} else {
	$categorie="";
}

$idressource=$_GET["idressource"];

if (isset($_GET["idprofil"])) {
	$idprofil=$_GET["idprofil"];
} else {
	$idprofil="";
}


if (isset($_GET["retour"])) {
	$retour=$_GET["retour"];
} else {
	$retour="";
}

if (isset($_GET["refpage"])) {
	$refpage=$_GET["refpage"];
} else {
	$refpage="";
}



if (isset($_GET["motcle"])) {
	$motcle=$_GET["motcle"];
} else {
	$motcle="";
}


// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');

$nbmedia=0;
$filename = 'ressources/'.$idressource.'.srt';
if (file_exists($filename)) {
$nbmedia=$nbmedia+1;
}

?>
	<head>

		<?php include('include/head.inc');  // header ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>
	</head>

	<body topmargin="4" leftmargin="4" marginheight="4" marginwidth="4">


<table width="100%">
<?php if ($nbmedia>0) { ?>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="200">
				<tr>
					<td align="center">
						<a href="ressources_transcription_on.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>&retour=<?php echo $retour ?>&motcle=<?php echo $motcle ?>"><span class="texte_info12"><?php echo versionlinguistique(105) //Afficher la transcription ?></span></a>
					</td>
				</tr>
			</table>
		</td>

	</tr>
<?php } ?>
<?php // Affichage du nom du media source
if ($_SESSION['niveau']>1) { ?>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="200">
				<tr>
					<td align="center">
						<a href="ressources_transcription_editer.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>&retour=ressources_transcription_off.php"><span class="texte_info12"><?php echo versionlinguistique(47) //Editer ?></span></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
	<?php if ($nbmedia>0) {  ?>

		<span class="texte_note"><?php echo $sourcetranscription ?></span>
		</td>
	</tr>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="200">
				<tr>
					<td align="center">
						<a href="ressources_transcription_supprimer.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>&retour=ressources_transcription_off.php"><span class="texte_info12"><?php echo versionlinguistique(48) //Supprimer ?></span></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php } ?>
<?php } ?>

</table>

	</body>
</html>
<?php include('include/close_connectionBase.inc');  ?>