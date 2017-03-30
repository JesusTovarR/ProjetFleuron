<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



/*if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}*/


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
				<td bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" height="40" align="center">
					<?php 
						// Menu Sup�rieur 
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
								<table width="70%" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(2); //couleur claire ?>" width="220">
								<tr>
									<td  ><a class="titre" href="demande_referent.php">Retour</a></td>
									
										<td align="center" height="30">

											<?php
													if(!isset($_SESSION['id_profil'])){
														$_SESSION['id_profil'] = $_POST['id_profil'];

													}

													$id_profil = $_SESSION['id_profil'];

													$req = "SELECT * FROM profil WHERE id = $id_profil";
													$res = mysql_query($req);
													
													while($resultat = mysql_fetch_assoc($res)){
														
																	$name = $resultat['prenom'];
											?>

																	<span class="titre"> Traductions de <?php echo $name; //Nom du profil ?></span>
													<?php				
													}

											?>
											
										</td>
									</tr>
								</table>
<br>
<span class="texte_default"><?php echo versionlinguistique(36); //Choisir une cat�gorie ?></span>
<br>
<div align="right">
</div>



<div>

</div>
				<p>
					<table border="0" cellspacing="0">
					<tr>
					<td>
					<table border="0" cellspacing="0">
									<tr>
										<td>
											<table border="0" cellspacing="0">
												<tr>
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><a href="?categorie=1"><span class="texte_info12"><?php echo affichage_menu("home")//Cambiar ?></span></a></td>
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
																<td align="center"><a href="?categorie=2"><span class="texte_info12"><?php echo affichage_menu("tips")//Cambiar ?></span></a></td>
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
																<td align="center"><a href="?categorie=3"><span class="texte_info12"> Contacto</span></a></td> <!--Cambiar-->
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
																<td align="center"><a href="?categorie=4"><span class="texte_info12">Menu</span></a></td> <!--Cambiar-->
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
																<td align="center"><a href="?categorie=5"><span class="texte_info12">Choix Langue</span></a></td> <!--Cambiar-->
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
																<td align="center"><a href="?categorie=6"><span class="texte_info12">Conseils</span></a></td><!--Cambiar-->
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
																<td align="center"><a href="?categorie=7"><span class="texte_info12">Dernier_media</span></a></td><!--Cambiar-->
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
																<td align="center"><a href="?categorie=8"><span class="texte_info12">Login</span></a></td><!--Cambiar-->
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
																<td align="center"><a href="?categorie=9"><span class="texte_info12">Menu_admin</span></a></td><!--Cambiar-->
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
																<td align="center"><a href="?categorie=10"><span class="texte_info12">Moteur_de_recherche</span></a></td><!--Cambiar-->
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
																<td align="center"><a href="?categorie=11"><span class="texte_info12">Tableau_du_bord</span></a></td><!--Cambiar-->
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
																<td align="center"><a href="?categorie=12"><span class="texte_info12">Affichage_ressource</span></a></td><!--Cambiar-->
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
                                                                <td align="center"><a href="?categorie=13"><span class="texte_info12">Content</span></a></td><!--Cambiar-->
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
																<td align="center"><a href="?categorie=14"><span class="texte_info12">Page_edit</span></a></td><!--Cambiar-->
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
                                                                <td align="center"><a href="?categorie=15"><span class="texte_info12">Ressources</span></a></td><!--Cambiar-->
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
									</tr>
									

			
        
								</table>
								</td>
								
								<tr>
									<td>
										

																			
				<p>				
					
					<?php
						include('include/traitementtexte.inc');
						//$id = $_POST['id_profil'];
						//$req = "SELECT * FROM profil WHERE id = $id";
						//$resultat = mysql_query($req);
						
						

						if(isset($_GET['categorie'])){

							if($_GET['categorie'] == 1 ){

								$req_accueil = "SELECT * FROM accueil_contenu WHERE id_user =  $id_profil";
								$res1 = mysql_query($req_accueil);
								$num_row = mysql_num_rows($res1);
									//var_dump($res1);
								while($data = mysql_fetch_assoc($res1)){

									$content = $data['content'];
									$lg = $data['code'];
									echo $lg;
									//$req2 = "SELECT * FROM langues WHERE code = $lg";
									//$res2 = mysql_query($req2);
									//var_dump($res2);
									
									//$langue = $data2['nom'];

									//echo $langue;
									echo "<textarea cols='110' rows='25'> $content </textarea><br>";
								}
								

								
							}else{

								echo"Pas de traduction effectué dans cette catégorie";
							}


							if($_GET['categorie'] == 1 ){

								$req_accueil = "SELECT * FROM conseils_contenu WHERE id_user =  $id_profil";
								$res1 = mysql_query($req_accueil);
								$num_row = mysql_num_rows($res1);
							}
						}
						

						?>

						</p>

								</td>
								</tr>	
								</tr>
								</table>

				</p>



							</td>
			
<!-- Fin partie centrale -->
<!-- Colonne de droite -->
							
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