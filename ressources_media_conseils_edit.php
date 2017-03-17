<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];
$page=$_GET["page"];


//************************************************************************
//			Récupération page conseils
//************************************************************************
	$requete = 'SELECT * FROM conseils_page WHERE ressource='.$idressource;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				$id=$data['id'];
				$pageconseil=$data['page'];

			}


if (isset($id)) {
	$vers="ressources_media_conseils_edit_enre.php";
} else {
	$vers="ressources_media_conseils_edit_new.php";
$pageconseil="";
}



?>
<html>
	<head>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/traitementtexte_conseils.inc'); // Traitement de texte TinyMCE version Conseils');  ?>
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
<div align="left">
<form name="FormName" action="<?php echo $vers ?>" method="post">
	<table border="0" cellpadding="0" cellspacing="5" width="40">

		<tr>
			<td align="left">
				<textarea name="page" cols="20" rows="10"><?php echo $pageconseil ?></textarea>
			</td>					
		</tr>
		<tr>
			<td align="center" valign="middle">
						<button id="buton1"  type="submit" class="stbuttonImp" ><?php echo versionlinguistique(112) //Publier ?></button>
			</td>
		</tr>
	</table>

		<input type="hidden" value="<?php echo $idressource; ?>" name="idressource">
		<input type="hidden" value="<?php echo $lg; ?>" name="lg">
		<input type="hidden" value="<?php echo $id; ?>" name="id">

		</form>
</div>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>