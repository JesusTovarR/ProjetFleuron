<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$action=$_GET["action"];
$action2=$_GET["action2"];

$idvl=$_GET["id"];


function affichageversionlinguistique()
	{
		global $lg,$action,$action2,$idvl; // récupération variables de connexion

		$requete='SELECT * FROM versionlinguistique ORDER BY fr';
		$recup = mysql_query($requete);

		while($donnees = mysql_fetch_assoc($recup)) 
			{
				echo '<tr>';
					echo '<td>';
						echo '<a name="'.$donnees['id'].'"></a>';
						echo '<table border="0" width="600">';
							echo '<tr>';

								echo '<td width="100" height="100" bgcolor="'.$donnees['couleur1'].'" align="center" valign="top">';
									echo '&nbsp;';
								echo '</td>';

								//echo '<td bgcolor="'.couleur(1).'">';
								echo '<td>';
$voca="";
			$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
				while ($donneeslg = mysql_fetch_assoc($recuplg))
					{

$voca=$voca." ".$donnees[$donneeslg['code']]."<br>";
					

					}
$voca=substr($voca,0,strlen($voca)-1);
echo '<a href="versionlinguistique_edit.php?id='.$donnees['id'].'&lg='.$lg.'"><span class="list">'.$voca.'</span></a>';


								echo '</td>';
								echo '<td width="300" align="center" valign="top">';
									if ($action=="ok" AND $donnees['id']==$idvl) {
										echo '<table border="0" cellpadding="4" cellspacing="2" bgcolor="'.couleur(1).'" width="220">';
											echo '<tr>';
												echo '<td align="center"><a href="#"><span class="texte_info12">'.new_versionlinguistique("text74").'</span></a></td>'; // version linguistique modifiée
											echo '</tr>';
										echo '</table>';
									}
									if ($action2=="ok" AND $donnees['id']==$idvl) {
										echo '<table border="0" cellpadding="4" cellspacing="2" bgcolor="'.couleur(1).'" width="220">';
											echo '<tr>';
												echo '<td align="center"><a href="#"><span class="texte_info12">'.new_versionlinguistique("text76").'</span></a></td>'; // version linguistique modifiée
											echo '</tr>';
										echo '</table>';
									}
								echo '</td>';
							echo '</tr>';
						echo '</table>';
					echo '</td>';
				echo '</tr>';
			}
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
				<td align="center" valign="middle" bgcolor="<?php echo couleur(2); // couleur claire ?>" height="67">
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
					<table border="0" cellpadding="10" cellspacing="2" width="850">
						<tr>

							<td valign="top">

<center><span class="titre_admin"><?php echo new_versionlinguistique("text45") //Versions linguistiques ?></center>
								<table width="100%" border="0">
									<tr>
										<td>
			<form name="FormName" action="versionlinguistique_recherche.php" method="post">
			<table>
				<tr>
					<td>
						<input type="text" name="motcle" size="24" value="<?php echo new_versionlinguistique("text13") //Mot clé ?>" onFocus="javascript:this.value=''">
					</td>
				</tr>
				<tr>
					<td>
						<center>
						<span class="texte_menu"><input type="submit" value="<?php echo new_versionlinguistique("text11") //Rechercher ?>" name="submitButtonName"></span></center>
					</td>
				</tr>
			</table>
			<input type="hidden" value="<?php echo $lg ?>" name="lg">
			</form>
										</td>

										<td align="center" valign="top">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="versionlinguistique_ajouter.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo general("text6") //Ajouter ?></span></a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
<div align="center">
	<table width="600">
		<tr>
			<td>

			</td>
		</tr>
	</table>
</div>
<center>

	<table border="0" cellpadding="0" cellspacing="5" width="600">

		<?php affichageversionlinguistique(); ?>

	</table>
</center>
								<table width="100%" border="0">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="index.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo general("text5") //REtour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="titre_admin"><?php echo new_versionlinguistique("text45") //Versions linguistiques ?></span>
										</td>
										<td width="150" align="center">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="versionlinguistique_ajouter.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo general("text6") //Ajouter ?></span></a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>




							</td>
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
										<td>
<!-- Module d'affichage menu admin  -->
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