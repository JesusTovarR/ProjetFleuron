<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$categorie=$_GET["categorie"];
$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];
$retour=$_GET["retour"];
if ($retour=="") {
$retour=$_GET["pageencours"];
}

// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');


include('include/recuperation_nom_categorie.inc'); // Routines d'affichage du nom de la catégorie retenue
?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<!--  *********************************************************************   -->
		<!--                           Jquery -  srt - subtitle                       -->
		<!--  *********************************************************************   -->
		<script  type="text/javascript" src="scripts/jquery.js" charset="utf-8" ></script>
                <!--     Soustitres       -->
		<script type="text/javascript"  src="scripts/jquery.srt.js" charset="utf-8"></script>
		<script type="text/javascript" src="scripts/jquery.subtitle.js" charset="utf-8"></script>
		<!-- ***********************************************************************  -->
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>

        <script type='text/javascript'>
		var videoId = 'video';
		var scaleFactor = 0.65;
		var snapshots = [];
 
/**
 * Captures a image frame from the provided video element.
 *
 * @param {Video} video HTML5 video element from where the image frame will be captured.
 * @param {Number} scaleFactor Factor to scale the canvas element that will be return. This is an optional parameter.
 *
 * @return {Canvas}
 */
function capture(video, scaleFactor) {
    if(scaleFactor == null){
        scaleFactor = 1;
    }
    var w = video.videoWidth * scaleFactor;
    var h = video.videoHeight * scaleFactor;
    var canvas = document.createElement('canvas');
        canvas.width  = w;
        canvas.height = h;
    var ctx = canvas.getContext('2d');
        ctx.drawImage(video, 0, 0, w, h);
    return canvas;
} 
 
/**
 * Invokes the <code>capture</code> function and attaches the canvas element to the DOM.
 */
function shoot(){
    var video  = document.getElementById(videoId);
    var output = document.getElementById('output');
    var canvas = capture(video, scaleFactor);
        canvas.onclick = function(){
            window.open(this.toDataURL());
        };
    snapshots.unshift(canvas);
    output.innerHTML = '';
    for(var i=0; i<1; i++){
        output.appendChild(snapshots[i]);
    }


}
        </script>

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
					<table border="0" cellpadding="2" cellspacing="2" width="860">
						<tr>
<!-- Partie centrale -->
							<td valign="top" width="580">
								<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr>
										<td width="80">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="80" height="44">
												<tr>
													<td align="center">
														<a href="ressources_media.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center" bgcolor="<?php echo couleur(2) //couleur claire ?>">

<?php
					if ($offline==1) {
?>

								<span class="titreoffline"><?php echo $nom; //Titre de la ressource ?> (offline)</span>

<?php
					} else {
?>

								<span class="titre"><?php echo $nom; //Titre de la ressource ?></span>
<?php
					}
?>


										</td>

									</tr>
								</table>


<!-- ******************************************************************************** -->
<!-- *********************** Affichage du media de la ressource********************** -->
<!-- ******************************************************************************** -->
								<div id="Content" name="Content" align="center">


	<?php if ($typemedia=="video") { ?>
<!-- ----------------------------------------------------------------------- -->
<!-- ----------------------- Affichage du media VIDEO ---------------------- -->
<!-- ----------------------------------------------------------------------- -->
	<!-- Affichage controleur VIDEO -->
			<video  id="video"  controls  width="480" height="400" >
				<source src="ressources/<?php echo $idressource ?>.ogv" type='video/ogg; codecs="theora, vorbis"' >
				<source src="ressources/<?php echo $idressource ?>.mp4" >
				
				Erreur!!! Changer de navigateur!!!
			</video>
 <br>   <button onclick="shoot()" class="stbuttonImp"><?php echo versionlinguistique(111) //Capturer ?></button><br/>
<!-- **************************************************************************** -->
<!-- 			The display "output" of the preview			 -->
<!-- **************************************************************************** -->
  <br>  <div id="output" style="display: inline-block; top: 4px; position: relative ;border: dotted 0px #ccc; padding: 2px;"></div>
<!-- **************************************************************************** -->
<!-- ***** Fin affichage video -->
	<?php } ?>

<br>
<span class="texte_note">Fichier .jpg, .jpeg,.gif,.png</span>
		<form method="POST" action="ressources_media_editer_vignettte_fichier_upload.php" enctype="multipart/form-data">				
			<table border="0" cellpadding="4" cellspacing="2" width="400">
				<tr>
					<td align="center">
						<input type="file" name="media">
					</td>
					<td align="center">
						<button id="buton1"  type="submit" class="stbuttonImp" ><?php echo versionlinguistique(112) //Publier ?></button>
					</td>
				</tr>
			</table>
	<input type="hidden" value="<?php echo $idressource ?>" name="idressource">
	<input type="hidden" value="<?php echo $retour ?>" name="retour">
											</form> 

<!-- ******************************************************************************** -->
<!-- ******************* Fin de l'affichage du media de la ressource***************** -->
<!-- ******************************************************************************** -->
								</div>

							</td>
<!-- Fin partie centrale -->
<!-- Colonne de droite -->
							<td width="360" align="right" valign="top">
								<table border="0" cellpadding="1" cellspacing="2">
									<tr>
										<td align="center">
<!-- Module d'affichage du formulaire de recherche  -->
<?php include('include/moteurderecherche.inc');  ?>
											</td>
									</tr>
									<tr>
										<td align="center">
<!-- Module d'affichage menu admin  -->
<?php include('include/menu_admin.inc');  ?>
												
										</td>
									</tr>
			<tr>
				<td>
					<span class="Texte_defaultGras">Procédure :</span>
					<span class="Texte_default"><br>1. Choisir une vue dans la vidéo.</span>
					<span class="Texte_default"><br>2. Cliquer sur le bouton "Capturer".</span>
					<span class="Texte_default"><br>3. Faire un clique-droit et enregistrer-sous sur l'image capturée.</span>
					<span class="Texte_default"><br>4. Sélectionner ensuite ce fichier puis cliquer sur Publier.</span>
				</td>
			</tr>

								</table>
							</td>
<!-- Fin colonne de droite -->
						</tr>
					</table>
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