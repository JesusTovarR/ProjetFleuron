<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



$motcle=$_GET["motcle"];
$motcleorigine=$motcle;

if (isset($_GET["action"])) {
	$nope=$_GET["nope"];
} else {
	$nope=0;	
}

if ($nope==1) {
$_SESSION['motcle']=$motcle;
} else {
$_SESSION['motcle']="";
}

if (! isset($_SESSION['id'])) {
	$_SESSION['id']=0;
}
$idprofil = $_SESSION['id'];

if (! isset($refpage)) {
	$refpage="";
}

$avapr = array(".",",",":",";","'"," ",""); // tableau des caractères autorisés avant et près le mot clé

$taille=40;
$compteurcon=0;
compteur_concordancier($motcle);

$reftaille=$compteurcon*28;

$taille=$taille+$reftaille;
if ($compteurcon<3) {
$taille=$taille+300;
}

compteur_ressource($motcleorigine);

if ($_SESSION['id']>0) {
compteur_notes($motcleorigine);
}

//************************************************************************
//		enregistrement mot recherché (ou compteur) si $compteurcon>0
//************************************************************************

if ($_SESSION['motcle']==$motcle) {

} else {

	if ($compteurcon>0) {


//			vérification si le mot a déjà été recherché
		$requete = 'SELECT COUNT(mot) AS total FROM recherche WHERE mot="'.$motcle.'"';
		$recup = mysql_query($requete);
		$data = mysql_fetch_assoc($recup);
		$nbmot = $data['total']; 


		if ($nbmot>0) {


			$requete = 'SELECT visiteur FROM recherche WHERE mot="'.$motcle.'"';
			$recup2 = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup2))
					{
						$visiteur = $data['visiteur'];
					}

			$totalvisiteur = $visiteur + 1;
			$requete ='UPDATE `recherche` SET ';
			$requete =$requete.'`visiteur`='.$totalvisiteur;
			$requete =$requete.' WHERE mot="'.$motcle.'"';

			mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


		} else {


			$requete ='INSERT INTO `recherche` (`id`,`mot`,`visiteur`) VALUES (NULL,'; // début de la composition de la requete de mise à jour
			$requete = $requete.'\''.$motcle.'\',';
			$requete = $requete.'1)';

			mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete
		}

	}
	$_SESSION['motcle']=$motcle;
}

//************************************************************************
//		Compteur du concordancier
//************************************************************************
function compteur_concordancier($motcle)
	{

	global $compteurcon,$avapr,$refpage;
	$requete = 'SELECT * FROM ressources';
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
	$ok=0;
				$virerapos=$data['Transcription'];
				if (stripos(strtolower($virerapos),strtolower($motcle))>0)
					{


					$fichier = 'ressources/'.$data['id'].'.srt'; // fichier
					if (file_exists($fichier))
						{

						$lignes = file($fichier);
						$lignes=str_replace("Ã´","ô",$lignes);
						$lignes=str_replace("Ã©","é",$lignes);
						$lignes=str_replace("Ã","à",$lignes);
						$lignes=str_replace("à¨","è",$lignes);
						$lignes=str_replace("àª","ê",$lignes);
						$lignes=str_replace("à§","ç",$lignes);
						$lignes=str_replace("à»","û",$lignes);
						$lignes=str_replace("à¢","â",$lignes);
						$lignes=str_replace(chr(13),"",$lignes);
						$lignes=str_replace(chr(10),"",$lignes);
						$lignes=str_replace("  "," ",$lignes);
						$lignes=str_replace("à ","à",$lignes);
						$lignes=str_replace("à¹","ù",$lignes);
						$lignes=str_replace("ù ","ù",$lignes);

						foreach($lignes as $ligne_num => $ligne)
							{
	$ok=0;
								if (substr($ligne,0,3)=="00:") 
									{
									$timecode=str_replace(",",".",substr($ligne,0,12));
									}
									$position = stripos(strtolower($ligne),strtolower($motcle));
									if ($position>-1) 
										{
											$av = substr($ligne,$position-1,1); // caractère précédent le mot clé
											$apr = substr($ligne,$position+strlen($motcle),1); // caractère suivant le mot clé

											if(!in_array($apr, $avapr)) // si le caractère suivant n'est pas autorisé d'après le tableau
												{
												} else {
													$ok+=1;
												}
											if(!in_array($av, $avapr))  // si le caractère précédent n'est pas autorisé d'après le tableau
												{
												} else {
													$ok+=1;
												}
											if ($ok>1) {
												$compteurcon=$compteurcon+1;
											}
										}

								}

							}
						}

			}

	}

