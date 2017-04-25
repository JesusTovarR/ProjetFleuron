<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$categorie=$_GET["categorie"];
$page=$_GET["pageencours"];
$id=$_GET["id"];
$idprofil=$_GET["idprofil"];


function afficher_versionlinguistique($id) // Affichage des champs du formulaire tenant compte des langues de la table LG
	{
		global $lg;
			$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
				while ($donneeslg = mysql_fetch_assoc($recuplg))
					{

			$recup = mysql_query('SELECT * FROM ressources WHERE id='.$id);
				while ($data = mysql_fetch_assoc($recup))
					{





				echo '<tr>';
					echo '<td align="center">';
						echo '<span class="texte_default">'.$donneeslg['nom'].'</span>';	// Affichage de la langue

						echo '<table width="100%" border="0" cellpadding="5">';
							echo '<tr>';
								echo '<td>';
									echo '<span class="texte_default">'. new_versionlinguistique("text68").':</span>'; // Titre
								echo '</td>';
								echo '<td>';
									echo '<input type="text" name="nom_'.$donneeslg['code'].'" size="64" value="'.$data['nom_'.$donneeslg['code']].'">';
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td valign="top">';
									echo '<span class="texte_default">'.general("text14").'&nbsp;:</span>'; // description
								echo '</td>';
								echo '<td>';
									echo '<textarea name="description_'.$donneeslg['code'].'" cols="58" rows="6">'.$data['description_'.$donneeslg['code']].'</textarea>';
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td colspan="2" align="center">';
									echo '<input type="submit" value="'.content("btn2") .'" name="Valider">'; // enregistrer
								echo '</td>';
							echo '</tr>';
						echo '</table>';
					echo '</td>';
				echo '</tr>';
					}

					}

	}


include('include/recuperation_nom_categorie.inc'); // Routines d'affichage du nom de la cat�gorie retenue
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
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="100">
												<tr>
													<td align="center">
														<a href="<?php echo $page ?>?lg=<?php echo $lg ?>&idprofil=<?php echo $idprofil ?>&categorie=<?php echo $categorie ?>"><span class="texte_menu"><?php echo general("text5") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="texte_default"><?php echo content("line205_216"); //Editer ?></span>
										</td>
										<td width="150">
											&nbsp;
										</td>

									</tr>
								</table>


<center><br><br>

							<form name="FormName" action="ressource_edit_enre.php" method="post">
									<table width="100%" border="0" cellpadding="5">
										<?php afficher_versionlinguistique($id) // Affichage des champs du formulaire selon langue de la table LG ?>
										<tr>
											<td align="center">
												<table>
													<tr>
														<td>
															<span class="texte_default"><?php echo general("text7"); //Cat�gorie ?> :</span>
														</td>
														<td>
															<select name="categorie" size="1">
<?php
															$requete='SELECT * FROM categorie ORDER BY id';
															$recup = mysql_query($requete);
															while ($data = mysql_fetch_assoc($recup))
																{
																	if ($categorie==$data['id']) {
																		echo '<option value="'.$data['id'].'" selected>'.$data[$lg];
																	} else {
																		echo '<option value="'.$data['id'].'">'.$data[$lg];
																	}
																}
?>
															</select>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td align="center">
												<input type="submit" value="<?php echo content("btn2") //Enregistrer ?>" name="Valider">
											</td>
										</tr>
									</table>
								<input type="hidden" value="<?php echo $lg ?>" name="lg">
								<input type="hidden" value="<?php echo $id ?>" name="id">
								<input type="hidden" value="<?php echo $idprofil ?>" name="idprofil">
								<input type="hidden" value="<?php echo $page ?>" name="page">
							</form>
</center>
			



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
<!-- Module d'affichage du dernier media publi�  -->
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