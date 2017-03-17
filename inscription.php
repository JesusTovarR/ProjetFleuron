<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

if (! isset($_SESSION['niveau'])) {
	$_SESSION['niveau']=0;
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

				<td bgcolor="#f6f5ed" align="center" valign="middle">
					<table border="0" cellpadding="10" cellspacing="2" width="900">
						<tr>
<!-- Partie centrale -->
							<td valign="top">
								<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(2); //couleur claire ?>" width="220">
									<tr>
										<td align="center" height="30">
											<span class="titre"><?php echo versionlinguistique(16); //Compléter ce formulaire pour vous inscrire ?></span>
										</td>
									</tr>
								</table>
								<center>
									<p><span class="texte_default">
		<form name="FormName" action="inscription_enre.php" method="post">
									<table border="0" cellpadding="10" cellspacing="2">
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(8); //Utilisateur ?> :</span></td>
											<td><input type="text" name="utilisateur" size="24"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(9); //Mot de passe ?> :</span></td>
											<td><input type="text" name="motdepasse" size="24"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(18); //Nom ?> :</span></td>
											<td><input type="text" name="nom" size="24"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(19); //Prénom ?> :</span></td>
											<td><input type="text" name="prenom" size="24"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(20); //E-mail ?> :</span></td>
											<td><input type="text" name="email" size="24"></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(21); //Pays ?> :</span></td>
											<td><select name="pays" size="1">
<?php
	// Affichage de la liste des pays

			$requete='SELECT * FROM pays ORDER BY nom';
			$recuplg = mysql_query($requete);
				while ($choixlg = mysql_fetch_assoc($recuplg))
					{

								echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];

					}

?>

												</select></td>
										</tr>
										<tr>
											<td><span class="texte_default"><?php echo versionlinguistique(22); //Langue à utiliser dans Fleuron ?> :</span></td>
											<td><select name="langue" size="1">
<?php

	// Affichage des langues disponibles pour l'utilisation de FLEURON

			$requete='SELECT * FROM lg WHERE online=1 ORDER BY nom';
			$recuplg = mysql_query($requete);
				while ($choixlg = mysql_fetch_assoc($recuplg))
					{
						if ($choixlg['code']=='fr')
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
													<input type="submit" value="<?php echo versionlinguistique(6) //S'inscrire ?>" name="submitButtonName"></center>
											</td>
										</tr>
									</table>
									</form></span></center>
							</td>
<!-- Fin partie centrale -->
<!-- Colonne de droite -->
							<td width="250" align="right" valign="top">
								<table border="0" cellpadding="5" cellspacing="2">
									<tr>
										<td align="right">
<!-- Module d'affichage des choix des langues disponibles - table LG -->
<?php include('include/choix_langue.inc');  ?>
											</td>
									</tr>
									<tr>
										<td align="right">
<!-- Module d'affichage du formulaire de connexion -->
<?php include('include/login.inc');  ?>
											</td>
									</tr>
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
										<td>
											<div align="right">
												<span class="conseil"><?php echo versionlinguistique(14) //Conseil double clique mot?></span></div>
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