//************************************************************************
//		compteur des ressources trouvées
//************************************************************************
function compteur_ressource($motcle)
	{
	global $lg,$compteurressources,$avapr;
	$compteurressources = 0;

if ($lg=="") {
	$lg="fr";
}

	$requete = 'SELECT * FROM ressources';
	$recup = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup))
			{
	$ok=0;
				$zone = " ".$data['typemedia']." ".$data['nom_'.$lg]." ".$data['nom_fr']." ".$data['description_'.$lg]." ".$data['description_fr']." ";
				$position = stripos(strtolower($zone),strtolower($motcle)); // position du mot clé
				if ($position>-1) {
					$av = substr($zone,$position-1,1); // caractère précédent le mot clé
					$apr = substr($zone,$position+strlen($motcle),1); // caractère suivant le mot clé
//echo '-apr='.$apr.'->';


					if(!in_array($apr, $avapr)) // si le caractère suivant n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}
					

//echo 'ok1='.$ok.'-';	
//echo '- av='.$av.'->';

					if(!in_array($av, $avapr))  // si le caractère précédent n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}

//echo 'ok2='.$ok.'-';
//echo '--totalOk='.$ok.'------';
					if ($ok>1) {
						$compteurressources+=1;
					}
				}
			}

	}
//************************************************************************
//		Compteur des notes trouvées
//************************************************************************
function compteur_notes($motcle)
	{
	global $lg,$compteurnotes,$avapr;
	$compteurnotes = 0;
	$requete = 'SELECT * FROM notes WHERE profil='.$_SESSION['id'].' ORDER BY jour DESC';
	$recup = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup))
			{
				$notes=$data['notes'];
				$regarder=$data['regarder'];
				$comprendre=$data['comprendre'];
				$aimer=$data['aimer'];
				$suivre=$data['suivre'];

				$zone = $notes." ".$regarder." ".$comprendre." ".$aimer.$suivre;

				$position = stripos(strtolower($zone),strtolower($motcle));
				if ($position>-1) {
					$av = substr($zone,$position-1,1); // caractère précédent le mot clé
					$apr = substr($zone,$position+strlen($motcle),1); // caractère suivant le mot clé
//echo '-apr='.$apr.'->';


					if(!in_array($apr, $avapr)) // si le caractère suivant n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}
					

//echo 'ok1='.$ok.'-';	
//echo '- av='.$av.'->';

					if(!in_array($av, $avapr))  // si le caractère précédent n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}

//echo 'ok2='.$ok.'-';
//echo '--totalOk='.$ok.'------';
					if ($ok>1) {
						$compteurnotes=$compteurnotes+1;
					}

				}
			}

	}

