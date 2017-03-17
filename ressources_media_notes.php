<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$idressource=$_GET["idressource"];
$idprofil=$_GET["idprofil"];


//************************************************************************
//			Récupération notes
//************************************************************************
	$requete = 'SELECT * FROM notes WHERE ressource='.$idressource.' AND profil='.$idprofil;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				$id=$data['id'];
				$notes=$data['notes'];
				$regarder=$data['regarder'];
				$comprendre=$data['comprendre'];
				$aimer=$data['aimer'];
				$suivre=$data['suivre'];
			}

if (isset($id)) {
	$verspage="ressources_media_notes_edit.php";
} else {
	$verspage="ressources_media_notes_enre.php";
}

if (!isset($notes)) {
	$notes="";
}
if (!isset($regarder)) {
	$regarder="";
}
if (!isset($comprendre)) {
	$comprendre="";
}
if (!isset($aimer)) {
	$aimer="";
}
if (!isset($suivre)) {
	$suivre="";
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
					<p><?php echo versionlinguistique(84); //Prendre des notes ?></p>
					<p><textarea name="notes" cols="54" rows="10"><?php echo $notes ?></textarea></p>
				</td>
			</tr>
			<tr>
				<td align="center">					
						<button id="buton1"  type="submit" class="stbuttonImp" ><?php echo versionlinguistique(24) //enregistrer ?></button>
				</td>
			</tr>
			<tr>
				<td>					
					<p><?php echo versionlinguistique(85); //Pourquoi je regarde ce media? ?></p>
					<p><textarea name="regarder" cols="54" rows="4"><?php echo $regarder ?></textarea></p>
				</td>
			</tr>
			<tr>
				<td>					
					<p><?php echo versionlinguistique(86); //Ce que j'ai compris: ?></p>
					<p><textarea name="comprendre" cols="54" rows="4"><?php echo $comprendre ?></textarea></p>
				</td>
			</tr>
			<tr>
				<td>					
					<p><?php echo versionlinguistique(87); //Est ce que j'ai aimé? ?></p>
					<p><textarea name="aimer" cols="54" rows="4"><?php echo $aimer ?></textarea></p>
				</td>
			</tr>
			<tr>
				<td>					
					<p><?php echo versionlinguistique(88); //Est ce que j'ai suivi les conseils? ?></p>
					<p><textarea name="suivre" cols="54" rows="4"><?php echo $suivre ?></textarea></p>
				</td>
			</tr>
			<tr>
				<td align="center">					
						<button id="buton1"  type="submit" class="stbuttonImp" ><?php echo versionlinguistique(24) //Enregistrer ?></button>
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