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
													/*if(!isset($_SESSION['id_profil'])){
														$_SESSION['id_profil'] = $_POST['id_profil'];

													}*/
													$_SESSION['nb']=$_POST['nb'];
															$id_profil = $_SESSION['id_profil'.$_SESSION['nb']];
													$req = "SELECT * FROM profil WHERE id = $id_profil";
													$res = mysql_query($req);
													
													while($resultat = mysql_fetch_assoc($res)){
														
																	$name = $resultat['prenom'];
											?>

																	<span class="titre"> Traductions de <?php echo $name; //Nom du profil ?></span><!--Cambiar-->
													<?php				
													}

											?>
											
										</td>
									</tr>
								</table>
<br>
<span class="texte_default"><?php echo page_traducteur("message");//Choisir une catégorie ?></span>
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
													<td align="center">
														<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="200" height="60">
															<tr>
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie1")//Cambiar ?></span></td>
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie2")//Cambiar ?></span></td>
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
																<td align="center"><span class="texte_info12"> <?php echo page_traducteur("categorie3")//Cambiar ?></span></td> <!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie4")//Cambiar ?></span></td> <!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie5")//Cambiar ?></span></td> <!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie6")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie7")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie8")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie9")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie10")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie11")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie12")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie13")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie14")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie15")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie16")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie17")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie18")//Cambiar ?></span></td><!--Cambiar-->
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
																<td align="center"><span class="texte_info12"><?php echo page_traducteur("categorie19")//Cambiar ?></span></td><!--Cambiar-->
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
				<p>				
					
					<?php
						include('include/traitementtexte.inc');
						//$id = $_POST['id_profil'];
						//$req = "SELECT * FROM profil WHERE id = $id";
						//$resultat = mysql_query($req);
						

						if(isset($_GET['categorie'])){

							
								if($_GET['categorie'] == 1 ){

									$req_accueil = "SELECT * FROM accueil_contenu WHERE id_user =  ".$_SESSION["id_profil".$_SESSION["nb"]];
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
									

									
								}/*elseif($_GET['categorie'] == 2){

									$req_accueil = "SELECT * FROM conseils WHERE id_user =  $id_profil";
									$res1 = mysql_query($req_accueil);
									$num_row = mysql_num_rows($res1);

									while($data = mysql_fetch_assoc($res1)){

										$content = $data['line55'];
										$lg = $data['code'];
										echo $lg;
										//$req2 = "SELECT * FROM langues WHERE code = $lg";
										//$res2 = mysql_query($req2);
										//var_dump($res2);
										
										//$langue = $data2['nom'];

										//echo $langue;
										echo "<textarea cols='80' rows='3'> $content </textarea><br>";
									}
									
								}elseif($_GET['categorie'] == 3){
									$req_accueil = "SELECT * FROM contact_contenu WHERE id_user =  $id_profil";
									$res1 = mysql_query($req_accueil);
									$num_row = mysql_num_rows($res1);

									while($data = mysql_fetch_assoc($res1)){

										$content = $data['content'];
										$lg = $data['code'];
										echo $lg;
										//$req2 = "SELECT * FROM langues WHERE code = $lg";
										//$res2 = mysql_query($req2);
										//var_dump($res2);
										
										//$langue = $data2['nom'];

										//echo $langue;
										echo "<textarea cols='90' rows='15'> $content </textarea><br>";
									}
									
								}*/else{

									echo"Pas de traduction effectué dans cette catégorie";
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