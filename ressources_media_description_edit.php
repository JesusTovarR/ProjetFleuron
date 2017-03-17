<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];
$page=$_GET["page"];


function afficher_versionlinguistique($id) // Affichage des champs du formulaire tenant compte des langues de la table LG
	{
		global $lg;
			$recuplg = mysql_query('SELECT * FROM lg ORDER BY id');
				while ($donneeslg = mysql_fetch_assoc($recuplg))
					{
			$requete = 'SELECT * FROM ressources WHERE id='.$id;
			$recup = mysql_query($requete);

				while ($data = mysql_fetch_assoc($recup))
					{





				echo '<tr>';
					echo '<td align="center">';
						echo '<span class="titre">'.$donneeslg['nom'].'</span>';	// Affichage de la langue

						echo '<table width="100%" border="0" cellpadding="5">';
							echo '<tr>';
								echo '<td valign="top">';
									echo '<span class="texte_default">'.$donneeslg['nom'].'&nbsp;:</span>'; // description
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td>';
									echo '<textarea name="description_'.$donneeslg['code'].'" cols="46" rows="6">'.$data['description_'.$donneeslg['code']].'</textarea>';
								echo '</td>';
							echo '</tr>';
							echo '<tr>';
								echo '<td align="center">';
									echo '						<button id="buton1"  type="submit" class="stbuttonImp" >'.versionlinguistique(112).'</button>'; // publier
								echo '</td>';
							echo '</tr>';
						echo '</table>';
					echo '</td>';
				echo '</tr>';
					}

					}

	}


include('include/recuperation_nom_categorie.inc'); // Routines d'affichage du nom de la catégorie retenue
?>
<html>
	<head>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">

	</head>
	<body>
								<table width="100%" border="0">
									<tr>
										<td width="150">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="<?php echo $page; ?>?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center">
											
										</td>
										<td width="150" align="center">
											
										</td>
									</tr>
								</table>
<center><br><br>

							<form name="FormName" action="ressources_media_description_edit_enre.php" method="post">
									<table width="100%" border="0" cellpadding="5">
										<?php afficher_versionlinguistique($idressource) // Affichage des champs du formulaire selon langue de la table LG ?>

									</table>
								<input type="hidden" value="<?php echo $lg ?>" name="lg">
								<input type="hidden" value="<?php echo $idressource ?>" name="id">
								<input type="hidden" value="<?php echo $idprofil ?>" name="idprofil">
								<input type="hidden" value="<?php echo $page ?>" name="page">
							</form>
</center>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>