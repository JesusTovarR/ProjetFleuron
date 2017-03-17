<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$idressource=$_GET["idressource"];
$idprofil=$_GET["idprofil"];

//************************************************************************
//			Récupération notes
//************************************************************************
	$requete = 'SELECT * FROM commentaires WHERE ressource='.$idressource.' AND profil='.$idprofil;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				$id=$data['id'];
				$commentaire=$data['commentaire'];

			}

if ($id>0) {
	$verspage="ressources_media_commentaires_edit.php";
} else {
	$verspage="ressources_media_commentaires_enre.php";
}

?>
<html>
	<head>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>
	<body>
		<form name="FormName" action="<?php echo $verspage ?>" method="post">
		<table border="0" cellpadding="2" cellspacing="2">
			<tr>
				<td>
					<p><?php echo versionlinguistique(91); //Votre commentaire ?> :</p>
					<p><textarea name="commentaire" cols="54" rows="10"><?php echo $commentaire ?></textarea></p>
				</td>
			</tr>
			<tr>
				<td align="center">					
						<button id="buton1"  type="submit" class="stbuttonImp" ><?php echo versionlinguistique(112) //publier ?></button>
				</td>
			</tr>
		</table>
			<input type="hidden" value="<?php echo $lg ?>" name="lg">
			<input type="hidden" value="<?php echo $idressource ?>" name="idressource">
			<input type="hidden" value="<?php echo $idprofil ?>" name="idprofil">
			<input type="hidden" value="<?php echo $id ?>" name="id">
		</form>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>