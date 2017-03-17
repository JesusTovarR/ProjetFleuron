<?php
function affichage_ressource($idressource)
	{

	global $lg;



			$requete = 'SELECT * FROM ressources WHERE id='.$idressource;
			$recup2 = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup2))
				{


					$nom=$data['nom_'.$lg];
					if ($nom=="") {
						$nom=$data['nom_uk'];
					}
					if ($nom=="") {
						$nom=$data['nom_fr'];
					}

					$description=$data['description_'.$lg];
					if ($description=="") {
						$description=$data['description_uk'];
					}
					if ($description=="") {
						$description=$data['description_fr'];
					}
					$typemedia=$data['typemedia'];

					if ($data['offline']==1) {
						$couleurzone = "#696969";
					} else {
						$couleurzone = "#E5E4DF";
					}


$lien='ressources_media.php?lg='.$lg.'&idressource='.$data['id'].'&categorie='.$data['categorie'];


								echo '<table border="0" cellspacing="4" bgcolor="#E5E4DF">'.chr(10);
									echo '<tr>'.chr(10);
										echo '<td align="center">'.chr(10);

											echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.$couleurzone.'" width="400" height="60">'.chr(10);
												echo '<tr>'.chr(10);
													echo '<td align="center" width="200">'.chr(10);
$filename = 'ressources/'.$data['id'].'.jpg';
if (file_exists($filename)) {
	$fichierserveur=$data['id'].'.jpg';
}

$filename = 'ressources/'.$data['id'].'.jpeg';
if (file_exists($filename)) {
	$fichierserveur=$data['id'].'.jpg';
}

$filename = 'ressources/'.$data['id'].'.gif';
if (file_exists($filename)) {
	$fichierserveur=$data['id'].'.gif';
}

$filename = 'ressources/'.$data['id'].'.png';
if (file_exists($filename)) {
	$fichierserveur=$data['id'].'.png';
}


if ($fichierserveur=="") {
	$picto="f.png";
	if ($typemedia=="audio") {
		$picto="hp_160.png";
	}
	if ($typemedia=="video") {
		$picto="video.png";
	}
	echo '<a href="'.$lien.'"><img src="visuel/pictos/'.$picto.'" border="0"></a>'.chr(10);
} else {
	echo '<a href="'.$lien.'"><img src="ressources/'.$fichierserveur.'" border="0" width="200"></a>'.chr(10);
}
													echo '</td>'.chr(10);

													echo '<td align="left">'.chr(10);
														echo '<span class="texte_default">'.$nom.'</span><br><br>'.chr(10);
														//echo '<span class="texte_default">'.$description.'</span>'.chr(10);
													echo '</td>'.chr(10);

												echo '</tr>'.chr(10);
											echo '</table>'.chr(10);

										echo '</td>'.chr(10);
									echo '</tr>'.chr(10);		
								echo '</table>'.chr(10);

						}



}
?>