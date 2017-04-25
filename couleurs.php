<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)





if (isset($_GET["action"])) {
	$action=$_GET["action"]; 
} else {
	$action=""; 
}

if (isset($_GET["action2"])) {
	$action2=$_GET["action2"]; 
} else {
	$action2=""; 
}

function affichage_palette()
	{
		global $lg; // récupération variable langue
			echo '<table width=100%>';
		$requete='SELECT * FROM couleur_memo ORDER BY id DESC';
		$recup = mysql_query($requete);
		while($donnees = mysql_fetch_assoc($recup)) 
			{
				echo '<tr>';
					echo '<td width="150" height="50" align="center" bgcolor="#'.$donnees['couleur1'].'">';
						echo '&nbsp;';
					echo '</td>';
					echo '<td width="150" height="50" align="center" bgcolor="#'.$donnees['couleur2'].'">';
						echo '&nbsp;';
					echo '</td>';
					echo '<td width="100" align="center" bgcolor="'.couleur(1).'">';
						echo '<a href="couleurs_appliquer.php?lg='.$lg.'&couleur1='.$donnees['couleur1'].'&couleur2='.$donnees['couleur2'].'"><span class="texte_info12">'.content("text1").'</span></a>'; // supprimer
					echo '</td>';			
					echo '<td width="100" align="center" bgcolor="'.couleur(1).'">';
						echo '<a href="couleurs_supprimer.php?lg='.$lg.'&id='.$donnees['id'].'"><span class="texte_info12">'.afficher_ressource("option2").'</span></a>'; // supprimer
					echo '</td>';
				echo '</tr>';

			}
			echo '</table>';

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
<center>
<span class="titre_admin">Modifier les couleurs</span></center>
<br><br><br>
<div align="right">
				<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
					<tr>
						<td align="center"><a href="couleurs_restaurer.php?lg=<?php echo $lg ?>"><span class="texte_info12">Restaurer les couleurs</span></a></td>
					</tr>
				</table>
</div>

<?php if ($action<>"") { ?>
<p><div align="center"><span class="message">Couleurs restaurées</span></div>
<?php } ?>
<?php if ($action2<>"") { ?>
<p><div align="center"><span class="message">Couleurs modifiées</span></div>
<?php } ?>
<br>
				<p><center>
		<form name="FormName" action="couleurs_modifier.php" method="post">
			<table border="0" cellspacing="0" >
				<tr>
					<td align="center">
Cliquer pour choisir<br>la couleur logo/infos:

					</td>
					<td align="center" width="200">
&nbsp;

					</td>
					<td align="center">
Cliquer pour choisir<br>la couleur boutons:

					</td>
				</tr>
				<tr>
					<td align="center">
<script src="scripts/color/jscolor.js"></script>

<input class="jscolor {onFineChange:'update(this)'}" value="cc66ff" name="couleur2">
<script>

</script>

					</td>
					<td align="center" width="200">
&nbsp;

					</td>
					<td align="center">
<script src="scripts/color/jscolor.js"></script>

<input class="jscolor {onFineChange:'update(this)'}" value="cc66ff" name="couleur1">
<script>

</script>

					</td>
				</tr>
				<tr>	
					<td align="center" colspan="3">
&nbsp;
					</td>
				</tr>
				<tr>	
					<td align="center" colspan="3">
<input type="submit" name="Valider">
					</td>
				</tr>
			</table>
		</form></center>
				</p>
<?php
				$requete = 'SELECT id FROM couleur_memo';
				$recup2 = mysql_query($requete);

				$num_rows = mysql_num_rows($recup2);
					if ($num_rows>0) {
?>
<span class="titre_admin"><?php echo content("text2")?> :</span></center>
<br>
<?php affichage_palette() ?>

<?php } ?>
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