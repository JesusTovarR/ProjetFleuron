<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

if (! isset($_SESSION['niveau'])) {
	$_SESSION['niveau']=0;
}


if (isset($_GET["action"])) {
	$action=$_GET["action"]; 
}
if (isset($_GET["action2"])) {
	$action=$_GET["action2"]; 
}


//**********************************
// 	Nombre de favoris de l'utilisateur - $nbfavoris
//**********************************
	$nbutilisateur = 0;
	$requete = 'SELECT COUNT(id) AS total FROM profil WHERE niveau=1';
	$recup = mysql_query($requete);
	$nb_array = mysql_fetch_assoc($recup);
	$nbutilisateur = $nb_array['total'];

//**********************************
// 	Nombre de notes de l'utilisateur - $nbnotes
//**********************************
	$nbstagiaire = 0;
	$requete = 'SELECT COUNT(id) AS total FROM profil WHERE niveau=5';
	$recup = mysql_query($requete);
	$nb_array = mysql_fetch_assoc($recup);
	$nbstagiaire = $nb_array['total'];


//**********************************
// 	Nombre de commentaires de l'utilisateur - $nbcommentaires
//**********************************
	$nbadmin = 0;
	$requete = 'SELECT COUNT(id) AS total FROM profil WHERE niveau=10';
	$recup = mysql_query($requete);
	$nb_array = mysql_fetch_assoc($recup);
	$nbadmin = $nb_array['total'];
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
<center>
<span class="titre_admin"><?php echo versionlinguistique(55); // profils ?></span></center>
<br><br><br>
<div align="center">
	<table width="600">
		<tr>
			<td>
			<form name="FormName" action="profils_recherche.php" method="post">
			<table>
				<tr>
					<td>
						<input type="text" name="motcle" size="24" value="<?php echo versionlinguistique(13) //Mot clé ?>" onFocus="javascript:this.value=''">
					</td>
				</tr>
				<tr>
					<td>
							<center>
							<span class="texte_menu"><input type="submit" value="<?php echo versionlinguistique(11) //Rechercher ?>" name="submitButtonName"></span></center>
					</td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $lg ?>" name="lg">
			</form>
			</td>
			<td align="right" valign="top">
				<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
					<tr>
						<td align="center"><a href="profils_ajouter.php?lg=<?php echo $lg ?>"><span class="texte_info12"><?php echo versionlinguistique(54); // Ajouter un utilisateur ?></span></a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>


<br>
				<p>

			<table border="0" cellspacing="0" >
				<tr>
					<td align="center">
						<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1) ?>" width="200" height="60">
							<tr>
								<td align="center">
									<a href="profils_pays.php?lg=<?php echo $lg ?>&niveau=1"><span class="texte_info12"><?php echo versionlinguistique(44); // utilisateurs ?> (<?php echo $nbutilisateur ?>)</span></a>
								</td>
							</tr>
						</table>

					</td>
					<td align="center">
						<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1) ?>" width="200" height="60">
							<tr>
								<td align="center">
									<a href="profils_pays.php?lg=<?php echo $lg ?>&niveau=5"><span class="texte_info12"><?php echo versionlinguistique(56); // stagiaires ?> (<?php echo $nbstagiaire ?>)</span></a>
								</td>
							</tr>
						</table>

					</td>
					<td align="center">
						<table border="0" cellpadding="4" cellspacing="0" bgcolor="<?php echo couleur(1) ?>" width="200" height="60">
							<tr>
								<td align="center">
<!-- profils_list.php -->
									<a href="profils_pays.php?lg=<?php echo $lg ?>&niveau=10"><span class="texte_info12"><?php echo versionlinguistique(57); // Administrateurs ?> (<?php echo $nbadmin ?>)</span></a>
								</td>
							</tr>
						</table>

					</td>
				</tr>
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