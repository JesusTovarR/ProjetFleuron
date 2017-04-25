<?php
include('include/open_connectionBase.inc'); 
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

?>
<html>

	<head>
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
		<meta name="generator" content="Adobe GoLive 4">
		<title>Prendre des notes</title>
		<meta http-equiv="refresh" content="2;URL=ressources_media_conseils.php?lg=<?php echo $_GET["lg"]; ?>&idressource=<?php echo $_GET["idressource"]; ?>&idprofil=<?php echo $_GET["idprofil"]; ?>">
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>

	<body>
		<table border="0" cellpadding="0" cellspacing="2" width="100%" height="300">
			<tr>
				<td align="center" valign="middle"><span class="titre_admin"><?php echo new_versionlinguistique("text99"); //Vos notes ont �t� enregistr�es ?></span></td>
			</tr>
		</table>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>