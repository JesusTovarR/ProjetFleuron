<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

if (! isset($_SESSION['niveau'])) {
	$_SESSION['niveau']=0;
}

if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite à l'action d'édition de la page
}

if (isset($_GET["action2"])) {
	$action2=$_GET["action2"]; // Variable permettant l'affichage de message suite à l'action d'édition de la page
}


//**********************************
// Affichage des liens
//**********************************
function affichage_lien()
	{

		global $lg,$pageencours; // récupération variable langue
		$requete = 'SELECT * FROM liencategories ORDER BY refVL';
		$recup = mysql_query($requete);
			while ($data = mysql_fetch_assoc($recup))
				{
					echo '<table><tr><td><span class="Texte_default">'.$data[$lg].' :</span></td>';
if ($_SESSION['niveau']>5) { // Affichage Bouton ajouter un lien
										echo '<td><table border="0" cellpadding="6" cellspacing="2" bgcolor="'.couleur(1).'">';
											echo '<tr>';
												echo '<td colspan="2"><a href="liens_categorie_edit.php?lg='.$lg.'&id='.$data['id'].'&page='.$pageencours.'"><span class="texte_info12">'.versionlinguistique(47).'</span></a></td>'; // Editer
											echo '</tr>';
										echo '</table></td></tr></table>';
}
					echo '<br>';

					$requete = 'SELECT * FROM liens WHERE liencategories='.$data['id'].' AND aff=1';
					$recup2 = mysql_query($requete);
						while ($data2 = mysql_fetch_assoc($recup2))
							{

							echo '<table border="0" cellpadding="0" cellspacing="2" width="100%">';
								echo '<tr>';
									echo '<td>';
										echo '<table border="0" cellpadding="6" cellspacing="2" bgcolor="'.couleur(1).'">';
											echo '<tr>';
												echo '<td colspan="2"><a href="'.$data2['lien'].'" target="_blank"><span class="texte_info12">'.$data2['nom'].'</span></a></td>';
											echo '</tr>';
										echo '</table>';
									echo '</td>';
							if ($_SESSION['niveau']>5) {
									echo '<td width="100">';
										echo '<table border="0" cellpadding="6" cellspacing="2" bgcolor="'.couleur(1).'">';
											echo '<tr>';
												echo '<td colspan="2"><a href="liens_modifier.php?lg='.$lg.'&id='.$data2['id'].'&page='.$pageencours.'"><span class="texte_info12">'.versionlinguistique(47).'</span></a></td>'; // Editer
											echo '</tr>';
										echo '</table>';
									echo '</td>';
									echo '<td width="100">';
										echo '<table border="0" cellpadding="6" cellspacing="2" bgcolor="'.couleur(1).'">';
											echo '<tr>';
												echo '<td colspan="2"><a href="liens_supprimer.php?lg='.$lg.'&id='.$data2['id'].'&page='.$pageencours.'"><span class="texte_info12">'.versionlinguistique(48).'</span></a></td>'; // Supprimer
											echo '</tr>';
										echo '</table>';
									echo '</td>';
							}
								echo '</tr>';
							echo '</table><br>';

						//echo $data2[$lg];

							}
				}
	}
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
								<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(2); //couleur claire ?>" width="220">
									<tr>
										<td align="center" height="30">
											<span class="titre"><?php echo versionlinguistique(27); //Liens utiles ?></span>
										</td>
									</tr>
								</table>

<br>
<?php if (isset($_GET["action"])) { ?>
<p><div align="center"><span class="message"><?php echo versionlinguistique(34); // Lien modifié ?></span></div>
<?php } ?>
<?php if (isset($_GET["action2"])) { ?>
<p><div align="center"><span class="message"><?php echo versionlinguistique(33); // Lien supprimé ?></span></div>
<?php } ?>
<br>
<div align="right">
<?php if ($_SESSION['niveau']>5) { // Affichage Bouton ajouter une catégorie ?>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
												<tr>
													<td align="center"><a href="liens_categorie_ajouter.php?lg=<?php echo $lg ?>&id=1&page=<?php echo $pageencours ?>"><span class="texte_info12"><?php echo versionlinguistique(43) //Ajouter une catégorie ?></span></a></td>
												</tr>
											</table><br>
<?php } ?>
<?php if ($_SESSION['niveau']>5) { // Affichage Bouton ajouter un lien ?>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
												<tr>
													<td align="center"><a href="liens_ajouter.php?lg=<?php echo $lg ?>&id=1&page=<?php echo $pageencours ?>"><span class="texte_info12"><?php echo versionlinguistique(49) //Ajouter un lien ?></span></a></td>
												</tr>
											</table>
<?php } ?>
</div>

				<p>
					<?php affichage_lien() ?>
				</p>
<div align="right">
<?php if ($_SESSION['niveau']>5) { // Affichage Bouton édition page ?>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
												<tr>
													<td align="center"><a href="liens_ajouter.php?lg=<?php echo $lg ?>&id=1&page=<?php echo $pageencours ?>"><span class="texte_info12"><?php echo versionlinguistique(49) //Ajouter un lien ?></span></a></td>
												</tr>
											</table>
<?php } ?>


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