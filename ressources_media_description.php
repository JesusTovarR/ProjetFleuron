<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];


// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');






?>
<html>
	<head>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>
	<body>
			<div align="right">
				<?php if ($_SESSION['niveau']>1) { // Affichage Bouton édition page ?>
					<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
						<tr>
							<td align="center"><a href="ressources_media_description_edit.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idconseil=<?php echo $idconseil ?>&page=<?php echo $pageencours ?>"><span class="texte_info12"><?php echo versionlinguistique(47) //Editer ?></span></a></td>
						</tr>
					</table>
				<?php } ?>
			</div>

			<?php echo $description ?>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>