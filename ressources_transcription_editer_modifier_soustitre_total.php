<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

//$categorie=$_GET["categorie"];
$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];

if (isset($_SESSION['retour'])) {
	$retour=$_GET["retour"];
} else {
	if (isset($_SESSION['pageencours'])) {
		$retour=$_GET["pageencours"];
	} else {
		$retour="";
	}
}

if (isset($_SESSION['refpage'])) {
	$refpage=$_GET["refpage"];
} else {
	$refpage="";
}

// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');

$soustitre=0;
$filename = 'ressources/'.$idressource.'.srt';
if (file_exists($filename)) {
$soustitre=$soustitre+1;
}
$filename = $idressource.strrchr($sourcevignette, '.');
$filenamepath = 'ressources/'.$idressource.strrchr($sourcevignette, '.');
if (file_exists($filenamepath)) {
$vignette=$filename;
}


//************************************************************************
function affichage_transcription($idressource)
	{
	$num=0;
	$nombre=0;
	$afflignes="";
	$fichier = 'ressources/'.$idressource.'.srt'; // fichier
		if (file_exists($fichier)) {

			$lignes = file($fichier);
			$lignes=str_replace("Ã´","ô",$lignes);
			$lignes=str_replace("Ã©","é",$lignes);
			$lignes=str_replace("Ã","à",$lignes);
			$lignes=str_replace("à¨","è",$lignes);
			$lignes=str_replace("àª","ê",$lignes);
			$lignes=str_replace("à§","ç",$lignes);
			$lignes=str_replace("à»","û",$lignes);
			$lignes=str_replace("à¢","â",$lignes);
			$lignes=str_replace(chr(13),"",$lignes);
			$lignes=str_replace(chr(10),"",$lignes);
			$lignes=str_replace("  "," ",$lignes);
			$lignes=str_replace("à ","à",$lignes);
			$lignes=str_replace("â ","â",$lignes);
			$lignes=str_replace("à¹","ù",$lignes);
			$lignes=str_replace("ù ","ù",$lignes);
			$lignes=str_replace("ê ","ê",$lignes);
			$lignes=str_replace("ë ","ë",$lignes);
			$lignes=str_replace("î ","î",$lignes);
			$lignes=str_replace("ï ","ï",$lignes);
			$lignes=str_replace("â ","â",$lignes);
			$lignes=str_replace("à®","î",$lignes);


			foreach($lignes as $ligne_num => $ligne) { // on lit le fichier de façon séquentielle
$ligne = str_replace(",000",",010",$ligne);
				$afflignes=$afflignes.$ligne."\r\n";

			}


		}
		echo '<textarea name="texte" cols="40" rows="25">'.$afflignes.'</textarea>';
	}
?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<!--  *********************************************************************   -->
		<!--                           Jquery -  srt - subtitle                       -->
		<!--  *********************************************************************   -->
		<script  type="text/javascript" src="scripts/jquery.js" charset="utf-8" ></script>
                <!--     Soustitres       -->
		<script type="text/javascript"  src="scripts/jquery.srt.js" charset="utf-8"></script>
		<script type="text/javascript" src="scripts/jquery.subtitle.js" charset="utf-8"></script>
		<!-- ***********************************************************************  -->
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>



	</head>

	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" onload="TabClick(0);">
<center>
<table>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="200">
				<tr>
					<td align="center">
						<a href="ressources_transcription_editer_modifier_soustitre.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>&retour=<?php echo $retour ?>&motcle=<?php echo $motcle ?>"><span class="texte_info12"><?php echo versionlinguistique(26) //Retour ?></span></a>
					</td>
				</tr>
			</table>
		</td>

	</tr>
</table>
</center>
		<form name="FormName" action="ressources_transcription_editer_modifier_soustitre_total_enre.php" method="post">
			<table width"100">
				<?php affichage_transcription($idressource) ?>
			</table>
<br><center><button id="buton1"  type="submit" class="stbuttonpublierST" ><?php echo versionlinguistique(112) ?></button></center>
						
			<input type="hidden" value="<?php echo $idressource ?>" name="idressource">
			<input type="hidden" value="<?php echo $refpage ?>" name="refpage">
		</form>
													</td>
						</tr>
					</table>


	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>