<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)
if(isset($_GET["categorie"])){
	$categorie=$_GET["categorie"];
}else{
	$categorie="";
}
if(isset($_GET["idressource"])){
	$idressource=$_GET["idressource"];
}else{
	$idressource="";
}
if(isset($_GET["idprofil"])){
	$idprofil=$_GET["idprofil"];
}else{
	$idprofil="";
}
if(isset($_GET["retour"])){
	$retour=$_GET["retour"];
}else{
	$retour="";
}

if(isset($_GET["pageencours"])){
	if ($retour=="") {
		$retour=$_GET["pageencours"];
	}
}

if(isset($_GET["derpos"])){
	$derpos=$_GET["derpos"];
}else{
	$derpos="";
}

if(isset($_GET["refpage"])){
	$refpage=$_GET["refpage"];
}else{
	$refpage="";
}

if(isset($_GET["timecode"])){
	$timecode=$_GET["timecode"];
}else{
	$timecode="";
}

$timecode=str_replace(",",".",$timecode);
$offstetimecode = "#t=".$timecode;

// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');

$soustitre=0;
$filename = 'ressources/'.$idressource.'fr.srt';
if (file_exists($filename)) {
$soustitre=$soustitre+1;
}
$filename = $idressource.strrchr($sourcevignette, '.');
$filenamepath = 'ressources/'.$idressource.strrchr($sourcevignette, '.');
if (file_exists($filenamepath)) {
$vignette=$filename;
}



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

							<td valign="top" width="100%">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
									<tr>
										<td width="80">
											<table border="0" bgcolor="<?php echo couleur(1) //couleur foncée ?>" cellpadding="5" cellspacing="0" width="80" height="44">
												<tr>
													<td align="center">
														<a href="ressources_media.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>&refpage=<?php echo $refpage ?>"><span class="texte_menu"><?php echo general("text5") //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center" bgcolor="<?php echo couleur(2) //couleur claire ?>">
											<?php
											if ($offline==1) {
											?>
												<span class="titreoffline"><?php echo $nom; //Titre de la ressource ?> (offline)</span>
											<?php } else { ?>
												<span class="titre"><?php echo $nom; //Titre de la ressource ?></span>
											<?php } ?>
										</td>
									</tr>
								</table>
								<table border="0" width="100%">
									<tr>
										<td valign="top" align="center">
