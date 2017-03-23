<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique, variable session)


if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite à l'action d'édition de la page
} else {
	$action="";
}


// 		Récupération des données du profil

			$requete='SELECT * FROM profil WHERE id='.$_SESSION['id'];
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

								<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(2); //couleur claire ?>" width="220">
									<tr>
										<td align="center" height="30">
											<span class="titre"><?php echo versionlinguistique(23); //Modifier votre profil ?></span>
										</td>
									</tr>
								</table>
								<center>
<?php if ($action<>"") { ?>
<p><div align="center"><span class="message"><?php echo versionlinguistique(25); // Profil enregistré ?></span></div>
<?php } ?>
									<p><span class="texte_default">
		<form name="FormName" action="profil_enre.php" method="post">
									<table border="0" cellpadding="10" cellspacing="2">
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(8); //Utilisateur ?> :</span></td>
											<td><input type="text" name="utilisateur" size="24" value="<?php echo $utilisateur ?>"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(9); //Mot de passe ?> :</span></td>
											<td><input type="text" name="motdepasse" size="24" value="<?php echo $motdepasse ?>"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(18); //Nom ?> :</span></td>
											<td><input type="text" name="nom" size="24" value="<?php echo $nom ?>"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(19); //Prénom ?> :</span></td>
											<td><input type="text" name="prenom" size="24" value="<?php echo $prenom ?>"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(20); //E-mail ?> :</span></td>
											<td><input type="text" name="email" size="24" value="<?php echo $email ?>"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(21); //Pays ?> :</span></td>
											<td>
												<select name="pays" size="1">
<?php
	// Affichage de la liste des pays

			$requete='SELECT * FROM pays ORDER BY nom';
			$recuplg = mysql_query($requete);
				while ($choixlg = mysql_fetch_assoc($recuplg))
					{
						if ($choixlg['code']==$pays) {
							echo '<option value="'.$choixlg['code'].'" selected>'.$choixlg['nom'];
						} else {

							echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];
						}

					}

?>
												</select></td>
										</tr>
										<tr>
											<td><span class="texte_default">Devenir Traducteur:</span></td><!--Cambiar-->
											<td>
												<select name="traducteur" size="1">
													<?php
														if($niveau>=20){
													?>
													<option value="1" selected>Oui
													<option value="0">Non
													<?php
													}else  if($niveau<20){
														?>
													<option value="0" selected>Non
													<option value="1">Oui
													<?php
														}
													?>
												</select></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(22); //Langue à utiliser dans Fleuron ?> :</span></td>
											<td><select name="langue" size="1">
<?php
	// Affichage de la liste des langues disponibles

			$requete='SELECT * FROM lg WHERE online=1 ORDER BY nom';
			$recuplg = mysql_query($requete);
				while ($choixlg = mysql_fetch_assoc($recuplg))
					{
						if ($choixlg['code']==$langue)
							{
								echo '<option value="'.$choixlg['code'].'" selected>'.$choixlg['nom'];
							} else {
								echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];
							}
					}

?>
												</select></td>
										</tr>
										<tr>
											<td colspan="2">
												<center>
													<input type="submit" value="<?php echo versionlinguistique(24) //S'inscrire ?>" name="submitButtonName"></center>
											</td>
										</tr>
									</table>
		<input type="hidden" value="<?php echo $iduser; ?>" name="id">
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