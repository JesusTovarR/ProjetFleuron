<?php
function affichage_ressourcenotes($idressource,$notes,$regarder,$comprendre,$aimer,$suivre,$page)
	{

			global $lg,$categorie,$pageencours,$idprofil,$motcle;
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
						$couleurzone = couleur(1);
					}

					if ($data['offline']==1 AND $_SESSION['niveau']<2) {

					} else {
$lien='ressources_media.php?lg='.$lg.'&idressource='.$data['id'].'&categorie='.$data['categorie'].'&pageencours='.$page.'&idprofil='.$_SESSION['id'].'&motcle='.$motcle;
						echo '<tr>';
							echo '<td>';
								echo '<a name="'.$data['id'].'"></a>';
								echo '<table border="0" cellspacing="0" bgcolor="#E5E4DF">';
									echo '<tr>';
										echo '<td align="center">';
											echo '<table border="0" cellpadding="4" cellspacing="0"width="600" height="60">';
												echo '<tr>';
													echo '<td align="center" width="200" bgcolor="#E5E4DF" valign="top">';
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
	echo '<a href="'.$lien.'"><img src="visuel/pictos/'.$picto.'" border="0"></a>';
} else {
	echo '<a href="'.$lien.'"><img src="ressources/'.$fichierserveur.'" border="0" width="200"></a>';
}
													if ($data['nom_fr']<>"") {
														echo '<span class="texte_default">'.$nom.'</span><br><br>';
													}
														echo '<span class="texte_default">'.substr($description,0,125).'...</span>';

													echo '</td>';
													echo '<td align="left" valign="top">';
													if ($notes<>'') {
if ($motcle<>"") {
	$notes = str_ireplace($motcle, '<b>'.$motcle.'</b>', $notes);
}
														echo '<span class="Texte_default">'.$notes.'</span>';
													}
													if ($regarder<>'') {
														echo '<br><br>';
														echo '<span class="Texte_defaultGras">'.new_versionlinguistique("text85").'</span>';
if ($motcle<>"") {
	$regarder = str_ireplace($motcle, '<b>'.$motcle.'</b>', $regarder);
}
														echo '<br><span class="Texte_default">'.$regarder.'</span>';
													}
													if ($comprendre<>'') {
														echo '<br><br>';
														echo '<span class="Texte_defaultGras">'.new_versionlinguistique("text86").'</span>';
if ($motcle<>"") {
	$comprendre = str_ireplace($motcle, '<b>'.$motcle.'</b>', $comprendre);
}
														echo '<br><span class="Texte_default">'.$comprendre.'</span>';
													}
													if ($aimer<>'') {
														echo '<br><br>';
														echo '<span class="Texte_defaultGras">'.new_versionlinguistique("text87").'</span>';
if ($motcle<>"") {
	$aimer = str_ireplace($motcle, '<b>'.$motcle.'</b>', $aimer);
}
														echo '<br><span class="Texte_default">'.$aimer.'</span>';
													}
													if ($aimer<>'') {
														echo '<br><br>';
														echo '<span class="Texte_defaultGras">'.new_versionlinguistique("text88").'</span>';
if ($motcle<>"") {
	$suivre = str_ireplace($motcle, '<b>'.$motcle.'</b>', $suivre);
}
														echo '<br><span class="Texte_default">'.$suivre.'</span>';
													}
													echo '</td>';

												echo '</tr>';
											echo '</table>';
										echo '</td>';
									echo '</tr>';		
								echo '</table>';
							echo '</td>';
						echo '</tr>';
						}


					}
}
?>