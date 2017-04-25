<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$motcle=$_POST["motcle"];

function affichageversionlinguistique()
	{
		global $lg; // r�cup�ration variables de connexion

		$recup = mysql_query('SELECT * FROM versionlinguistique ORDER BY fr');
		while($donnees = mysql_fetch_assoc($recup)) 
			{
$voca="";
			$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
				while ($donneeslg = mysql_fetch_assoc($recuplg))
					{

$voca=$voca." ".$donnees[$donneeslg['code']]."<br>";
					

					}
$texte = $voca;
if (recherche($texte.$donnees['id'])>-1) {
				echo '<tr>';
					echo '<td>';
						echo '<table border="0" width="600">';
							echo '<tr>';

								echo '<td width="50" align="center" valign="top">';
									echo '<span class="list">'.$donnees['id'].'</span>';
								echo '</td>';

								//echo '<td bgcolor="'.couleur(1).'">';
								echo '<td>';

$voca=substr($voca,0,strlen($voca)-1);
echo '<a href="versionlinguistique_edit.php?id='.$donnees['id'].'&lg='.$lg.'"><span class="list">'.$voca.'</span></a>';


								echo '</td>';
							echo '</tr>';
						echo '</table>';
					echo '</td>';
				echo '</tr>';
				}
			}
	}

function recherche($texte)
{
	global $lg,$motcle; // r�cup�ration variable langue

	return stripos($texte, $motcle);
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
				<td bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" height="40" align="center">
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
								<table width="100%" border="0">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="versionlinguistique.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo general("text5") //REtour ?></span></a>
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
<div align="center">
	<table width="600">
		<tr>
			<td>
			<form name="FormName" action="versionlinguistique_recherche.php" method="post">
			<table>
				<tr>
					<td>
						<input type="text" name="motcle" size="24" value="<?php echo $motcle //Mot cl� ?>" onFocus="javascript:this.value=''">
					</td>
				</tr>
				<tr>
					<td>
						<center>
						<span class="texte_menu"><input type="submit" value="<?php echo new_versionlinguistique("text11") //Rechercher ?>" name="submitButtonName"></span></center>
					</td>
				</tr>
			</table>
			</form>
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
														<a href="versionlinguistique.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo general("text5") //REtour ?></span></a>
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