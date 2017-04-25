<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



$id = $_GET["id"];


$recuplg = mysql_query('SELECT * FROM lg WHERE id='.$id);
	while ($donneeslg = mysql_fetch_assoc($recuplg))
		{
			$id = $donneeslg['id'];
			$nom = 	$donneeslg['nom'];
			$code = $donneeslg['code'];

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
								<table width="100%" border="0">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="langueutilisation.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo general("text5") //REtour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											<span class="titre_admin"><?php echo general("text13") //Langues d'utilisation ?></span>
										</td>
										<td width="150" align="center">
											<span class="titre_admin"><?php echo content("line205_216") //Editer ?></span>
										</td>
									</tr>
								</table>
<center>
<br><br><br>

</center>
		<form name="FormName" action="langueutilisation_edit_enre.php" method="post">
		<table border="0" cellpadding="10" cellspacing="2">
			<tr>
				<td>Nom :</td>
				<td><input type="text" name="nom" size="24" value="<?php echo $nom ?>"></td>
			</tr>
			<tr>
				<td>Code pays :</td>
				<td><input type="text" name="code" size="4" value="<?php echo $code ?>"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
						<button id="buton1"  type="submit" class="stbuttonImp" ><?php echo content("btn2") //enregistrer ?></button>
				</td>
			</tr>
		</table>
		<input type="hidden" value="<?php echo $lg ?>" name="lg">
		<input type="hidden" value="<?php echo $id ?>" name="id">
		<input type="hidden" value="<?php echo $code ?>" name="oldcode">
		</form>
		<br><br>



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
