<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}

if (isset($_GET["id_cat"])) {
	$_SESSION['id_cat']=$_GET["id_cat"];
}


//**********************************
// Affichage des Cat�gories
//**********************************
function affichage_soustitres()
	{

		global $lg;
		$nb=0;
			echo '<table border="0" cellspacing="0" >';
						echo '<tr>';
			$ids=array();
			$count=1;
			$requete = 'SELECT id FROM ressources WHERE categorie='.$_SESSION['id_cat'];
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
				{
					$ids['id'.$count]=$data['id'];
					$count=$count+1;
				}
			foreach ($ids as $value){
				$requete2 = 'SELECT title FROM ressources_traduction WHERE id_resource='.$value.' AND code="'.$lg.'" AND status=1';
				$recup2 = mysql_query($requete2);
				while ($data2 = mysql_fetch_assoc($recup2)){
					if ($nb>2) {
						echo '</tr><tr>';
						$nb=0;

					}
					echo '<td>';
					echo '<table border="0" cellspacing="0">';
					echo '<tr>';
					echo '<td align="center">';
					echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="200" height="60">';
					echo '<tr>';
					echo '<td align="center"><a href="traducteur_choix_langue.php?lg=' . $lg . '&categorie=16&id_res='.$value.'"><span class="texte_info12">' . $data2['title'] . '</span></a></td>';
					echo '</tr>';
					echo '</table>';
					echo '</td>';
					echo '</tr>';
					echo '</table>';
					echo '</td>';

					$nb=$nb+1;
				}
			}
		echo '</tr></table>';
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
								<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(2); //couleur claire ?>" width="220">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="traducteur_soustitres.php"><span class="texte_menu"><?php echo page_modification("line97") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center" height="30">
											<span class="titre"><?php echo page_traducteur("title4");  //Ressources multimedias ?></span>
										</td>
									</tr>
								</table>
<br>
<span class="texte_default"><?php echo page_traducteur("title2");  //Choisir une cat�gorie ?></span>
<br>

				<p>
					<?php affichage_soustitres() ?>
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