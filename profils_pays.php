<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)




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

if (isset($_GET["ordre"])) {
	$ordre=$_GET["ordre"]; 
} else {
	$ordre="alpha";
}



//**********************************
// Affichage des liens
//**********************************
function affichage_profil()
	{

		global $lg,$niveau,$profil,$action,$action2,$ordre ; // r�cup�ration variable langue
$pays="";
		$requete = 'SELECT * FROM pays ORDER BY nom';
		$recuppays = mysql_query($requete);
			while ($datapays = mysql_fetch_assoc($recuppays))
				{

					$requete = 'SELECT COUNT(pays) AS total FROM profil WHERE niveau='.$niveau.' AND pays="'.$datapays['code'].'"';
					$recup = mysql_query($requete);
					$data = mysql_fetch_assoc($recup);

					if ($data['total']>0) {
								echo '<tr><td>';
								echo '<table border="0" cellpadding="4" cellspacing="0" height="60" width="400">';
								echo '<tr>';
									echo '<td width="300" align="center" bgcolor="'.couleur(1).'">';
										echo '<a href="profils_pays_list.php?lg='.$lg.'&niveau='.$niveau.'&pays='.$datapays['code'].'"><span class="texte_info12">'.$datapays['nom'].' ('.$data['total'].')</span></a>';
									echo '</td>';
								echo '</tr>';
								echo '</table>';
								echo '</td></tr>';

								}
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
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="profils.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
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


<div align="center">
	<table width="600">
		<tr>
			<td>
			<form name="FormName" action="profils_recherche.php" method="post">
			<table>
				<tr>
					<td>
						<input type="text" name="motcle" size="24" value="<?php echo versionlinguistique(13) //Mot cl� ?>" onFocus="javascript:this.value=''">
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
				<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="220">
					<tr>
						<td align="center"><a href="profils_ajouter.php?lg=<?php echo $lg ?>"><span class="texte_info12"><?php echo versionlinguistique(54); // Ajouter un utilisateur ?></span></a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div><br>

				<p><span class="message"><?php echo versionlinguistique(58) //Par pays ?> :</span>
<br>
			<table border="0" cellspacing="0" width="100%">
				<?php affichage_profil() ?>
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
<!-- Module d'affichage du dernier media publi�  -->
<?php include('include/derniermedia.inc');  ?>
										</td>
									</tr>
									<tr>
										<td>
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