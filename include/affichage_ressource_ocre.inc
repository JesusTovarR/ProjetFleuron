<?php
function affichage_ressource($idressource)
	{

			global $lg,$categorie,$pageencours,$idprofil;
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

					if ($data['offline']==1) {
						$couleurzone = "#696969";
					} else {
						$couleurzone = couleur(1);
					}

					if ($data['offline']==1 AND $_SESSION['niveau']<2) {

					} else {

$lien='ressources_media.php?lg='.$lg.'&idressource='.$data['id'].'&categorie='.$data['categorie'].'&pageencours='.$pageencours.'&idprofil='.$idprofil;
						echo '<tr>';
							echo '<td>';
								echo '<a name="'.$data['id'].'"></a>';
								echo '<table border="0" cellspacing="0">';
									echo '<tr>';
										echo '<td align="center">';
											echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.$couleurzone.'" width="600" height="60">';
												echo '<tr>';
													echo '<td align="center" width="200">';
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
	echo '<a href="'.$lien.'"><img src="visuel/pictos/f.png" border="0"></a>';
} else {
	echo '<a href="'.$lien.'"><img src="ressources/'.$fichierserveur.'" border="0" width="200"></a>';
}
													echo '</td>';
													echo '<td align="left">';
													if ($data['nom_fr']<>"") {
														echo '<span class="texte_info12">'.$nom.'</span><br><br>';
													}
														echo '<span class="texte_info12">'.$description.'</span>';
													echo '</td>';
													echo '<td valign="top" width="35">';
if ($_SESSION['id']<>'') {
														echo '<iframe src="favoris.php?ressource='.$data['id'].'&id='.$_SESSION['id'].'" name="notes" width="35" scrolling="NO" height="35" frameborder="yes"></iframe>';
}
													echo '</td>';
												echo '</tr>';
											echo '</table>';
										echo '</td>';
									echo '</tr>';		

							if ($_SESSION['niveau']>1) {
									echo '<tr>';
										echo '<td colspan="2" align="right">';
											echo '<table>';
												echo '<tr>';
													echo '<td>';
														echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100">';
															echo '<tr>';
															if ($data['offline']==1) {
																$textebouton = "Online";
																$flag = 0;
															} else {
																$textebouton = "Offline";
																$flag = 1;
															}
																echo '<td align="center"><a href="ressource_onoffline.php?lg='.$lg.'&id='.$data['id'].'&categorie='.$data['categorie'].'&flag='.$flag.'&pageencours='.$pageencours.'&idprofil='.$idprofil.'"><span class="texte_info12">'.$textebouton.'</span></a></td>';
															echo '</tr>';
														echo '</table>';
													echo '</td>';
													echo '<td>';
														echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100">';
															echo '<tr>';
																echo '<td align="center"><a href="ressource_edit.php?lg='.$lg.'&id='.$data['id'].'&categorie='.$data['categorie'].'&pageencours='.$pageencours.'&idprofil='.$idprofil.'"><span class="texte_info12">'.versionlinguistique(47).'</span></a></td>';
															echo '</tr>';
														echo '</table>';
													echo '</td>';
													echo '<td>';
														echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100">';
															echo '<tr>';
																echo '<td align="center"><a href="ressource_suppr.php?lg='.$lg.'&id='.$data['id'].'&categorie='.$data['categorie'].'&pageencours='.$pageencours.'&idprofil='.$idprofil.'"><span class="texte_info12">'.versionlinguistique(48).'</span></a></td>'; // supprimer
															echo '</tr>';
														echo '</table>';
													echo '</td>';
												echo '</tr>';
											echo '</table>';
										echo '</td>';
									echo '</tr>';
								}

								echo '</table>';
							echo '</td>';
						}

						$nb=$nb+1;
						echo '</tr>';
					}
}
?>