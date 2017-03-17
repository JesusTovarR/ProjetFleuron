<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$categorie=$_GET["categorie"];

$idressource=$_GET["idressource"];
$idprofil=$_GET["idprofil"];
$retour=$_GET["retour"];

$_SESSION['idressource']=$idressource;

if ($_SESSION['tmp']>0) {
$_SESSION['tmp']=0;
						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$_POST["categorie"].'&retour='.$_POST["retour"].'&idressource='.$_SESSION['idressource'].'&idprofil='.$idprofil.'"';
						echo '</script>';

}

// Récupérer les informations de la ressource (table RESSOURCES)
include('include/Recup_infosRessource.inc');

?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<?php include('include/style_onglet.inc');  // header ?>
		<script>
			function _(el){
				return document.getElementById(el);
			}
function uploadFile(){
	var file = _("media").files[0];
	// alert(file.name+" | "+file.size+" | "+file.type);
	var formdata = new FormData();
	formdata.append("media", file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "ressources_media_editer_media_fichier_upload.php");
	ajax.send(formdata);

}
function progressHandler(event){
	//_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
	var percent = (event.loaded / event.total) * 100;
	_("progressBar").value = Math.ceil(percent);
	//_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
	_("status").innerHTML = event.target.responseText;
	_("progressBar").value = 0;
	
}
function errorHandler(event){
	_("status").innerHTML = "Upload Failed";
}
function abortHandler(event){
	_("status").innerHTML = "Upload Aborted";
}

		</script>
	</head>

	<body topmargin="4" leftmargin="4" marginheight="4" marginwidth="4" bgcolor="#EDECE7">
		<table width="100%">
			<tr>
				<td>
					<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="4" cellspacing="0" width="80">
						<tr>
							<td align="center">
								<a href="ressources_media_editer_media.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idprofil=<?php echo $idprofil ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
							</td>
						</tr>
					</table>
				</td>
				<td align="center">
<?php // Affichage du nom du media source
if ($_SESSION['niveau']>0) {
	if ($sourcemedia<>"") { echo '<span class="texte_note">'.$sourcemedia.'</span>'; }
	if ($sourcemedia2<>"") { echo '<br><span class="texte_note">'.$sourcemedia2.'</span>'; }
}
?>
				</td>
			</tr>
		</table>
<span class="texte_note">Audio : .mp3 et .ogg - Video : .mp4 et .ogv - ID ressource : <?php echo $_SESSION['idressource'] ?></span>

		<form method="POST" id="upload_form" enctype="multipart/form-data">
			
			<table border="0" cellpadding="4" cellspacing="2" width="100%">
				<tr>
					<td align="center">
						<input type="file" name="media" id="media">
					</td>
					<td align="center">
						<button id="buton1"  type="submit" class="stbuttonImp"  onclick="uploadFile()" ><?php echo versionlinguistique(112) //Publier ?></button>
					</td>
				</tr>
 				<tr>
					<td align="center" colspan="2">

 <progress id="progressBar" value="0" max="100" style="width:200px;"></progress>

					</td>
				</tr>
 

			</table>
	<input type="hidden" value="<?php echo $_SESSION['idressource'] ?>" name="idressource" id="idressource">
	<input type="hidden" value="<?php echo $retour ?>" name="retour">
											</form> 

	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>