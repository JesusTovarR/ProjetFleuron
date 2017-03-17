<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


function ajouter_versionlinguistique()
	{
		global $lg;
		echo '<form name="FormName" action="glossaire_ajouter_enre.php" method="post">';
		echo '<table border="0">';
					echo '<tr>';
						echo '<td><span class="texte_defaultgras">'.versionlinguistique(134).' :</span></td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td><input type="text" name="item" size="80" value=""></td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td align="30">&nbsp;</td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td><span class="texte_defaultgras">'.versionlinguistique(69).' :</span></td>';
					echo '</tr>';
			$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
				while ($donneeslg = mysql_fetch_assoc($recuplg))
					{

					echo '<tr>';
						echo '<td width="50">';
								echo $donneeslg['nom'];	// Affichage de la version linguistique du mot
						echo '</td>';
					echo '</tr>';

					echo '<tr>';
						echo '<td><textarea name="description_'.$donneeslg['code'].'" cols="60" rows="4"></textarea></td>';
					echo '</tr>';
					echo '<tr>';
						echo '<td align="center" >';
							echo '<input type="submit" value="'.versionlinguistique(24).'" name="submitButtonName">'; // Enregistrer
						echo '</td>';

					echo '</tr>';
					echo '<tr>';
						echo '<td width="100" height="30">';
							echo '&nbsp;'; 
						echo '</td>';
					echo '</tr>';
					}


		echo '</table>';
		echo '<input type="hidden" value="'.$lg.'" name="lg">';
		echo '</form>';
		echo '<br><br>';
	}
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
				<td align="center" valign="middle" bgcolor="<?php echo couleur(2); // couleur claire ?>" height="67">
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
					<table border="0" cellpadding="10" cellspacing="2" width="850">
						<tr>

							<td valign="top">
								<table width="100%" border="0">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="glossaire.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //REtour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="titre_admin"><?php echo versionlinguistique(133) //Glossaire ?></span>
										</td>
										<td width="150" align="center">
											<span class="titre_admin"><?php echo versionlinguistique(51) //Ajouter?></span>
										</td>
									</tr>
								</table>
<center>
<br><br><br>
	<table border="0" cellpadding="0" cellspacing="5" width="600">

		<?php ajouter_versionlinguistique(); ?>
	</table>
</center>




							</td>

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