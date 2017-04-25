<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$categorie=$_GET["categorie"];
$id=$_GET["id"];

$idprofil=$_GET["idprofil"];
$page=$_GET["pageencours"];

//**********************************
// Affichage des liens
//**********************************
function affichage_ressource()
	{

		global $lg,$categorie,$id,$idprofil,$page; // r�cup�ration variable langue
		$nb=0;
			echo '<table border="0" cellspacing="0" >';


			$requete = 'SELECT * FROM ressources WHERE id='.$id;
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
				{

				$nom=$data['nom_'.$lg];
				if ($nom=="") {
					$nom=$data['nom_uk'];
				}
				if ($nom=="") {
					$nom=$data['nom_fr'];
				}

				$description=$data['description_'.$lg];
				if ($description=="") {
					$description=$data['description_uk'];
				}
				if ($description=="") {
					$description=$data['description_fr'];
				}

						echo '<tr>';
							echo '<td>';
					echo '<table border="0" cellspacing="0">';
						echo '<tr>';
							echo '<td align="center">';
								echo '<table border="0" cellpadding="4" cellspacing="0" width="600" height="60">';
									echo '<tr>';
										echo '<td align="center" width="200">';

										echo '</td>';
										echo '<td align="left">';
										if ($data['nom_fr']<>"") {
											echo '<span class="default">'.$data['nom_fr'].'</span><br><br>';
										}
											echo '<span class="default">'.$description.'</span>';
										echo '</td>';
										if ($_SESSION['niveau']>0) {
											echo '<td align="left">';

											echo '</td>';
										}
									echo '</tr>';
								echo '</table>';
							echo '</td>';
						echo '</tr>';		


				if ($_SESSION['niveau']>1) {
					echo '<tr>';
						echo '<td colspan="2" align="right">';
							echo '<table>';
								echo '<tr>';
									echo '<td>';
										echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="200">';
											echo '<tr>';
												echo '<td align="center"><a href="ressource_suppr_enre.php?lg='.$lg.'&id='.$id.'&categorie='.$data['categorie'].'&pageencours='.$page.'&idprofil='.$idprofil.'"><span class="texte_info12">'.afficher_ressource("option2").'</span></a></td>'; // supprimer
											echo '</tr>';
										echo '</table>';
									echo '</td>';
								echo '</tr>';
							echo '</table>';
						echo '</td>';
					echo '</tr>';
							}
					echo '</table>';
							echo '</td>';

		$nb=$nb+1;

				}
					echo '</tr></table>';

	}


include('include/recuperation_nom_categorie.inc'); // Routines d'affichage du nom de la cat�gorie retenue
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
								<table width="100%" border="0">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="100">
												<tr>
													<td align="center">
														<a href="<?php echo $page ?>?lg=<?php echo $lg ?>&idprofil=<?php echo $idprofil ?>&categorie=<?php echo $categorie ?>#<?php echo $id ?>"><span class="texte_menu"><?php echo general("text5") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="texte_default"><?php echo new_versionlinguistique("text72"); //Supprimer une ressource ?></span>
										</td>
										<td width="150">
											&nbsp;
										</td>
									</tr>
								</table>



<br>


				<p>
					<?php affichage_ressource() ?>
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