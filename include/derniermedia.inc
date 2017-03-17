<?php

function affichage_last()
 {

	global $lg,$idprofil,$pageencours;
$requete = 'SELECT id FROM ressources  WHERE offline<>1 ORDER BY id DESC LIMIT 1';
$dernierressource=mysql_query($requete);
while ($data = mysql_fetch_assoc($dernierressource))
{ $dernierid = $data['id']; }

			$requete = 'SELECT * FROM ressources WHERE id='.$dernierid;
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
						$couleurzone = couleur(1);
					}

					if ($data['offline']==1 AND $_SESSION['niveau']<2) {

					} else {


						$lien='ressources_media.php?lg='.$lg.'&idressource='.$data['id'].'&categorie='.$data['categorie'].'&pageencours='.$pageencours.'&idprofil='.$idprofil;

						echo '<table border="0" cellpadding="4" cellspacing="0">';
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


							if (!isset($fichierserveur)) {
								$picto="f.png";
								if ($typemedia=="audio") {
									$picto="hp_160.png";
									}
								if ($typemedia=="video") {
									$picto="video.png";
									}
									echo '<a href="'.$lien.'"><img src="visuel/pictos/'.$picto.'" border="0"></a>';
								} else {
									echo '<a href="'.$lien.'"><img src="ressources/'.$fichierserveur.'" border="0" width="200"></a>';
								}
													echo '</td>';
												echo '</tr>';
												echo '<tr>';
													echo '<td align="left">';
													if ($data['nom_fr']<>"") {
														echo '<span class="texte_info10">'.$nom.'</span><br><br>';
													}
														echo '<span class="texte_info10">'.$description.'</span>';
														//echo '<a href="'.$lien.'"><span class="texte_info8">('.$data['jour'].')</span></a>';
													echo '</td>';
												echo '</tr>';
											echo '</table>';



					}
				}
}

?>
											<table border="0" cellpadding="5" cellspacing="2" bgcolor="<?php echo couleur(2); // couleur claire ?>" width="220">
												<tr>
													<td colspan="2" align="center">
														<center>
															<span class="texte_info10"><?php echo dernier_media() //Dernier media publié ?></span></center>
													</td>
												</tr>
												<tr>
													<td colspan="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>">
														<?php affichage_last() ?>
													</td>
												</tr>
											</table>