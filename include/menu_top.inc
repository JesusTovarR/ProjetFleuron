

					<table border="0" cellpadding="0" cellspacing="0" width="900">
						<tr>

							<td align="center" valign="middle"><a href="index.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("home") //Accueil ?></span></a></td>
							<td align="center" valign="middle"><a href="conseils.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("tips")// Conseils ?></span></a></td>
							<td align="center" valign="middle"><a href="ressources.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("resources")// Ressources multimedia ?></span></a></td>
							<td align="center" valign="middle"><a href="liens.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("links")// Liens utiles ?></span></a></td>
							<?php if ($_SESSION['niveau']>0) { ?>
								<td align="center" valign="middle"><a href="profil.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("profile")// Profil ?></span></a></td>
							<?php } else {  ?>
								<td align="center" valign="middle"><a href="inscription.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("signin")// S'inscrire ?></span></a></td>
							<?php } ?>
							<td align="center" valign="middle"><a href="contact.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("contact")// Contact ?></span></a></td>


							<?php if ($_SESSION['niveau']>20) { ?>
								<td align="center" valign="middle">
											<ul class="nav">
												<!-- Option dans le menu pour le module traducteur -->
												<li><span class="texte_menu">Traduction</span>
													<ul>
														<li>
															<?php if ($_SESSION['niveau']>=20&&$_SESSION['niveau']<50) { ?>
																<a href="traducteur.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("translator")// Traducteur ?></span></a>
															<?php } else { ?>
															<?php } ?>
														</li>
														<li>
															<?php if ($_SESSION['niveau']>=30 && $_SESSION['niveau']<50) { ?>
																<a href="referent.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("referrer")// referrer ?></span></a>
															<?php } else { ?>
															<?php } ?>
														</li>
														<li>
															<?php if ($_SESSION['niveau']>=50) { ?>
																<a href="admin_referent.php"><span class="texte_menu"><?php echo "Admin";//affichage_menu("referrer") referrer ?></span></a>
															<?php } else { ?>
															<?php } ?>
														</li>
													</ul>
												</li>
											</ul>
								</td>
							<?php } else { ?>
							<?php } ?>

							<?php if ($_SESSION['niveau']>0) { ?>
								<td align="center" valign="middle"><a href="deconnexion.php?lg=<?php echo $lg; ?>"><span class="texte_menu"><?php echo affichage_menu("logout")// d�connexion ?></span></a></td>
							<?php } else { ?>
							<?php } ?>
						</tr>
					</table>