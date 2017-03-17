<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


if (isset($_GET["action"])) {
	$action=$_GET["action"];
}


if (isset($_GET["idprofil"])) {
	$idprofil=$_GET["idprofil"];
}



if (isset($_GET["page"])) {
	$page=$_GET["page"];
}



//**********************************
// Vérification des commentaires de l'utiliateur
//**********************************
	$nbfavoris=0;
	$requete = 'SELECT COUNT(id) AS total FROM commentaires WHERE profil='.$_SESSION['id'];
	$recup = mysql_query($requete);
	$data = mysql_fetch_assoc($recup);

if ($data['total']>0) {

} else {
header('Location: ressources.php?lg='.$lg.'&action2=ok&categorie='.$categorie.'&idprofil='.$idprofil); // redirection
}

//**********************************
// Affichage des commentaires
//**********************************
function affichage()
	{

		global $lg,$categorie,$idprofil,$pageencours; // récupération variable langue
		$nb=0;
			echo '<table border="0" cellspacing="5" >';

			$requete = 'SELECT * FROM commentaires WHERE profil='.$idprofil.' ORDER BY jour DESC';
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
					{

						$commentaire=$data['commentaire'];

						affichage_ressource($data['ressource'],$commentaire,$pageencours);
					}
			echo '</table>';
	}

include('include/affichage_ressource_commentaires.inc'); // affichage des ressources dans une liste
?>

<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<?php include('include/alexandria.inc');  // dictionnaire alexandria ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>

	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="white">
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
					<table border="0" cellpadding="10" cellspacing="2" width="900">
						<tr>
<!-- Partie centrale -->
							<td valign="top">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
									<tr>
										<td width="100">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="100">
												<tr>
													<td align="center">
														<a href="ressources.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center" bgcolor="<?php echo couleur(2) ?>">
											<span class="titre"><?php echo versionlinguistique(83); //Commentaires ?></span>
										</td>
									</tr>
								</table>
								<br>
								<p>
									<?php affichage() // affichage ressources favoris?>

								</p>
							</td>
<!-- Fin partie centrale -->
<!-- Colonne de droite -->
							<td width="250" align="right" valign="top">
								<table border="0" cellpadding="5" cellspacing="2">
	<?php if ($_SESSION['niveau']<1) { ?>
									<tr>
										<td align="right">
<!-- Module d'affichage des choix des langues disponibles - table LG -->
<?php include('include/choix_langue.inc');  ?>
											</td>
									</tr>
				<?php } ?>
	<?php if ($_SESSION['niveau']<1) { ?>
									<tr>
										<td align="right">
<!-- Module d'affichage du formulaire de connexion -->
<?php include('include/login.inc');  ?>
											</td>
									</tr>
				<?php } ?>
									<tr>
										<td align="right">
<!-- Module d'affichage du formulaire de recherche  -->
<?php include('include/moteurderecherche.inc');  ?>
											</td>
									</tr>
									<tr>
										<td align="right">
<!-- Module d'affichage du dernier media publié  -->
<?php include('include/derniermedia.inc');  ?>
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
