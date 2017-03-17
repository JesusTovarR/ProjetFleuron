<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



$id = $_GET["id"];
$page = $_GET["page"];





function edition_page($id)
	{

		global $lg,$page; // récupération variables de connexion



		$requete = 'SELECT * FROM lg ORDER BY id';
		$recuplg = mysql_query($requete);
		while ($donneeslg = mysql_fetch_assoc($recuplg))
			{
			$requete2 = 'SELECT '.$donneeslg['code'].' FROM page WHERE nompage="'.$page.'"';
			$recup = mysql_query($requete2);
				while ($data = mysql_fetch_assoc($recup))
					{
					echo '<tr>';
						echo '<td align="center">';
							echo '<span class="titre_admin">'.$donneeslg['nom']."</span>";

						echo '</td>';					
					echo '</tr>';
					echo '<tr>';
						echo '<td align="center">';
							echo '<textarea name="'.$donneeslg['code'].'" cols="60" rows="40">'.$data[$donneeslg['code']].'</textarea>';
						echo '</td>';					
					echo '</tr>';
					echo '<tr>';
						echo '<td align="right" valign="middle">';
							echo '<input type="submit" value="'.page_modification("line46").'" name="submitButtonName">'; // Enregistrer
						echo '</td>';
					echo '</tr>';

					}

			}

	}
?>

<html>

	<head>

<?php include('include/head.inc');  ?>
<?php include('include/traitementtexte.inc'); // Traitement de texte TinyMCE');  ?>
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
								<table width="100%" border="0">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="<?php echo $page; ?>?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo page_modification("line97") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="titre_admin"><?php echo $page; ?></span>
										</td>
										<td width="150" align="center">
											<span class="titre_admin"><?php echo page_modification("line106") //Editer ?></span>
										</td>
									</tr>
								</table>
<center>
<br>
<form name="FormName" action="page_edit_enre.php" method="post">
	<table border="0" cellpadding="0" cellspacing="5" width="600">

		<?php edition_page($id) ?>

	</table>

		<input type="hidden" value="<?php echo $id; ?>" name="id">
		<input type="hidden" value="<?php echo $lg; ?>" name="lg">
		<input type="hidden" value="<?php echo $page; ?>" name="page">
		</form>




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