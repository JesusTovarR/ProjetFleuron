<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

if (! isset($_SESSION['niveau'])) {
	$_SESSION['niveau']=0;
}

if (isset($_SESSION['categorie'])) {
	$categorie=$_GET["categorie"];
}


$idressource=$_GET["idressource"];

if (isset($_SESSION['idprofil'])) {
	$idprofil=$_GET["idprofil"];
}



if (isset($_GET["retour"])) {
	$retour=$_GET["retour"];
} else {
	$retour="";
}

if ($retour=="") {
	if (isset($_GET["pageencours"])) {
		$retour=$_GET["pageencours"];
	} else {
		$retour="";
	}
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


if (isset($_GET["timecode"])) {
	$timecode=$_GET["timecode"];
} else {
	$timecode="";
}

if (! isset($_SESSION['idressource'])) {
	$_SESSION['idressource']=0;
}

$offstetimecode = "#t=".$timecode;

// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');

if ($_SESSION['niveau']>0) {
if ($_SESSION['idressource']<>$_GET["idressource"]) {
// ***************************************************************
// Consultations de l'utilisateur
// ***************************************************************
	$query='SELECT consultation FROM profil WHERE id='.$_SESSION['id'];
	$recup = mysql_query($query);
		while ($data = mysql_fetch_assoc($recup))
			{
			$consultation = $data['consultation']; // récupération des consultations
		}

	if ($consultation<>"") { // s'il y a des consultations

		$eleconsultation = explode(";",$consultation); // convertir les consultations en tableau
		$navigation="";

		for ($i = 0; $i <= count($eleconsultation)-2; $i++) {
			if ($eleconsultation[$i]==$idressource) {

				} else {
   				 	$navigation = $navigation.$eleconsultation[$i].';';
				}
		}
		$navigation = $navigation.$idressource.';';

	} else { // s'il y a PAS de consultation
		$navigation = $idressource.';';
	}
		$requete ='UPDATE `profil` SET ';
		$requete =$requete.'`consultation`="'.$navigation.'"';
		$requete =$requete.' WHERE id='.$_SESSION['id']; 

		mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


// ***************************************************************
// Compteur nombre de consultation de la ressource
// ***************************************************************

	$visiteur = $visiteur + 1; // variable récupérer précédement dans Recup_infosRessource

	$requete ='UPDATE `ressources` SET ';
	$requete =$requete.'`visiteur`='.$visiteur;
	$requete =$requete.' WHERE id='.$_GET["idressource"]; 

	mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete
	$_SESSION['idressource']=$_GET["idressource"];
}
}

$nbonglet=0;
//************************************************************************
//			Vérification présence media, transcription et vignette
//************************************************************************
$nbmedia=0;
$filename = 'ressources/'.$idressource.'.mp4';
if (file_exists($filename)) {
$nbmedia=$nbmedia+1;
}

$filename = 'ressources/'.$idressource.'.ogv';
if (file_exists($filename)) {
$nbmedia=$nbmedia+1;
}

$filename = 'ressources/'.$idressource.'.mp3';
if (file_exists($filename)) {
$nbmedia=$nbmedia+1;
}

$filename = 'ressources/'.$idressource.'.ogg';
if (file_exists($filename)) {
$nbmedia=$nbmedia+1;
}

$filename = $idressource.strrchr($sourcevignette, '.');
$filenamepath = 'ressources/'.$idressource.strrchr($sourcevignette, '.');
if (file_exists($filenamepath)) {
$vignette=$filename;
}

$soustitre=0;
$filename = 'ressources/'.$idressource.'.srt';
if (file_exists($filename)) {
$soustitre=$soustitre+1;
}



//************************************************************************
//		Nombre de conseils associés à cette ressource
//************************************************************************
$requete = 'SELECT COUNT(ressource) AS total FROM conseils_page WHERE ressource='.$idressource;
$recup = mysql_query($requete);
$data = mysql_fetch_assoc($recup);
$nbconseils = $data['total']; 

//************************************************************************
//		Affichage des commentaires
//************************************************************************
function affichage_commentaire($idressource)
	{
	global $lg;
	$requete = 'SELECT * FROM commentaires WHERE ressource='.$idressource.' AND reponse=0';
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				echo '<tr>';
					echo '<td>';
				if ($_SESSION['niveau']>5) {
					echo '<table width="100%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_repondre.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(136).'</span></a>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_supprimer.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(48).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';

				} else {
					if ($_SESSION['id']==$data['profil']) {
					echo '<table width="100%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="100" align="center">';
								echo '<a href="commentaire_supprimer.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(48).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
					} else {
					echo '<table width="100%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_repondre.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(136).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
					}
				}
				echo '</tr>';
					affichage_reponse1($data['id']);
			}
	}
