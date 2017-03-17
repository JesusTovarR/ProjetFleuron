											<form name="FormName" action="connect.php" method="post">
											
											<p>
											<table border="0" cellpadding="5" cellspacing="0" bgcolor="<?php echo couleur(2); // couleur claire ?>" width="220">
												<tr>
													<td><span class="texte_info"><span class="texte_info10"><nobr><?php echo login("label1") //Utilisateur ?> :</nobr></span></span></td>
													<td><input type="text" name="utilisateur" size="12"></td>
												</tr>
												<tr>
													<td><span class="texte_info"><span class="texte_info10"><?php echo login("label2") //Mot de passe ?> :</span></span></td>
													<td><input type="password" name="motdepasse" size="12"></td>
												</tr>
												<tr>
													<td colspan="2" align="center" bgcolor="<?php echo couleur(1); //couleur foncée ?>">
														<center>
															<input type="submit" value="<?php echo login("button") //Connexion ?>" name="submitButtonName">
															<br><a href="recuplogin.php?lg=<?php echo $lg ?>"><span class="texte_info10"><?php echo login("message") //Cliquez ici si vous avez oublié vos identifiants ? ?></span></a>
														</center>
													</td>
												</tr>
											</table>

											<input type="hidden" value="<?php echo $lg; ?>" name="lg">
											<input type="hidden" value="<?php echo $pageencours; ?>" name="pageencours">
											</form>