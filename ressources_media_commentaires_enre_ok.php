<?php
include('include/open_connectionBase.inc'); 
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

?>
<html>

	<head>
		<meta http-equiv="content-type" content="text/html;charset=iso-8859-1">
		<meta name="generator" content="Adobe GoLive 4">
		<title>Prendre des notes</title>
		<meta HTTP-EQUIV="refresh" CONTENT="2;URL=javascript:window.open('ressources_media.php?lg=<?php echo $_GET["lg"] ?>&idressource=<?php echo $_GET["idressource"] ?>&idprofil=<?php echo $_GET["idprofil"] ?>','_top');">
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>

	<body>
		<table border="0" cellpadding="0" cellspacing="2" width="100%" height="300">
			<tr>
				<td align="center" valign="middle"><span class="titre_admin"><?php echo versionlinguistique(90); //Vos notes ont été enregistrées ?></span></td>
			</tr>
		</table>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  
echo '<script>';
echo 'top.window.location="ressources_media.php?lg='.$lg.'&retour='.$_GET["retour"].'&idressource='.$_GET["idressource"].'&idprofil='.$idprofil.'"';
echo '</script>';
?>