//------------------------------------------------
//		Affichage de réponse niveau 1
//------------------------------------------------
function affichage_reponse1($reponse)
	{
	global $lg,$idressource;
	$requete = 'SELECT * FROM commentaires WHERE reponse='.$reponse;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				echo '<tr>';
					echo '<td align="right">';
				if ($_SESSION['niveau']>5) {
					echo '<table width="95%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_repondre.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(136).'</span></a>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_supprimer.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(48).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';

				} else {
					if ($_SESSION['id']==$data['profil']) {
					echo '<table width="95%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="100" align="center">';
								echo '<a href="commentaire_supprimer.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(48).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
					} else {
					echo '<table width="95%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_repondre.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(136).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
					}
				}
				echo '</tr>';
					affichage_reponse2($data['id']);
			}
	}
//------------------------------------------------
//		Affichage de réponse niveau 2
//------------------------------------------------
function affichage_reponse2($reponse)
	{
	global $lg,$idressource;
	$requete = 'SELECT * FROM commentaires WHERE reponse='.$reponse;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				echo '<tr>';
					echo '<td align="right">';
				if ($_SESSION['niveau']>5) {
					echo '<table width="90%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_repondre.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(136).'</span></a>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_supprimer.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(48).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';

				} else {
					if ($_SESSION['id']==$data['profil']) {
					echo '<table width="90%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="100" align="center">';
								echo '<a href="commentaire_supprimer.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(48).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
					} else {
					echo '<table width="90%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_repondre.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(136).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
					}
				}
				echo '</tr>';
					affichage_reponse3($data['id']);
			}
	}
//------------------------------------------------
//		Affichage de réponse niveau 2
//------------------------------------------------
function affichage_reponse3($reponse)
	{
	global $lg,$idressource;
	$requete = 'SELECT * FROM commentaires WHERE reponse='.$reponse;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				echo '<tr>';
					echo '<td align="right">';
				if ($_SESSION['niveau']>5) {
					echo '<table width="85%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="80" align="center">';
								echo '<a href="commentaire_supprimer.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(48).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';

				} else {
					if ($_SESSION['id']==$data['profil']) {
					echo '<table width="85%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';
							echo '<td bgcolor="'.couleur(1).'" width="100" align="center">';
								echo '<a href="commentaire_supprimer.php?lg='.$lg.'&idressource='.$idressource.'&idcommentaire='.$data['id'].'"><span class="texte_menu">'.versionlinguistique(48).'</span></a>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
					} else {
					echo '<table width="85%">';
						echo '<tr>';
							echo '<td bgcolor="'.couleur(4).'">';
								echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
								echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
							echo '</td>';

						echo '</tr>';
					echo '</table>';
					}
				}
				echo '</tr>';
			}
	}

//************************************************************************
//		Récupération nom utilisateur
//************************************************************************
function affichage_utilisateur($utilisateur)
	{
	$requete='SELECT utilisateur FROM profil WHERE id='.$utilisateur;
	$recup = mysql_query($requete);

	if ($data = mysql_fetch_assoc($recup))
		{
			return $data['utilisateur'];
		}
	}