//************************************************************************
//		Affichage du Concordancier
//************************************************************************
function affichage_concordancier($motcle)
	{
	global $lg,$compteur,$motcleorigine,$avapr,$refpage;
	$requete = 'SELECT * FROM ressources';
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
	$ok=0;
				$virerapos=str_replace("'","*",$data['Transcription']);
				if (stripos(strtolower($virerapos),strtolower($motcle))>0)
					{


					$fichier = 'ressources/'.$data['id'].'.srt'; // fichier
					if (file_exists($fichier))
						{

						$lignes = file($fichier);
						$lignes=str_replace("Ã´","ô",$lignes);
						$lignes=str_replace("Ã©","é",$lignes);
						$lignes=str_replace("Ã","à",$lignes);
						$lignes=str_replace("à¨","è",$lignes);
						$lignes=str_replace("àª","ê",$lignes);
						$lignes=str_replace("à§","ç",$lignes);
						$lignes=str_replace("à»","û",$lignes);
						$lignes=str_replace("à¢","â",$lignes);
						$lignes=str_replace(chr(13),"",$lignes);
						$lignes=str_replace(chr(10),"",$lignes);
						$lignes=str_replace("  "," ",$lignes);
						$lignes=str_replace("à ","à",$lignes);
						$lignes=str_replace("à¹","ù",$lignes);
						$lignes=str_replace("ù ","ù",$lignes);

						foreach($lignes as $ligne_num => $ligne)
							{
	$ok=0;
								if (substr($ligne,0,3)=="00:") 
									{
									$timecode=str_replace(",",".",substr($ligne,0,12));
									}
								$position = stripos(strtolower($ligne),strtolower($motcle));
								if ($position>-1) 
									{
					$av = substr($ligne,$position-1,1); // caractère précédent le mot clé
					$apr = substr($ligne,$position+strlen($motcle),1); // caractère suivant le mot clé

					if(!in_array($apr, $avapr)) // si le caractère suivant n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}
					

//echo 'ok1='.$ok.'-';	
//echo '- av='.$av.'->';

					if(!in_array($av, $avapr))  // si le caractère précédent n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}

//echo 'ok2='.$ok.'-';
//echo '--totalOk='.$ok.'------';
					if ($ok>1) {
							echo '<tr>';
										$posdeuxpoints = strpos($ligne,":");
										$tailleligne = strlen($ligne);
										$lignenettoye = substr($ligne,$posdeuxpoints+1,$tailleligne-$posdeuxpoints);

										$ele = explode($motcle,$lignenettoye);

										echo '<td width="350"class="td" align="right" valign="top">';
											echo $ele[0];
										echo '</td>';
										echo '<td width="100" align="center" valign="top">';
											echo '<a href="ressources_media.php?lg='.$lg.'&idressource='.$data['id'].'&refpage='.$refpage.'&motcle='.$motcleorigine.'&timecode='.$timecode.'" target="_top"><span class="">'.$motcle.'</span></a>';
										echo '</td>';
										echo '<td width="350" valign="top">';
											echo $ele[1];
										echo '</td>';
									$compteur=$compteur+1;
							echo '</tr>';
									}
						}

							}



						}




				}

			}
	}

//************************************************************************
//		Affichage des ressources trouvées
//************************************************************************
function affichage_ressourcelist($motcleorigine)
	{ 
	global $lg,$compteurressources,$avapr;
	$compteurressources = 0;
	$requete = 'SELECT * FROM ressources';
	$recup = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup))
			{
	$ok=0;
				$zone = " ".$data['typemedia']." ".$data['nom_'.$lg]." ".$data['nom_fr']." ".$data['description_'.$lg]." ".$data['description_fr']." ";
				$position = stripos(strtolower($zone),strtolower($motcleorigine)); // position du mot clé
				if ($position>-1) {
//echo $zone.'<br>';
					$av = substr($zone,$position-1,1); // caractère précédent le mot clé
					$apr = substr($zone,$position+strlen($motcleorigine),1); // caractère suivant le mot clé
//echo '-apr='.$apr.'->';

					if(!in_array($apr, $avapr)) // si le caractère suivant n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}
					

//echo 'ok1='.$ok.'-';	
//echo '- av='.$av.'->';

					if(!in_array($av, $avapr))  // si le caractère précédent n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}

//echo 'ok2='.$ok.'-';
//echo '--totalOk='.$ok.'------';
					if ($ok>1) {
					affichage_ressource($data['id']);
					$compteurressources=$compteurressources+1;
					}
				}
			}
					if ($compteurressources==0) {
						echo'<br><br><br>';
						echo '<tr><td><span class="texte_defaultGras">Aucun résultat trouvé</span>';
					}

	}

