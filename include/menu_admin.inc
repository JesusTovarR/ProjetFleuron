<?php 
if ($_SESSION['niveau']>=50){ // Affichage menu Administration ?>

<?php 

//**********************************
// 	Nombre de commentaires des utilisateurs - $nbcommentaires
//**********************************
$nbcommentaires = 0;
$requete = 'SELECT COUNT(id) AS total FROM commentaires';
$recup = mysql_query($requete);
$nbcommentaires_array = mysql_fetch_assoc($recup);
$nbcommentaires = $nbcommentaires_array['total'];

//**********************************
// 	Nombre de profils utilisateurs - $nbprofils
//**********************************
$nbprofils = 0;
$requete = 'SELECT COUNT(id) AS total FROM profil WHERE niveau<50';
$recup = mysql_query($requete);
$nbprofils_array = mysql_fetch_assoc($recup);
$nbprofils = $nbprofils_array['total'];

//**********************************
// 	Nombre de langues d'utilisation
//**********************************
$nblg = 0;
$requete = 'SELECT COUNT(id) AS total FROM lg';
$recup = mysql_query($requete);
$nblg_array = mysql_fetch_assoc($recup);
$nblg = $nblg_array['total'];

//**********************************
// 	Nombre de Versions linguistiques
//**********************************
$nbversionlinguistique = 0;
$requete = 'SELECT COUNT(id) AS total FROM versionlinguistique';
$recup = mysql_query($requete);
$nbversionlinguistique_array = mysql_fetch_assoc($recup);
$nbversionlinguistique = $nbversionlinguistique_array['total'];
?>

<span class="Texte_defaultGras">Admin :</span>
								<table border="0" cellpadding="0" cellspacing="2">
									<tr>
										<td>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
												<tr>
													<td colspan="2"><a href="profils.php?lg=<?php echo $lg ?>"><span class="texte_info12"><?php echo menu_administrateur('profiles') //Profiles ?> (<?php echo $nbprofils ?>)</span></a></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
												<tr>
													<td colspan="2"><a href="versionlinguistique.php?lg=<?php echo $lg ?>" ><span class="texte_info12"><?php echo menu_administrateur('versions') //Versions linguistiques ?> (<?php echo $nbversionlinguistique ?>)</span></a></td>
												</tr>
											</table>
										</td>

									</tr>
									<tr>
										<td>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
												<tr>
													<td colspan="2"><a href="commentaires_tous_list.php?lg=<?php echo $lg ?>"><span class="texte_info12"><?php echo menu_administrateur('total_comments') //Total des commentaires ?> (<?php echo $nbcommentaires ?>)</span></a></td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
												<tr>
													<td colspan="2"><a href="couleurs.php?lg=<?php echo $lg ?>"><span class="texte_info12"><?php echo menu_administrateur('color') //Couleurs ?></span></a></td>
												</tr>
											</table>
										</td>
									</tr>
<?php if ($_SESSION['niveau']>=50) { ?>
									<tr>
										<td>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
												<tr>
													<td colspan="2"><a href="langueutilisation.php?lg=<?php echo $lg ?>"><span class="texte_info12"><?php echo menu_administrateur('use_languages') //Langues d'utilisation ?> (<?php echo $nblg ?>)</span></a></td>
												</tr>
											</table>
										</td>
									</tr>
<?php } ?>
<?php if ($_SESSION['niveau']>=50) { ?>
									<tr>
										<td>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
												<tr>
													<td colspan="2"><a href="statistiques.php?lg=<?php echo $lg ?>"><span class="texte_info12"><?php echo menu_administrateur('statistics') //Statistiques ?></span></a></td>
												</tr>
											</table>
										</td>
									</tr>
<?php } ?>

								</table>



<?php } ?>