//**********************************
// Affichage du glossaire
//**********************************
function affichage_glossaire()
	{

		global $lg,$pageencours; // récupération variable langue

			$requete = 'SELECT * FROM glossaire ORDER BY item';
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
					{
					echo '<tr><td bgcolor="#E5E4DF">';
					echo '<table width="100%">';
						echo '<tr>';
							echo '<td width="150" align="left" valign="top">';
								echo '<span class="texte_defaultGras">'.$data['item'].'</span>';
							echo '</td>';
							echo '<td>';
								echo '<td ><span class="texte_default">'.$data['description_'.$lg].'</span></td>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
					echo '</td>';
					echo '</tr>';

					}


	}

include('include/recuperation_nom_categorie.inc'); // Routines d'affichage du nom de la catégorie retenue
?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<?php include('include/alexandria.inc');  // dictionnaire alexandria ?>
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

	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="white" onload="TabClick(0);">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
			<tr height="67">
				<td align="center" valign="middle" bgcolor="<?php echo couleur(2); // couleur claire ?>" height="67">
					<!-- Module affichage du bandeau contenant le logo FLEURON -->
					<?php include('include/logo_fleuron.inc');  ?>
				</td>
			</tr>
			<tr height="40">
				<td bgcolor="<?php echo couleur(1); //couleur foncée ?>" height="40" align="center">
					<?php 
						// Menu Supérieur 
						include('include/menu_top.inc'); 

					?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#f6f5ed" align="center" valign="top">
					<table border="0" cellpadding="2" cellspacing="2" width="860">
						<tr>
<!-- Partie centrale -->
							<td valign="top" width="580">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
									<tr>
										<td width="80">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="80" height="46">
												<tr>
													<td align="center">
<?php if ($motcle<>"") { ?>
														<a href="moteurderecherche.php?lg=<?php echo $lg ?>&motcle=<?php echo $motcle ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
	<?php } else { ?>
														<a href="ressources_list.php?lg=<?php echo $lg ?>&categorie=<?php echo $categorie ?>&refpage=<?php echo $refpage ?>&idprofil=<?php echo $idprofil ?>#<?php echo $idressource ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
	<?php } ?>
													</td>
												</tr>
											</table>
										</td>
										<td align="center" bgcolor="<?php echo couleur(2); //couleur foncée ?>">

<?php
					if ($offline==1) {
?>

								<span class="titreoffline"><?php echo $nom; //Titre de la ressource ?> (offline)</span>

<?php
					} else {
?>

								<span class="titre"><?php echo $nom; //Titre de la ressource ?></span>
<?php
					}
?>

										</td>

<?php if ($_SESSION['niveau']>0) { ?>
										<td width="40" align="right" bgcolor="<?php echo couleur(1); //couleur foncée ?>">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="40" height="46">
												<tr>
													<td align="center">
														<iframe src="favoris_ressource.php?ressource=<?php echo $idressource ?>&id=<?php echo $_SESSION['id'] ?>" name="notes" width="35" scrolling="NO" height="36" frameborder="yes"></iframe>
													</td>
												</tr>
											</table>
										</td>
<?php } else {?>
										<td width="40" align="right" bgcolor="<?php echo couleur(2); //couleur clair ?>">

										</td>
<?php } ?>


									</tr>
								</table>

								<table border="0" cellpadding="0" cellspacing="0">
									<tr>
<?php 	
		if ($_SESSION['niveau']>0) {
			if ($_SESSION['niveau']>4) {
				$valdim=80;
			} else {
				$valdim=150;
			}
		} else {
			if ($nbconseils>0) {
				$valdim=150;
			} else {
				$valdim=300;
			}
		}


