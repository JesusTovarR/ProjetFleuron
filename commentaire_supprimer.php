<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$categorie=$_GET["categorie"];

$idressource=$_GET["idressource"];
$idprofil=$_GET["idprofil"];
$retour=$_GET["retour"];
$idcommentaire=$_GET["idcommentaire"];

$_SESSION['idressource']=$idressource;

//************************************************************************
//		Affichage des commentaires
//************************************************************************
function affichage_commentaire($idcommentaire)
	{
	global $lg;
	$requete = 'SELECT * FROM commentaires WHERE id='.$idcommentaire;
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

//************************************************************************
//		R�cup�ration nom utilisateur
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
?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
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
				<td bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" height="40" align="center">
					<?php 
						// Menu Sup�rieur 
						include('include/menu_top.inc'); 

					?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#f6f5ed" align="center" valign="top">
					<table border="0" cellpadding="2" cellspacing="2" width="860">
						<tr>
<!-- Partie centrale -->
							<td valign="top" width="900">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
									<tr>
										<td width="80">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
												<tr>
													<td align="center">
														<a href="ressources_media.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo general("text5") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td>

										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center">
								<table width="400" cellpadding="5">
									<tr>
										<td>
											<span class="texte_default"><?php echo general("text10")//oui ?></span>
										</td>
										<td>
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
												<tr>
													<td align="center">
														<a href="commentaire_supprimer_oui.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idcommentaire=<?php echo $idcommentaire ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo general("text11")//oui ?></span></a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center">
								<table width="400" cellpadding="5">
									<tr>
										<td colspan="2">
											<?php affichage_commentaire($idcommentaire) ?>

										</td>
									</tr>
								</table>
							</td>
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
					<!-- Module d'affichage du dernier media publi�  -->
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