//************************************************************************
//		Affichage des notes trouvées
//************************************************************************
function affichage_noteslist($motcleorigine)
	{
	global $lg,$compteurnotes,$motcleorigine,$avapr;
	$compteurnotes = 0;
	$requete = 'SELECT * FROM notes WHERE profil='.$_SESSION['id'].' ORDER BY jour DESC';
	$recup = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup))
			{
				$notes=$data['notes'];
				$regarder=$data['regarder'];
				$comprendre=$data['comprendre'];
				$aimer=$data['aimer'];
				$suivre=$data['suivre'];

				$zone = " ".$notes." ".$regarder." ".$comprendre." ".$aimer.$suivre;

				$position = stripos(strtolower($zone),strtolower($motcleorigine));
				if ($position>-1) {
					$av = substr($zone,$position-1,1); // caractère précédent le mot clé
					$apr = substr($zone,$position+strlen($motcleorigine),1); // caractère suivant le mot clé
//echo '-apr='.$apr.'->';

					if(!in_array($apr, $avapr)) // si le caractère suivant n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}
					

//echo 'ok1='.$ok.'-';	
//echo '- av='.$av.'->';

					if(!in_array($av, $avapr))  // si le caractère précédent n'est pas autorisé d'après le tableau
						{
						} else {
							$ok+=1;
						}

//echo 'ok2='.$ok.'-';
//echo '--totalOk='.$ok.'------';
					if ($ok>1) {
						affichage_ressourcenotes($data['ressource'],$notes,$regarder,$comprendre,$aimer,$suivre,$page);
						$compteurnotes=$compteurnotes+1;
					}

				}
			}
					if ($compteurnotes==0) {
						echo'<br><br><br>';
						echo '<tr><td><span class="texte_defaultGras">Aucun résultat trouvé</span>';
					}
	}

include('include/affichage_ressource.inc'); // affichage des ressources dans une liste	
include('include/affichage_ressource_notes.inc'); // affichage des ressources dans une liste	
?>
<html>

	<head>
		<?php include('include/head.inc');  // header ?>
		<?php include('include/alexandria.inc');  ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>
	</head>

	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="white" onload="TabClick(0);">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
			<tr height="67">
				<td align="center" valign="middle" bgcolor="<?php echo couleur(2); // couleur claire ?>" height="67">
					<!-- Module affichage du bandeau contenant le logo FLEURON -->
					<?php include('include/logo_fleuron.inc');  ?>
				</td>
			</tr>
			<tr height="40">
				<td bgcolor="<?php echo couleur(1); //couleur foncée ?>" height="40" align="center">
					<?php 
						// Menu Supérieur 
						include('include/menu_top.inc'); 

					?>
				</td>
			</tr>
			<tr>
				<td bgcolor="#f6f5ed" align="center" valign="top">
<!-- Partie centrale -->
					<table border="0" cellpadding="2" cellspacing="2" width="800">
						<tr>

							<td valign="top" width="100%" align="center">
			<form name="FormName" action="moteurderecherche_tmp.php" target="_top" method="post">
				<table border="0" cellpadding="5" cellspacing="2" bgcolor="<?php echo couleur(2); // couleur clair ?>" >
					<tr>
						<td colspan="2" align="center">
							<span class="texte_menu"><?php echo versionlinguistique(124) //Concordancier ?></span>
						</td>
						<td colspan="2" align="center">
							<input type="text" name="motcle" size="24" value="<?php echo $motcleorigine //Mot clé ?>">
						</td>
						<td colspan="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>">
								<button id="buton1" class="stbutton" ><?php echo versionlinguistique(11) //Rechercher ?></button>
						</td>
					</tr>
				</table>
			</form>
								<table width="850">
									<tr>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(0);" width="200" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(114) //Concordancier ?> (<?php echo $compteurcon ?>)</td>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(1);" width="200" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(115) //Ressources ?> (<?php echo $compteurressources ?>)</td>
									<?php $nb=1 ?>
									<?php if ($_SESSION['id']>0) { $nb=$nb+1 ?>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(<?php echo $nb ?>);" width="200" valign="middle" onmouseover="this.style.cursor='pointer';"><?php echo versionlinguistique(117) //Mes notes ?> (<?php echo $compteurnotes ?>)</td>
									<?php } ?>
									<?php $nb=$nb+1 ?>
										<td class="TabBorderBottom TabCommon TabOff" id="tabs" name="tabs" onclick="TabClick(<?php echo $nb ?>);" width="200" valign="middle" onmouseover="this.style.cursor='pointer';">CNRTL</td>
									</tr>
								</table>
								<div id="Content" name="Content" align="center">
		<center>
                <style type="text/css"> 