?>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(0);" width="<?php echo $valdim ?>" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(81) //Media ?></td>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(1);" width="<?php echo $valdim ?>" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(69) //Description ?></td>
<?php $nbonglet=1 ?>
<?php if ($nbconseils>0) { $nbonglet=$nbonglet+1 ?>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(<?php echo $nbonglet ?>);" width="<?php echo $valdim ?>" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(93) //Conseils ?></td>

<?php } else { ?>
	<?php if ($_SESSION['niveau']>1) { $nbonglet=$nbonglet+1 ?>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(<?php echo $nbonglet ?>);" width="<?php echo $valdim ?>" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(93) //Conseils ?></td>
	<?php } else { ?>

	<?php } ?>
<?php } ?>

	<?php if ($_SESSION['niveau']>0) { ?>
<?php $nbonglet=$nbonglet+1 ?>
<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(<?php echo $nbonglet ?>);" width="<?php echo $valdim ?>" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(133) //glossaire ?></td>
<?php } ?>


<?php if ($_SESSION['niveau']>0) { $nbonglet=$nbonglet+1 ?>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(<?php echo $nbonglet ?>);" width="<?php echo $valdim ?>" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(82) //Notes ?></td>
<?php //$nbonglet=$nbonglet+1 ?>
										<!-- <td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(<?php echo $nbonglet ?>);" width="<?php echo $valdim ?>" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(83) //Commentaires ?></td> -->
<?php } ?>
<?php if ($_SESSION['niveau']>0) { ?>
	<?php if ($liens<>"") { $nbonglet=$nbonglet+1 ?>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(<?php echo $nbonglet ?>);" width="<?php echo $valdim ?>" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(138) //Liens ?></td> 
	<?php } else {?>
		<?php if ($_SESSION['niveau']>5) { $nbonglet=$nbonglet+1 ?>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(<?php echo $nbonglet ?>);" width="<?php echo $valdim ?>" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(138) //Liens ?></td> 
		<?php } ?>
	<?php } ?>
<?php } ?>
									</tr>
								</table>
<!-- ******************************************************************************** -->
<!-- *********************** Affichage du media de la ressource********************** -->
<!-- ******************************************************************************** -->
								<div id="Content" name="Content" align="center">



	<?php if ($typemedia=="audio") { ?>
<!-- ----------------------------------------------------------------------- -->
<!--                         Affichage du media AUDIO                        -->
<!-- ----------------------------------------------------------------------- -->
	<!-- Vérification et affichage vignette -->
		<?php if ($vignette=="") { ?>
			<img src="visuel/pictos/hp_160.png">
		<?php } else { ?>
			<img src="ressources/<?php echo $vignette?>" width="200">
		<?php } ?>

	<!-- Affichage controleur AUDIO -->
		<audio   id="audio"  controls  width="480" height="500" >
			<source src="ressources/<?php echo $idressource ?>.mp3<?php echo $offstetimecode ?>" >
			<source src="ressources/<?php echo $idressource ?>.ogg<?php echo $offstetimecode ?>" >
		</audio>
<?php if ($soustitre>0) { ?>
	<!-- Sous-titres-->
			<div id="subtitres">
				<button id="buton1" class="stbutton" ><?php echo versionlinguistique(108) //Afficher les sous-titres ?></button>
				<div id="soustitre">
					<div id="sub1" class="srt" data-video="audio" data-srt="ressources/<?php echo $idressource ?>.srt"></div>
				</div>

			</div> 
	<!-- Fin sous titres-->
	<!-- Bouton Masquer/afficher les sous-titres -->		
			<script>
					$('#buton1').click(function () {
						if ($("#soustitre").is(":hidden")) {
							$("#soustitre").show("slow");
							document.getElementById('buton1').innerHTML = "<?php echo versionlinguistique(108) //Afficher les sous-titres ?>";
						} else {
							$("#soustitre").slideUp();
							document.getElementById('buton1').innerHTML = "<?php echo versionlinguistique(107) //Afficher les sous-titres ?>";
						}
					});
					
			</script>
	<!-- Fin bouton -->
<?php } ?>
<!-- ----------------------- Fin affichage audio ---------------------------- -->
	<?php } ?>
	<?php if ($typemedia=="video") { ?>
<!-- ----------------------------------------------------------------------- -->
<!-- ----------------------- Affichage du media VIDEO ---------------------- -->
<!-- ----------------------------------------------------------------------- -->
	<!-- Affichage controleur VIDEO -->
			<video  id="video"  controls  width="480" >
				<source src="ressources/<?php echo $idressource ?>.ogv<?php echo $offstetimecode ?>" type='video/ogg; codecs="theora, vorbis"' >
				<source src="ressources/<?php echo $idressource ?>.mp4<?php echo $offstetimecode ?>" >
				
				Erreur!!! Changer de navigateur!!!
			</video>

<?php if ($soustitre>0) { ?>

	<!-- Sous-titres-->
			<div id="subtitres">
				<button id="buton1" class="stbutton" ><?php echo versionlinguistique(108) //Afficher les sous-titres ?></button>
				<div id="soustitre">
<?php clearstatcache(); ?>
					<div id="sub1" class="srt" data-video="video" data-srt="ressources/<?php echo $idressource ?>.srt"></div>
				</div>
			</div> 
	<!-- Fin sous titres-->
	<!-- Bouton Masquer/afficher les sous-titres -->		
			<script>
					$('#buton1').click(function () {
						if ($("#soustitre").is(":hidden")) {
							$("#soustitre").show("slow");
							document.getElementById('buton1').innerHTML = "<?php echo versionlinguistique(108) //Afficher les sous-titres ?>";
						} else {
							$("#soustitre").slideUp();
							document.getElementById('buton1').innerHTML = "<?php echo versionlinguistique(107) //Afficher les sous-titres ?>";
						}
					});
					
			</script>
	<!-- Fin bouton -->
<?php } ?>
<!-- ***** Fin affichage video -->
	<?php } ?>

