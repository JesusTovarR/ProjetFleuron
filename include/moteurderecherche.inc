<?php
	if ((! isset($motcle))) {
		$mot=moteur("word");// mot-clé
	} else {
		$mot=$motcle;
	}
?>

											<form name="FormName" action="moteurderecherche_tmp.php" method="post">
											
											<p>
											<table border="0" cellpadding="5" cellspacing="2" bgcolor="<?php echo couleur(2); // couleur clair ?>" width="220">
												<tr>
													<td colspan="2" align="center">
														<span class="Texte_menu"><?php echo moteur("title") //Concordancier ?></span>
													</td>
												</tr>
												<tr>
													<td colspan="2" align="center">
														<center>
															<input type="text" name="motcle" size="24" value="<?php echo $mot //Mot clé ?>" onFocus="javascript:this.value=''"></center>
													</td>
												</tr>
												<tr>
													<td colspan="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>">
														<center>
														<button id="buton1" class="stbutton" ><?php echo moteur("button") //Rechercher ?></button></center>
													</td>
												</tr>
											</table>
											</p>
											<p>
<input type="hidden" value="<?php echo $lg ?>" name="lg">
											</form>