<!-- ******************************************************************************** -->
<!-- *********************** Affichage du media de la ressource********************** -->
<!-- ******************************************************************************** -->
	<?php if ($typemedia=="audio") { ?>
<!-- ----------------------------------------------------------------------- -->
<!--                         Affichage du media AUDIO                        -->
<!-- ----------------------------------------------------------------------- -->
	<!-- Vérification et affichage vignette -->
		<?php if ($vignette=="") { ?> 
			<img src="visuel/pictos/hp_160.png">
		<?php } else { ?>
			<img src="ressources/<?php echo $vignette?>" width="200">
		<?php } ?>

	<!-- Affichage controleur AUDIO -->
		<audio   id="audio"  controls  width="480" height="500" >
			<source src="ressources/<?php echo $idressource ?>.mp3" >
			<source src="ressources/<?php echo $idressource ?>.ogg" >
		</audio>
<p>Timecode : <span id="timecode"></span></div></p>
<?php if ($soustitre>0) { ?>
		<!-- Sous-titres-->
		<div id="subtitres">
			<button id="buton1" class="stbutton" ><?php echo general("text4") //Afficher les sous-titres ?></button>
			<div id="soustitre">
				<div>
					<select  id="lg" name="color1">
						<?php
						$codes=array();
						$requete='SELECT * FROM lg WHERE online=1 ORDER BY nom';
						$recuplg = mysql_query($requete);
						while ($choixlg = mysql_fetch_assoc($recuplg))
						{
							$filename = 'ressources/'.$idressource.$choixlg['code'].'.srt';
							if (file_exists($filename)) {
								if($choixlg['code']=="fr"){
									echo '<option value="'.$choixlg['code'].'" selected>'.$choixlg['nom'];
								}else{
									echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];
								}
								array_push($codes, $choixlg['code']);
							}
						}
						$nbarray=count($codes)

						?>
					</select>
				</div>
				<br/>
				<?php
				clearstatcache();
				for($i=0; $i<$nbarray; $i++) {
					?>
					<div id="<?php echo $codes[$i]?>" class="srt" data-video="audio" data-srt="ressources/<?php echo $idressource ?><?php  echo $codes[$i]?>.srt"></div>
					<?php
				}
				?>
			</div>
		</div>
		<!-- Fin sous titres-->
		<!-- Bouton Masquer/afficher les sous-titres -->
		<script>



			$(document).ready(function() {
				<?php
				for($i=0; $i<$nbarray; $i++){

				?>
				var codes="<?php echo $codes[$i];?>";
				if(codes=="fr"){
					if ($("#"+codes+"").is(":hidden")) {
						$("#"+codes+"").show("fast");
					}
				}else {
					if ($("#"+codes+"").is(":visible")) {
						$("#"+codes+"").hide("fast");
					}
				}

				<?php
				}
				?>
			});

			$('select#lg').on('change',function(){
				<?php
				for($i=0; $i<$nbarray; $i++){

				?>
				var codes="<?php echo $codes[$i];?>";
				var val = $(this).val();
				if(codes==val){
					if ($("#"+codes+"").is(":hidden")) {
						$("#"+codes+"").show("fast");
					}
				}else {
					if ($("#"+codes+"").is(":visible")) {
						$("#"+codes+"").hide("fast");
					}
				}
				<?php
				}
				?>
			});

			$('#buton1').click(function () {
				if ($("#soustitre").is(":hidden")) {
					$("#soustitre").show("slow");
					document.getElementById('buton1').innerHTML = "<?php echo general("text4") //Afficher les sous-titres ?>";
				} else {
					$("#soustitre").slideUp();
					document.getElementById('buton1').innerHTML = "<?php echo new_versionlinguistique("text107") //Afficher les sous-titres ?>";
				}
			});

		</script>
		<!-- Fin bouton -->

<script>
// Récupérer les infos de "Audio"
	var vid = document.getElementById("audio");



// Mettre à jour la valeur Timecode :
	vid.ontimeupdate = function() {myFunction()};

</script>
<?php } ?>
<!-- ----------------------- Fin affichage audio ---------------------------- -->
	<?php } ?>
	<?php if ($typemedia=="video") { ?>
<!-- ----------------------------------------------------------------------- -->
<!-- ----------------------- Affichage du media VIDEO ---------------------- -->
<!-- ----------------------------------------------------------------------- -->
	<!-- Affichage controleur VIDEO -->
			<video  id="video"  controls  width="480" ontimeupdate='updateTrackTime(this);' >
				<source src="ressources/<?php echo $idressource ?>.ogv<?php echo $offstetimecode ?>" type='video/ogg; codecs="theora, vorbis"' >
				<source src="ressources/<?php echo $idressource ?>.mp4" >
				Erreur!!! Changer de navigateur!!!
			</video>

<p>Timecode : <span id="timecode"></span></div></p>
<?php if ($soustitre>0) { ?>

		<!-- Sous-titres-->
		<div id="subtitres">
			<button id="buton1" class="stbutton" ><?php echo general("text4") //Afficher les sous-titres ?></button>
			<div id="soustitre">
				<div>
					<select  id="lg" name="color1">
						<?php
						$codes=array();
						$requete='SELECT * FROM lg WHERE online=1 ORDER BY nom';
						$recuplg = mysql_query($requete);
						while ($choixlg = mysql_fetch_assoc($recuplg))
						{
							$filename = 'ressources/'.$idressource.$choixlg['code'].'.srt';
							if (file_exists($filename)) {
								if($choixlg['code']=="fr"){
									echo '<option value="'.$choixlg['code'].'" selected>'.$choixlg['nom'];
								}else{
									echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];
								}
								array_push($codes, $choixlg['code']);
							}
						}
						$nbarray=count($codes)

						?>
					</select>
				</div>
				<br/>
				<?php
				clearstatcache();
				for($i=0; $i<$nbarray; $i++) {
					?>
					<div id="<?php echo $codes[$i]?>" class="srt" data-video="video" data-srt="ressources/<?php echo $idressource ?><?php  echo $codes[$i]?>.srt"></div>
					<?php
				}
				?>
			</div>
		</div>
		<!-- Fin sous titres-->
		<!-- Bouton Masquer/afficher les sous-titres -->
		<script>



			$(document).ready(function() {
				<?php
				for($i=0; $i<$nbarray; $i++){

				?>
				var codes="<?php echo $codes[$i];?>";
				if(codes=="fr"){
					if ($("#"+codes+"").is(":hidden")) {
						$("#"+codes+"").show("fast");
					}
				}else {
					if ($("#"+codes+"").is(":visible")) {
						$("#"+codes+"").hide("fast");
					}
				}

				<?php
				}
				?>
			});

			$('select#lg').on('change',function(){
				<?php
				for($i=0; $i<$nbarray; $i++){

				?>
				var codes="<?php echo $codes[$i];?>";
				var val = $(this).val();
				if(codes==val){
					if ($("#"+codes+"").is(":hidden")) {
						$("#"+codes+"").show("fast");
					}
				}else {
					if ($("#"+codes+"").is(":visible")) {
						$("#"+codes+"").hide("fast");
					}
				}
				<?php
				}
				?>
			});

			$('#buton1').click(function () {
				if ($("#soustitre").is(":hidden")) {
					$("#soustitre").show("slow");
					document.getElementById('buton1').innerHTML = "<?php echo general("text4") //Afficher les sous-titres ?>";
				} else {
					$("#soustitre").slideUp();
					document.getElementById('buton1').innerHTML = "<?php echo new_versionlinguistique("text107") //Afficher les sous-titres ?>";
				}
			});

		</script>
		<!-- Fin bouton -->
<?php } ?>