<!-- *********************** Bouton Editer Media ********************** -->
<?php if ($_SESSION['niveau']>4) { ?>
	<br><iframe src="ressources_media_editer_media.php?lg=<?php echo $lg ?>&retour=<?php echo $retour ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="conseil" width="480" scrolling="NO" height="120" frameborder="0"></iframe>
<?php } ?>
<!-- *********************** Bouton Editer Vignette ********************** -->
<?php if ($_SESSION['niveau']>4) { ?>
	<br><iframe src="ressources_media_editer_vignette.php?lg=<?php echo $lg ?>&retour=<?php echo $retour ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="conseil" width="480" scrolling="NO" height="120" frameborder="0"></iframe>
<?php } ?>
	<?php if ($_SESSION['niveau']>0) { ?>
<!-- ********************** Champ commentaire *****************  -->
<br>
		<form name="FormName" action="ressources_media_commentaires_enre.php" method="post">
		<table border="0" cellpadding="2" cellspacing="2">
			<tr>
				<td>
					<p><?php echo versionlinguistique(135); //Faire un commentaire ?></p>
					<p><textarea name="commentaire" cols="54" rows="3"></textarea></p>
				</td>
			</tr>
			<tr>
				<td align="center">					
						<button id="buton1"  type="submit" class="stbuttonImp" ><?php echo versionlinguistique(112) //publier ?></button>
				</td>
			</tr>
		</table>
			<input type="hidden" value="<?php echo $lg ?>" name="lg">
			<input type="hidden" value="<?php echo $idressource ?>" name="idressource">
			<input type="hidden" value="<?php echo $_SESSION['id'] ?>" name="idprofil">


<!-- *********************** Commentaires ********************** -->
<?php 
			$requete = 'SELECT id FROM commentaires WHERE ressource='.$idressource;
			$recup = mysql_query($requete);
			$num_rows = mysql_num_rows($recup);

if ($num_rows>0) {
	echo '<div align="left">';
		echo '<br><span class="Texte_default">'.versionlinguistique(83).' :</span><br>';
		echo '<table cellpadding="2" width="100%">';
			affichage_commentaire($idressource);
		echo '</table>';
	echo '</div>';
?>
		</form>
<?php } else { ?>

<?php } ?>
<?php } ?>
<!-- ******************************************************************************** -->
<!-- ******************* Fin de l'affichage du media de la ressource***************** -->
<!-- ******************************************************************************** -->
								</div>
								<div id="Content" name="Content">
									<iframe src="ressources_media_description.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="conseil" width="480" scrolling="AUTO" height="600" frameborder="0"></iframe>
								</div>
