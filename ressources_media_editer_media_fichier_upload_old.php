<?php
set_time_limit(500);


include('include/open_connectionBase.inc'); // connection à la base MYSQL

include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$extensions = array('.mp3','.ogg','.ogv','.mp4');
$extension = strrchr($_FILES['media']['name'], '.'); 

if(!in_array($extension, $extensions)) 
	{
						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$_POST["categorie"].'&retour='.$_POST["retour"].'&idressource='.$_POST["idressource"].'&idprofil='.$idprofil.'"';
						echo '</script>';
	} else {

		if(isset($_FILES['media']))
			{ 
				$dossier = 'ressources/';
				$fichier = $_POST["idressource"].strrchr($_FILES['media']['name'], '.');

				if(move_uploaded_file($_FILES['media']['tmp_name'], $dossier . $fichier))
					{
						$extension = strrchr($_FILES['media']['name'], '.');

						if ($extension==".mp3") { // déterminer le type de media (audio ou video)
								$typemedia="audio"; 
							} else {
								if ($extension==".ogg") { // déterminer le type de media (audio ou video)
									$typemedia="audio"; 
								} else {
									$typemedia="video"; 
								}
							}
						// Enregistrement dans la base de données du type de media (audio/video) et du nom du fichier source
						$requete ='UPDATE `ressources` SET ';
						$requete =$requete.'`typemedia`="'.$typemedia.'",';
						if ($extension==".mp3") {
							$requete =$requete.'`sourcemedia`="'.addslashes($_FILES['media']['name']);  
									}
						if ($extension==".ogg") {
							$requete =$requete.'`sourcemedia2`="'.addslashes($_FILES['media']['name']); 
									}
						if ($extension==".mp4") {
							$requete =$requete.'`sourcemedia`="'.addslashes($_FILES['media']['name']); 
									}
						if ($extension==".ogv") {
							$requete =$requete.'`sourcemedia2`="'.addslashes($_FILES['media']['name']); 
									}
						$requete =$requete.'" WHERE id='.$_POST["idressource"];

						mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

						include('include/close_connectionBase.inc'); 





						// redirection

						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$_POST["categorie"].'&retour='.$_POST["retour"].'&idressource='.$_POST["idressource"].'&idprofil='.$idprofil.'"';
						echo '</script>';

					} else {
						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$_POST["categorie"].'&retour='.$_POST["retour"].'&idressource='.$_POST["idressource"].'&idprofil='.$idprofil.'"';
						echo '</script>';
     					}
			}
}


?>
