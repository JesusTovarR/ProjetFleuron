<?php

if (isset($_GET["id"])) {
	$id=$_GET["id"];
} else {
	$id=0;
}

if (isset($_GET["idressource"])) {
	$idressource=$_GET["idressource"];
} else {
	$idressource=0;
}

if (isset($_GET["categorie"])) {
	$categorie=$_GET["categorie"];
} else {
	$categorie=0;
}




?>
							<form name="FormName" action="change_langue.php" method="post">
											
											<p>
											<table border="0" cellpadding="5" cellspacing="2" bgcolor="<?php echo couleur(2); // couleur claire ?>" width="220">
												<tr>
													<td colspan="2" align="center">
														<center>
															<select name="lg" size="1">
<?php
			$requete='SELECT * FROM lg WHERE online=1 ORDER BY nom';
			$recuplg = mysql_query($requete);
				while ($choixlg = mysql_fetch_assoc($recuplg))
					{
						if ($lg==$choixlg['code'])
							{
								echo '<option value="'.$choixlg['code'].'" selected>'.$choixlg['nom'];
							} else {
								echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];
							}
					}

?>

															</select></center>
													</td>
												</tr>
												<tr>
													<td colspan="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>">
														<center>
															<span class="texte_menu"><input type="submit" value="<?php echo choix_langue()// Choisir cette langue ?>" name="submitButtonName"></span></center>
													</td>
												</tr>
											</table>
											</p>		
<input type="hidden" value="<?php echo $pageencours; ?>" name="pageencours">
<input type="hidden" value="<?php echo $id; ?>" name="id">
<input type="hidden" value="<?php echo $idressource; ?>" name="idressource">
<input type="hidden" value="<?php echo $categorie; ?>" name="categorie">
											</form>