<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique, variable session)






?>

<html>

	<head>

<?php include('include/head.inc');  ?>
<?php include('include/alexandria.inc');  ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>

	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="white">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
			<tr height="67">
				<td align="center" valign="middle" bgcolor="<?php echo couleur(2); // couleur clair ?>" height="67">
<!-- Module affichage du bandeau contenant le logo FLEURON -->
<?php include('include/logo_fleuron.inc');  ?>
				</td>
			</tr>
			<tr height="40">
				<td bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" height="40" align="center">
<?php 

		// Menu des visiteurs non inscrits 
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
								<table width="100%" border="0">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="profils.php?lg=<?php echo $lg ?>&id=<?php echo $id ?>&niveau=<?php echo $niveau ?>"><span class="texte_menu"><?php echo general("text5") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="titre_admin"><?php echo new_versionlinguistique("text55") //profils ?></span>
										</td>
										<td width="150" align="center">
											<span class="titre_admin"><?php echo general("text6") //Ajouter ?></span>
										</td>
									</tr>
								</table>


<br>
								<center>

									<p><span class="texte_default">
		<form name="FormName" action="profils_ajouter_enre.php" method="post">
									<table border="0" cellpadding="10" cellspacing="2">
										<tr>
											<td><span class="texte_default"><?php echo new_versionlinguistique("text8"); //Utilisateur ?> :</span></td>
											<td><input type="text" name="utilisateur" size="24" value=""></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo new_versionlinguistique("text9"); //Mot de passe ?> :</span></td>
											<td><input type="text" name="motdepasse" size="24" value=""></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo new_versionlinguistique("text18"); //Nom ?> :</span></td>
											<td><input type="text" name="nom" size="24" value=""></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo new_versionlinguistique("text19"); //Pr�nom ?> :</span></td>
											<td><input type="text" name="prenom" size="24" value=""></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo new_versionlinguistique("text20"); //E-mail ?> :</span></td>
											<td><input type="text" name="email" size="24" value=""></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo new_versionlinguistique("text21"); //Pays ?> :</span></td>
											<td>
												<select name="pays" size="1">
<?php
	// Affichage de la liste des pays

			$requete='SELECT * FROM pays ORDER BY nom';
			$recuplg = mysql_query($requete);
				while ($choixlg = mysql_fetch_assoc($recuplg))
					{


							echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];


					}

?>
												</select></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo new_versionlinguistique("text22"); //Langue � utiliser dans Fleuron ?> :</span></td>
											<td><select name="langue" size="1">
<?php
	// Affichage de la liste des langues disponibles

			$requete='SELECT * FROM lg ORDER BY nom';
			$recuplg = mysql_query($requete);
				while ($choixlg = mysql_fetch_assoc($recuplg))
					{

								echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];

					}

?>
												</select></td>
										</tr>
										<tr>
											<td>
												<span class="texte_default"><?php echo new_versionlinguistique("text62"); //Niveau ?> :</span>
											</td>
											<td>
		<select name="niveau" size="1">
			<?php echo '<option value="1">'.new_versionlinguistique("text8"); ?>

			<?php echo '<option value="5">'.new_versionlinguistique("text63"); ?>

			<?php echo '<option value="10" >'.new_versionlinguistique("text64"); ?>

		</select>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<center>
													<input type="submit" value="<?php echo content("btn2") //S'inscrire ?>" name="submitButtonName"></center>
											</td>
										</tr>
									</table>
		<input type="hidden" value="<?php echo $id ?>" name="id">
		<input type="hidden" value="<?php echo $lg ?>" name="lg">
									</form></span></center>
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
<!-- Module d'affichage du dernier media publi�  -->
<?php include('include/derniermedia.inc');  ?>
										</td>
									</tr>
									<tr>
										<td align="right">
<!-- Module d'affichage menu admin  -->
<?php include('include/menu_admin.inc');  ?>
												
										</td>
									</tr>
<?php if ($_SESSION['niveau']>0) { // Affichage Favoris/Notes/Commentaires ?>
									<tr>
										<td align="center">
<!-- Module d'affichage menu admin  -->
<?php include('include/menu_FavorisNotesComm.inc');  ?>
												
										</td>
									</tr>
<?php } ?>
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