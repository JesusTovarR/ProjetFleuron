<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique, variable session)


$action=$_GET["action"];
$id=$_GET["id"];
$niveau=$_GET["niveau"];

if ($niveau==1) {
	$nomniveau = versionlinguistique(44);
}
if ($niveau==5) {
	$nomniveau = versionlinguistique(56);
}
if ($niveau==10) {
	$nomniveau = versionlinguistique(57);
}

// 		Récupération des données du profil

			$requete='SELECT * FROM profil WHERE id='.$id;
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
					{

						$iduser=$data['id'];
						$nom=$data['nom'];
						$prenom=$data['prenom'];
						$email=$data['email'];
						$pays=$data['pays'];
						$langue=$data['langue'];
						$utilisateur=$data['utilisateur'];
						$niveau=$data['niveau'];
						$motdepasse=$data['motdepasse'];

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
				<td align="center" valign="middle" bgcolor="<?php echo couleur(2); // couleur clair ?>" height="67">
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
														<a href="profils_list.php?lg=<?php echo $lg ?>&id=<?php echo $id ?>&niveau=<?php echo $niveau ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="titre_admin"><?php echo versionlinguistique(55) //profils ?></span>
										</td>
										<td width="150" align="center">
											<span class="titre_admin"><?php echo $nomniveau ?></span>
										</td>
									</tr>
								</table>


<br>
								<center>
<span class="message"><?php echo versionlinguistique(67) //supprimer ce profil? ?></span>
									<p><span class="texte_default">

									<table border="0" cellpadding="10" cellspacing="2">
										<tr>
											<td><span class="texte_default"><?php echo $utilisateur ?></span></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo $nom ?></span></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo $prenom ?></span></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo $email ?></span></td>
										</tr>

									
										<tr>
											<td colspan="2">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="profils_list_supprimer_enre.php?lg=<?php echo $lg ?>&id=<?php echo $id ?>&niveau=<?php echo $niveau ?>"><span class="texte_menu"><?php echo versionlinguistique(48) //supprimer ?></span></a>
													</td>
												</tr>
											</table>												<center>

												</center>
											</td>
										</tr>
									</table>
		<input type="hidden" value="<?php echo $id ?>" name="id">
									</form></span></center>
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
										<td align="right">
<!-- Module d'affichage menu admin  -->
<?php include('include/menu_admin.inc');  ?>
												
										</td>
									</tr>
<?php if ($_SESSION['niveau']>0) { // Affichage Favoris/Notes/Commentaires ?>
									<tr>
										<td align="center">
<!-- Module d'affichage menu admin  -->
<?php include('include/menu_FavorisNotesComm.inc');  ?>
												
										</td>
									</tr>
<?php } ?>
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