<?php
//*****************************************************************************************
// 	R�alisation par Steven DUDA - 2016 
//	06 63 10 33 21 - steven.duda@wanadoo.fr
//	www.stevenduda.com
//*****************************************************************************************

include('include/open_connectionBase.inc'); // connection � la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$page=$_GET["page"];

//**************************************************************************************************
// Routine d'affichage du formulaire d'ajout de cat�gorie pour toutes les langues d'utilisation
//**************************************************************************************************
function ajouter_categorie()
	{
		global $lg;
		echo '<form name="FormName" action="categorie_ajouter_enre.php" method="post">';
		echo '<table border="0">';

			$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
				while ($donneeslg = mysql_fetch_assoc($recuplg))
					{

					echo '<tr>';
						echo '<td width="50">';
								echo $donneeslg['nom'];	// Affichage de la version linguistique du mot
						echo '</td>';
						echo '<td width="600"><input type="text" name="'.$donneeslg['code'].'" size="80" value=""></td>';
						if ($donneeslg['code']=="fr")
							{
							echo '<td width="100" rowspan="3" align="center" valign="middle">';
								echo '<input type="submit" value="'.content('btn2').'" name="submitButtonName">'; // Enregistrer
							echo '</td>';
							}
					}

					echo '</tr>';


		echo '</table>';
		echo '<input type="hidden" value="'.$lg.'" name="lg">';
		echo '</form>';
		echo '<br><br>';
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
<!-- Menu principal -->
					<?php include('include/menu_top.inc'); ?>
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
														<a href="<?php echo $page ?>?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo general("text5") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="titre_admin"><?php echo general("text7")//cat�gorie ?></span>
										</td>
										<td width="150" align="center">
											<span class="titre_admin"><?php echo general("text6") //Ajouter ?></span>
										</td>
									</tr>
								</table>
								<center>
									<br><br>
										<?php ajouter_categorie() ?>
								</center>
							</td>

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
<!-- ****************************************************************************************** -->
<!--  	R�alisation par Steven DUDA pour CNRS/ATILF - 2016 					-->
<!--	06 63 10 33 21 - steven.duda@wanadoo.fr							-->
<!--	www.stevenduda.com									-->
<!-- ****************************************************************************************** -->