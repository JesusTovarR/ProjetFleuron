<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$categorie=$_GET["categorie"];

$id=$_GET["idressource"];
$idprofil=$_GET["idprofil"];
$page=$_GET["pageencours"];

//************************************************************************
//			Récupération titre et description
//************************************************************************
	$requete = 'SELECT * FROM ressources WHERE id='.$id;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				$nom=$data['nom_'.$lg];
				if ($nom=="") {
					$nom=$data['nom_uk'];
				}
				if ($nom=="") {
					$nom=$data['nom_fr'];
				}


			}


//************************************************************************
//			Vérification présence fichier
//************************************************************************

$filename = '/ressources/'.$id.'.mp4';
if (file_exists($filename)) {
    $video=1;
} else {
    $video=0;
}

$filename = '/ressources/'.$id.'.mp3';
if (file_exists($filename)) {
    $audio=1;
} else {
    $audio=0;
}
//************************************************************************
function affichage_commentaire($id)
	{
	$requete = 'SELECT * FROM commentaires WHERE ressource='.$id;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				echo '<tr>';
					echo '<td bgcolor="'.couleur(4).'">';
				echo '<span class="Texte_defaultGras">'.affichage_utilisateur($data['profil']).'</span><br>';
				echo '<span class="Texte_default">'.$data['commentaire'].'</span><br>';
					echo '</td>';
				echo '<tr>';
			}
	}

function affichage_utilisateur($utilisateur)
	{
	$requete='SELECT utilisateur FROM profil WHERE id='.$utilisateur;
	$recup = mysql_query($requete);

	if ($data = mysql_fetch_assoc($recup))
		{
			return $data['utilisateur'];
		}
	}

include('include/recuperation_nom_categorie.inc'); // Routines d'affichage du nom de la catégorie retenue
?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<?php include('include/alexandria.inc');  // dictionnaire alexandria ?>
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
								<table width="100%" border="0">
									<tr>
										<td width="80">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="80" height="44">
												<tr>
													<td align="center">
														<a href="<?php echo $page ?>?lg=<?php echo $lg ?>&categorie=<?php echo $categorie ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo general("text5") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">

<?php
					if ($data['offline']==1) {
?>

								<span class="titre"><?php echo $nom; //Titre de la ressource ?></span>

<?php
					} else {
?>

								<span class="titre"><?php echo $nom; //Titre de la ressource ?></span>
<?php
					}
?>

										</td>
										<td width="40" align="right">
<?php if ($_SESSION['niveau']>0) { ?>
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="40">
												<tr>
													<td align="center">
														<iframe src="favoris.php?ressource=<?php echo $id ?>&id=<?php echo $_SESSION['id'] ?>" name="notes" width="35" scrolling="NO" height="35" frameborder="0"></iframe>
													</td>
												</tr>
											</table>
<?php } ?>
										</td>

									</tr>
								</table>

								<table border="0" cellpadding="0" cellspacing="2">
									<tr>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(0);" width="80" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo new_versionlinguistique("text81") //Media ?></td>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(1);" width="80" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo general("text14") //Description ?></td>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(2);" width="80" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo new_versionlinguistique("text93") //Conseils ?></td>
<?php if ($_SESSION['niveau']>0) { ?>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(3);" width="80" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo new_versionlinguistique("text82") //Notes ?></td>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(4);" width="80" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo general("text12") //Commentaires ?></td>
<?php } ?>
									</tr>
								</table>

								<div id="Content" name="Content" align="center">
<img src="ressources/vignettes/5.jpg" width="400"><br><br>

<?php 
			$requete = 'SELECT id FROM commentaires WHERE ressource='.$id;
			$recup = mysql_query($requete);
			$num_rows = mysql_num_rows($recup);

if ($num_rows>0) {
	echo '<div align="left">';
		echo '<span class="titre">'.general("text12").' :</span><br><br>';
		echo '<table cellpadding="10" width="100%">';
			affichage_commentaire($id);
		echo '</table>';
	echo '</div>';
?>

<?php } else { ?>

<?php } ?>
								</div>
								<div id="Content" name="Content">
									<iframe src="ressources_media_description.php?lg=<?php echo $lg ?>&idressource=<?php echo $id ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="conseil" width="480" scrolling="AUTO" height="600" frameborder="0"></iframe>
								</div>
								<div id="Content" name="Content">
									<iframe src="ressources_media_conseils.php?lg=<?php echo $lg ?>&idressource=<?php echo $id ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="conseil" width="480" scrolling="AUTO" height="600" frameborder="0"></iframe>
								</div>
<?php if ($_SESSION['niveau']>0) { ?>
								<div id="Content" name="Content">
									<iframe src="ressources_media_notes.php?lg=<?php echo $lg ?>&idressource=<?php echo $id ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="notes" width="480" scrolling="AUTO" height="900" frameborder="0"></iframe>
								</div>
								<div id="Content" name="Content">
									<iframe src="ressources_media_commentaires.php?lg=<?php echo $lg ?>&idressource=<?php echo $id ?>&idprofil=<?php echo $_SESSION['id'] ?>" name="notes" width="480" scrolling="AUTO" height="450" frameborder="0"></iframe>
								</div>
<?php } ?>






							</td>
<!-- Fin partie centrale -->
<!-- Colonne de droite -->
							<td width="360" align="right" valign="top">
								<table border="0" cellpadding="1" cellspacing="2">
									<tr>
										<td>
											<iframe src="script_09_off.htm" name="notes" width="350" scrolling="AUTO" height="350" frameborder="1"></iframe>
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
<!-- Module d'affichage menu admin  -->
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