<script>
// Récupérer les infos de "Video"
	var vid = document.getElementById("video");



// Mettre à jour la valeur Timecode :
	vid.ontimeupdate = function() {myFunction()};


</script>


<!-- ***** Fin affichage video -->
	<?php } ?>
<script>

function myFunction() {



    // Display the current position of the video in a p element with id="timecode"

    vid.innerHTML = formatSecondsAsTime(vid.currentTime);
   // document.getElementById("timecode").innerHTML = vid.currentTime;

	var milli=vid.currentTime;
	var millistr=milli.toString();
	var millistrreste=millistr.substring(millistr.lastIndexOf("."));
	var millistrrestevirg = millistrreste.replace(".", ",");
	var milliaff=millistrrestevirg.substring(0,4);
	var heure="00:";

    document.getElementById("timecode").innerHTML = heure+vid.innerHTML+milliaff;
}


function formatSecondsAsTime(secs, format) {
  var hr  = Math.floor(secs / 3600);
  var min = Math.floor((secs - (hr * 3600))/60);
  var sec = Math.floor(secs - (hr * 3600) -  (min * 60));

  if (min < 10){ 
    min = "0" + min; 
  }
  if (sec < 10){ 
    sec  = "0" + sec;
  }

  return min + ':' + sec;
}
</script>
<br>

<!-- ******************************************************************************** -->
<!-- ******************* Fin de l'affichage du media de la ressource***************** -->
<!-- ******************************************************************************** -->
										</td>
										<td valign="top">
											<iframe src="ressources_transcription_editer_modifier_soustitre.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&refpage=<?php echo $refpage ?>#<?php echo $derpos ?>" name="conseil" width="350" scrolling="AUTO" height="520" frameborder="1"></iframe>
										</td>
									</tr>
								</table>

							</td>
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