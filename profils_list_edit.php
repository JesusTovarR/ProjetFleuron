<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique, variable session)



$id=$_GET["id"];
$niveau=$_GET["niveau"];
$page=$_GET["page"];
$pays=$_GET["pays"];

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
						$jour=$data['jour'];

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
														<a href="<?php echo $page ?>?lg=<?php echo $lg ?>&pays=<?php echo $pays ?>&niveau=<?php echo $niveau ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
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

									<p><span class="texte_default">
		<form name="FormName" action="profils_list_edit_enre.php" method="post">
									<table border="0" cellpadding="10" cellspacing="2">
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(8); //Utilisateur ?> :</span></td>
											<td><span class="texte_default"><?php echo $utilisateur ?></span></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(18); //Nom ?> :</span></td>
											<td><span class="texte_default"><?php echo $nom ?></span></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(19); //Prénom ?> :</span></td>
											<td><span class="texte_default"><?php echo $prenom ?></span></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(20); //E-mail ?> :</span></td>
											<td><span class="texte_default"><?php echo $email ?></span></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(21); //Pays ?> :</span></td>
											<td>

<?php
	// Affichage de la liste des pays

			$requete='SELECT * FROM pays ORDER BY nom';
			$recuplg = mysql_query($requete);
				while ($choixlg = mysql_fetch_assoc($recuplg))
					{
						if ($choixlg['code']==$pays) {
							echo '<span class="texte_default">'.$choixlg['nom'].'</span>';
						} 
					}

?>
											</td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(22); //Langue à utiliser dans Fleuron ?> :</span></td>
											<td>
<?php
	// Affichage de la liste des langues disponibles

			$requete='SELECT * FROM lg ORDER BY nom';
			$recuplg = mysql_query($requete);
				while ($choixlg = mysql_fetch_assoc($recuplg))
					{
						if ($choixlg['code']==$langue)
							{
								echo '<span class="texte_default">'.$choixlg['nom'].'</span>';
							} 
					}

?>
											</td>
										</tr>
										<tr>
											<td>
												<span class="texte_default"><?php echo versionlinguistique(62); //Niveau ?> :</span>
											</td>
											<td>
		<select name="niveau" size="1">
<?php include('include/list_niveau.inc');  ?>
		</select>
											</td>
											<td>
												<center>
													<input type="submit" value="<?php echo versionlinguistique(41) //Modifier ?>" name="submitButtonName"></center>
											</td>
										</tr>

									</table>
		<input type="hidden" value="<?php echo $id ?>" name="id">
		<input type="hidden" value="<?php echo $pays ?>" name="pays">
		<input type="hidden" value="<?php echo $lg ?>" name="lg">
									</form></span></center>
<?php

										$jourdef = explode("-", $jour);
										echo '<br><span class="texte_default">'.versionlinguistique(95).' '.$jourdef[2].'-'.$jourdef[1].'-'.$jourdef[0].'</span></dl>'; // depuis le

?>
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