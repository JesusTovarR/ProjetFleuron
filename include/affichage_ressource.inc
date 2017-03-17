<?php
function affichage_ressource($idressource)
	{

	global $lg,$categorie,$pageencours,$refpage,$motcleorigine,$idprofil;


$nb=0;
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

					if ($data['offline']==1 AND $_SESSION['niveau']<2) {

					} else {

$lien='ressources_media.php?lg='.$lg.'&idressource='.$data['id'].'&categorie='.$data['categorie'].'&pageencours='.$pageencours.'&refpage='.$refpage.'&idprofil='.$idprofil.'&motcle='.$motcleorigine;
						echo '<tr>'.chr(10);
							echo '<td>'.chr(10);
								echo '<a name="'.$data['id'].'"></a>'.chr(10);
								echo '<table border="0" cellspacing="4" bgcolor="#E5E4DF">'.chr(10);
									echo '<tr>'.chr(10);
										echo '<td align="center">'.chr(10);
											echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.$couleurzone.'" width="600" height="60">'.chr(10);
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


if (! isset($fichierserveur)) {
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
													if ($data['nom_fr']<>"") {
if ($motcleorigine<>"") {
	$nom = str_ireplace($motcleorigine, '<b>'.$motcleorigine.'</b>', $nom);
}
														echo '<span class="texte_default">'.$nom.'</span><br><br>'.chr(10);
													}
if ($motcleorigine<>"") {
	$description = str_ireplace($motcleorigine, '<b>'.$motcleorigine.'</b>', $description);
}
														echo '<span class="texte_default">'.$description.'</span>'.chr(10);
													echo '</td>'.chr(10);
													echo '<td valign="top" width="35">'.chr(10);
if (isset($_SESSION['id'])) {
														echo '<iframe src="favoris.php?ressource='.$data['id'].'&id='.$_SESSION['id'].'" name="notes" width="35" scrolling="NO" height="35" frameborder="yes"></iframe>'.chr(10);
}
													echo '</td>'.chr(10);

												echo '</tr>'.chr(10);
											echo '</table>'.chr(10);
										echo '</td>'.chr(10);
									echo '</tr>'.chr(10);		

							if ($_SESSION['niveau']>1) {
									echo '<tr>'.chr(10);
										echo '<td colspan="2" align="right">'.chr(10);
											echo '<table>'.chr(10);
												echo '<tr>'.chr(10);
													echo '<td>'.chr(10);
														echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100">'.chr(10);
															echo '<tr>'.chr(10);
															if ($data['offline']==1) {
																$textebouton = "Online";
																$flag = 0;
															} else {
																$textebouton = "Offline";
																$flag = 1;
															}
																echo '<td align="center"><a href="ressource_onoffline.php?lg='.$lg.'&id='.$data['id'].'&categorie='.$data['categorie'].'&flag='.$flag.'&pageencours='.$pageencours.'&idprofil='.$idprofil.'"><span class="texte_info12">'.$textebouton.'</span></a></td>'.chr(10);
															echo '</tr>'.chr(10);
														echo '</table>'.chr(10);
													echo '</td>'.chr(10);
													echo '<td>'.chr(10);
														echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100">'.chr(10);
															echo '<tr>'.chr(10);
																echo '<td align="center"><a href="ressource_edit.php?lg='.$lg.'&id='.$data['id'].'&categorie='.$data['categorie'].'&pageencours='.$pageencours.'&idprofil='.$idprofil.'"><span class="texte_info12">'.afficher_ressource('option1').'</span></a></td>'.chr(10);
															echo '</tr>'.chr(10);
														echo '</table>'.chr(10);
													echo '</td>'.chr(10);
													echo '<td>'.chr(10);
														echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100">'.chr(10);
															echo '<tr>'.chr(10);
																echo '<td align="center"><a href="ressource_suppr.php?lg='.$lg.'&id='.$data['id'].'&categorie='.$data['categorie'].'&pageencours='.$pageencours.'&idprofil='.$idprofil.'"><span class="texte_info12">'.versionlinguistique('option2').'</span></a></td>'.chr(10); // supprimer
															echo '</tr>'.chr(10);
														echo '</table>'.chr(10);
													echo '</td>'.chr(10);
												echo '</tr>'.chr(10);
											echo '</table>'.chr(10);
										echo '</td>'.chr(10);
									echo '</tr>'.chr(10);
								}

								echo '</table>'.chr(10);
							echo '</td>'.chr(10);
						}

						$nb=$nb+1;
						echo '</tr>'.chr(10);
					}
}
?>