.table {
 border-collapse:collapse;
 border-style:solid; 
 border-color:black;

 }
.td { 
 border-width:1px;
 border-style:solid; 
 border-color:black;

 }
.grise {
 border:1px solid black; 
 background-color:#dbdbdb;
 padding:5;
 }
.blue {
 border:1px solid blue; 
 }
.none {
 border-style:none;

 }
		</style>

		<table border="1" class="table" width="880">
			<tr>
				<td align="center" class="grise">
					<span class="texte_defaultGras"><?php echo versionlinguistique(118) //à gauche du mot ?></span>
				</td>
				<td align="center" width="50" class="grise">
					<span class="texte_defaultGras"><?php echo versionlinguistique(119) //Mot recherché ?></span>
				</td>
				<td align="center" class="grise">
					<span class="texte_defaultGras"><?php echo versionlinguistique(120) //à droite du mot ?></span>
				</td>
			</tr>
				<?php 
					if ( strlen($motcle)>0) {
						affichage_concordancier($motcle);
					} 
				?>
		</table>
				<?php 
					if ($compteur==0) {
						echo'<br><br><br>';
						echo '<span class="texte_defaultGras">Aucun résultat trouvé</span>';
					}
				?>
		</center><br>

								</div>
								<div id="Content" name="Content" align="center">
									<table>
										<?php affichage_ressourcelist($motcleorigine) ?>
									</table>
								</div>
							<?php if ($_SESSION['id']>0) { ?>
								<div id="Content" name="Content" align="center">
									<table>
										<?php affichage_noteslist($motcleorigine) ?>
									</table>
								</div>
							<?php } ?>
								<div id="Content" name="Content" align="center">
									<iframe src="http://www.cnrtl.fr/definition/<?php echo $motcleorigine ?>" name="atilf" width="910" scrolling="AUTO" height="600" frameborder="0"></iframe>
								</div>

							</td>
						</tr>
					</table>
				<?php if ($compteur>25) { ?>
						<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
							<tr>
								<td align="center">
									<a href="#"><span class="texte_menu"><?php echo versionlinguistique(122) //haut de la page ?></span></a>
								</td>
							</tr>
						</table>
					<?php } ?>
<?php if ($compteurcon>15){ ?>
			<br><form name="FormName" action="moteurderecherche_tmp.php" target="_top" method="post">
				<table border="0" cellpadding="5" cellspacing="2" bgcolor="<?php echo couleur(2); // couleur clair ?>" >
					<tr>
						<td colspan="2" align="center">
							<span class="texte_menu"><?php echo versionlinguistique(124) //Rechercher ?></span>
						</td>
						<td colspan="2" align="center">
							<input type="text" name="motcle" size="24" value="<?php echo $motcleorigine //Mot clé ?>">
						</td>
						<td colspan="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>">
								<button id="buton1" class="stbutton" ><?php echo versionlinguistique(11) //Rechercher ?></button>
						</td>
					</tr>
				</table>
			</form>
<?php } ?>
<!-- Fin de la partie centrale -->
				</td>
			</tr>
			<tr height="40">
				<td bgcolor="<?php echo couleur(2); // couleur clair ?>" height="40" align="center">
					<!-- Module d'affichage du bandeau de bas de page  -->
					<?php include('include/bandeau_basdepage.inc');  ?>
				</td>
			</tr>
			<tr height="150">
				<td height="150" align="center">
					<!-- Module d'affichage du dernier media publié  -->
					<?php include('include/logo_basdepage.inc');  ?>
				</td>
			</tr>

		</table>

	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>