<?php if ($nbconseils>0) { ?>
								<div id="Content" name="Content">
									<iframe src="ressources_media_conseils.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="conseil" width="480" scrolling="AUTO" height="630" frameborder="yes"></iframe>
								</div>

<?php } else { ?>
	<?php if ($_SESSION['niveau']>1) { ?>
								<div id="Content" name="Content">
									<iframe src="ressources_media_conseils.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="conseil" width="480" scrolling="AUTO" height="600" frameborder="yes"></iframe>
								</div>
	<?php } else { ?>

	<?php } ?>
<?php } ?>
	<?php if ($_SESSION['niveau']>0) { ?>
								<div id="Content" name="Content">
									<table width="100%">
										<?php affichage_glossaire() ?>
									</table>
								</div>
<?php } ?>

<?php if ($_SESSION['niveau']>0) { ?>
								<div id="Content" name="Content">
									<iframe src="ressources_media_notes.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="notes" width="480" scrolling="AUTO" height="900" frameborder="yes"></iframe>
								</div>
								<!-- <div id="Content" name="Content"> -->
									<!-- <iframe src="ressources_media_commentaires.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="notes" width="480" scrolling="AUTO" height="450" frameborder="yes"></iframe> -->
								<!-- </div> -->
<?php if ($_SESSION['niveau']>0) { ?>
	<?php if ($liens<>"") { $nbonglet=$nbonglet+1 ?>
								<div id="Content" name="Content"> 
									<iframe src="ressources_liens.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="notes" width="480" scrolling="AUTO" height="450" frameborder="yes"></iframe> 
								</div> 
	<?php } else {?>
		<?php if ($_SESSION['niveau']>5) { ?>
								<div id="Content" name="Content"> 
									<iframe src="ressources_liens.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="notes" width="480" scrolling="AUTO" height="450" frameborder="yes"></iframe> 
								</div> 
		<?php } ?>
	<?php } ?>
<?php } ?>
<?php } ?>






							</td>
<!-- Fin partie centrale -->
<!-- Colonne de droite -->
							<td width="360" align="right" valign="top">
								<table border="0" cellpadding="1" cellspacing="2">
									<tr>
										<td>
											<iframe src="ressources_transcription_off.php?lg=<?php echo $lg ?>&retour=<?php echo $retour ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>&idprofil=<?php echo $_SESSION['id'] ?>&motcle=<?php echo $motcle ?>" name="transcription" width="350" scrolling="AUTO" height="480" frameborder="1"></iframe>
										</td>
									</tr>
									<tr>
										<td align="center">
<!-- Module d'affichage du formulaire de recherche  -->
<?php include('include/moteurderecherche.inc');  ?>
											</td>
									</tr>

									<tr>
										<td align="center">
<!-- Module d'affichage menu utilisateur  -->
<?php include('include/menu_FavorisNotesComm.inc');  ?>		
										</td>
									</tr>
									<tr>
										<td align="center">
<!-- Module d'affichage menu Admin  -->
<?php include('include/menu_admin.inc');  ?>		
										</td>
									</tr>

								</table>
							</td>
<!-- Fin colonne de droite -->
						</tr>
					</table>
				</td>
			</tr>
			<tr height="40">
				<td bgcolor="<?php echo couleur(2); // couleur clair ?>" height="40" align="center">
					<!-- Module d'affichage du bandeau de bas de page  -->
					<?php include('include/bandeau_basdepage.inc');  ?>
				</td>
			</tr>
			<tr height="150">
				<td height="150" align="center">
					<!-- Module d'affichage du dernier media publié  -->
					<?php include('include/logo_basdepage.inc');  ?>
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>