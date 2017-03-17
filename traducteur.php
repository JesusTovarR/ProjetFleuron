<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite à l'action d'édition de la page
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
											<span class="titre"><?php echo versionlinguistique(147); //Ressources multimedias ?></span>
										</td>
									</tr>
								</table>
<br>
<span class="texte_default"><?php echo versionlinguistique(36); //Choisir une catégorie ?></span>
<br>
<div align="right">
</div>

				<p>
					<table border="0" cellspacing="0">
									<tr>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=1"><span class="texte_info12"><?php echo affichage_menu("home")//Cambiar ?></span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=2"><span class="texte_info12"><?php echo affichage_menu("tips")//Cambiar ?></span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=3"><span class="texte_info12"><?php echo affichage_menu("contact") //Cambiar?></span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=4"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=5"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=6"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=7"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=8"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=9"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=10"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=11"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=12"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categoria=13"><span class="texte_info12">Hola</span></a></td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>

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