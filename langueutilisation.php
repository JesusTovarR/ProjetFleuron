<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



//$idvl=$_GET["id"];


function affichageversionlinguistique()
	{
		global $lg,$action,$action2,$idvl; // récupération variables de connexion


			$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
				while ($data = mysql_fetch_assoc($recuplg))
					{
					if ($data['online']==1) {
						$couleurzone = "#E5E4DF";
					} else {
						$couleurzone = "#696969";
					}

					echo '<tr>';
						echo '<td width="300" align="center" valign="top">';
							echo '<table bgcolor="'.$couleurzone.'">';
								echo '<tr>';
									echo '<td width="300" align="center" valign="middle" >';
										echo '<span class="Texte_default">'.$data['nom'].' - '.$data['code'].'</span>';
									echo '</td>';
									echo '<td width="300" align="center" valign="top">';

											echo '<table>';
												echo '<tr>';
													echo '<td>';
														echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100">';
															echo '<tr>';
															if ($data['online']==1) {
																$textebouton = "Offline";
																$flag = 0;
															} else {
																$textebouton = "Online";
																$flag = 1;
															}
																echo '<td align="center"><a href="langueutilisation_onoffline.php?lg='.$lg.'&id='.$data['id'].'&flag='.$flag.'"><span class="texte_info12">'.$textebouton.'</span></a></td>';
															echo '</tr>';
														echo '</table>';
													echo '</td>';
													echo '<td>';
														echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100">';
															echo '<tr>';
																echo '<td align="center"><a href="langueutilisation_edit.php?lg='.$lg.'&id='.$data['id'].'"><span class="texte_info12">'.content("line205_216").'</span></a></td>';
															echo '</tr>';
														echo '</table>';
													echo '</td>';
													echo '<td>';
														echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100">';
															echo '<tr>';
																echo '<td align="center"><a href="langueutilisation_supprimer.php?lg='.$lg.'&id='.$data['id'].'"<span class="texte_info12">'.afficher_ressource("option2").'</span></a></td>'; // supprimer
															echo '</tr>';
														echo '</table>';
													echo '</td>';
												echo '</tr>';
											echo '</table>';



									echo '</td>';

								echo '</tr>';
							echo '</table>';

						echo '</td>';

					echo '</tr>';
			}
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
				<td bgcolor="<?php echo couleur(1); //couleur foncée ?>" height="40" align="center">
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
								<center><span class="titre_admin"><?php echo general("text13")//Langues d'utilisation ?></center>
									<br><div align="right">
									<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
										<tr>
											<td align="center">
												<a href="langueutilisation_ajouter.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo general("text6") //Ajouter ?></span></a>
											</td>
										</tr>
									</table>
									</div>

<center>

	<table border="0" cellpadding="0" cellspacing="5" width="600">

		<?php affichageversionlinguistique(); ?>

	</table>
</center>
	<br><br><span class="texte_default">Pages à traduire :
		<ul>
			<p>_ Accueil</p>
			<p>_ Qu'est ce que Fleuron ?</p>
			<p>_ Contact</p>
		</ul>
		<p>Eléments à traduire :</p>
		<ul>
			<p>_ Les catégories dans "Ressources multimedia"</p>
			<p>_ Versions linguistiques</p>
			<p>_ Les catégories dans "Liens utiles"</p>
			<p>_ Glossaire</p>
		</ul>

</span>



							</td>
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