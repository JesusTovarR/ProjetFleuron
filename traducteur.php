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
											<span class="titre"><?php echo page_traducteur("title"); //Ressources multimedias ?></span>
										</td>
									</tr>
								</table>
<br>
<span class="texte_default"><?php echo page_traducteur("message");//Choisir une catégorie ?></span>
<br>
<div align="right">
</div>

				<p>
					<!-- sections du site pour traduire-->
					<table border="0" cellspacing="0">
									<tr>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="traducteur_choix_langue.php?categorie=1"><span class="texte_info12"><?php echo page_traducteur("categorie1")//Cambiar ?></span></a></td>
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=2"><span class="texte_info12"><?php echo page_traducteur("categorie2")//Cambiar ?></span></a></td>
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=3"><span class="texte_info12"> <?php echo page_traducteur("categorie3")//Cambiar ?></span></a></td> <!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=4"><span class="texte_info12"><?php echo page_traducteur("categorie4")//Cambiar ?></span></a></td> <!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=5"><span class="texte_info12"><?php echo page_traducteur("categorie5")//Cambiar ?></span></a></td> <!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=6"><span class="texte_info12"><?php echo page_traducteur("categorie6")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=7"><span class="texte_info12"><?php echo page_traducteur("categorie7")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=8"><span class="texte_info12"><?php echo page_traducteur("categorie8")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=9"><span class="texte_info12"><?php echo page_traducteur("categorie9")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=10"><span class="texte_info12"><?php echo page_traducteur("categorie10")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=11"><span class="texte_info12"><?php echo page_traducteur("categorie11")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=12"><span class="texte_info12"><?php echo page_traducteur("categorie12")//Cambiar ?></span></a></td><!--Cambiar-->
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
                                                                <td align="center"><a href="traducteur_choix_langue.php?categorie=13"><span class="texte_info12"><?php echo page_traducteur("categorie13")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=14"><span class="texte_info12"><?php echo page_traducteur("categorie14")//Cambiar ?></span></a></td><!--Cambiar-->
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
                                                                <td align="center"><a href="traducteur_choix_langue.php?categorie=15&type=1"><span class="texte_info12"><?php echo page_traducteur("categorie15")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_ressources.php"><span class="texte_info12"><?php echo page_traducteur("categorie16")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_soustitres.php"><span class="texte_info12"><?php echo page_traducteur("categorie17")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=17"><span class="texte_info12"><?php echo page_traducteur("categorie18")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=18"><span class="texte_info12"><?php echo page_traducteur("categorie19")//Cambiar ?></span></a></td><!--Cambiar-->
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
																<td align="center"><a href="traducteur_choix_langue.php?categorie=19"><span class="texte_info12"><?php echo page_traducteur("categorie19")//Cambiar ?> 2</span></a></td><!--Cambiar-->
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