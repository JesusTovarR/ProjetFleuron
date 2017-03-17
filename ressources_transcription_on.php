<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


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

$retour=$_GET["retour"];
$refpage=$_GET["refpage"];
$motcle=$_GET["motcle"];

$avapr = array(".",",",":",";","'"," "); // tableau des caract�res autoris�s avant et pr�s le mot cl�

// R�cup�rer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');

$nbmedia=0;
$filename = 'ressources/'.$idressource.'.srt';
if (file_exists($filename)) {
$nbmedia=$nbmedia+1;
}

//************************************************************************
function affichage_transcription($idressource)
	{
	global $motcle,$avapr;
	$fichier = 'ressources/'.$idressource.'.srt'; // fichier
		if (file_exists($fichier)) {

			$lignes = file($fichier);
			$lignes=str_replace("ô","�",$lignes);
			$lignes=str_replace("é","�",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace(chr(13),"",$lignes);
			$lignes=str_replace(chr(10),"",$lignes);
			$lignes=str_replace("� "," ",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace("��","�",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace("�","�",$lignes);
			$lignes=str_replace("�","�",$lignes);

			foreach($lignes as $ligne_num => $ligne) { // on lit le fichier de fa�on s�quentielle
				$ok=0;
					if (strlen($ligne)>5) {
						if (substr($ligne,0,1)=="0") {
						
						} else {
							if ($motcle<>"") {
								$position = stripos(strtolower($ligne),strtolower($motcle));
								if ($position>-1) 
									{

										$av = substr($ligne,$position-1,1); // caract�re pr�c�dent le mot cl�
										$apr = substr($ligne,$position+strlen($motcle),1); // caract�re suivant le mot cl�

										if(!in_array($apr, $avapr)) // si le caract�re suivant n'est pas autoris� d'apr�s le tableau
											{
											} else {
												$ok+=1;
											}
										if(!in_array($av, $avapr))  // si le caract�re pr�c�dent n'est pas autoris� d'apr�s le tableau
											{
											} else {
												$ok+=1;
											}

										if ($ok>1) { 
											$ligne = str_ireplace($motcle, '<b>'.$motcle.'</b>', $ligne);
											} else {

											}
									}
							}
							echo $ligne.'<br>';
						}

					}
			}

		}
	}

?>
	<head>

		<?php include('include/head.inc');  // header ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>
	</head>

	<body topmargin="4" leftmargin="4" marginheight="4" marginwidth="4">

<noprint>
<table width="100%">
<?php if ($nbmedia>0) { ?>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="200">
				<tr>
					<td align="center">
						<a href="ressources_transcription_off.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>&retour=<?php echo $retour ?>"><span class="texte_info12"><?php echo versionlinguistique(106) //Cacher la transcription ?></span></a>
					</td>
				</tr>
			</table>
		</td>
		<td>
<button id="buton1" class="stbuttonImp" onClick="window.print()" ><?php echo versionlinguistique(109) //IMprimer ?></button>
		</td>

	</tr>
<?php } ?>
<?php if ($_SESSION['niveau']>1) { ?>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="200">
				<tr>
					<td align="center">
						<a href="ressources_transcription_editer.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>&retour=ressources_transcription_off.php"><span class="texte_info12"><?php echo versionlinguistique(47) //Editer ?></span></a>
					</td>
				</tr>
			</table>
		</td>

	</tr>
	<?php if ($nbmedia>1) { echo '<span class="texte_note">'.$sourcetranscription.'</span>'; ?>
		</td>
	</tr>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="200">
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
</noprint>
		<?php affichage_transcription($idressource) ?>
<table width="100%">
<?php if ($nbmedia>0) { ?>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="200">
				<tr>
					<td align="center">
						<a href="ressources_transcription_off.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>&retour=<?php echo $retour ?>"><span class="texte_info12"><?php echo versionlinguistique(106) //Cacher la transcription ?></span></a>
					</td>
				</tr>
			</table>
		</td>
		<td>
<button id="buton1" class="stbuttonImp" onClick="window.print()" ><?php echo versionlinguistique(109) //IMprimer ?></button>
		</td>

	</tr>
<?php } ?>
<?php if ($_SESSION['niveau']>1) { ?>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="200">
				<tr>
					<td align="center">
						<a href="ressources_transcription_editer.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>&retour=ressources_transcription_off.php"><span class="texte_info12"><?php echo versionlinguistique(47) //Editer ?></span></a>
					</td>
				</tr>
			</table>
		</td>

	</tr>
	<?php if ($nbmedia>1) { echo '<span class="texte_note">'.$sourcetranscription.'</span>'; ?>
		</td>
	</tr>
	<tr>
		<td width="120" align="left">
			<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="200">
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