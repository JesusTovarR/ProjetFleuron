<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


//**********************************
// 	Nombre de requetes du concordancier
//**********************************
	$nbrequete = 0;
	$requete = 'SELECT COUNT(id) AS total FROM recherche';
	$recup = mysql_query($requete);
	$nbrequete_array = mysql_fetch_assoc($recup);
	$nbrequete = $nbrequete_array['total'];

//**********************************
// Affichage des liens
//**********************************
function affichage_concordancier()
	{

		global $lg;
		$requete = 'SELECT * FROM recherche ORDER BY visiteur DESC';
		$recup = mysql_query($requete);
			while ($data = mysql_fetch_assoc($recup))
				{


						echo '<tr>';
							echo '<td>';
								echo '<a href="moteurderecherche.php?lg='.$lg.'&motcle='.$data['mot'].'&nope=1">'.$data['mot'].'</a>';
							echo '</td>';
							echo '<td align="center">';
								echo '<span class="texte_default">'.$data['visiteur'].'</span>';
							echo '</td>';
						echo '</tr>';
					}


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
								<table width="100%" border="0">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="statistiques.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo general("text5") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="titre_admin"><?php echo new_versionlinguistique("text130") //Statistiques ?></span>
										</td>
										<td width="150" align="center">
											<span class="titre_admin"><?php echo new_versionlinguistique("text114") //Concordancier ?></span>
										</td>
									</tr>
								</table>



				<p>
			<span class="texte_defaultGras"><?php echo $nbrequete ?> <?php echo new_versionlinguistique("text132") //requêtes ?></span><br><br>

			<table border="0" cellspacing="0" width="400">
				<tr>
					<td>
						<span class="texte_defaultGras"><?php echo new_versionlinguistique("text119") //Mot recherché ?></span>
					</td>
					<td align="center">
						<span class="texte_defaultGras"><?php echo new_versionlinguistique("text131") //Compteur ?></span>
					</td>
				</tr>
				<?php affichage_concordancier() ?>
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