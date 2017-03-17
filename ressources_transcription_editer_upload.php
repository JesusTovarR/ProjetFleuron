<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL

include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$extensions = array('.srt');
$extension = strrchr($_FILES['media']['name'], '.'); 
if(!in_array($extension, $extensions)) 
	{
						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$_POST["categorie"].'&retour='.$_POST["retour"].'&refpage='.$_POST["refpage"].'&idressource='.$_POST["idressource"].'&idprofil='.$idprofil.'"';
						echo '</script>';
	} else {

		if(isset($_FILES['media']))
			{ 
				$dossier = 'ressources/';
				$fichier = $_POST["idressource"].strrchr($_FILES['media']['name'], '.');

				if(move_uploaded_file($_FILES['media']['tmp_name'], $dossier . $fichier))
					{
						$extension = strrchr($_FILES['media']['name'], '.');


						// Enregistrement dans la base de données du fichier source de la transcription
						$requete ='UPDATE `ressources` SET ';
						$requete =$requete.'`sourcetranscription`="'.addslashes($_FILES['media']['name']); 
						$requete =$requete.'" WHERE id='.$_POST["idressource"];
						mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

						$requete ='UPDATE `ressources` SET ';
						$requete =$requete.'`Transcription`="'.addslashes($fichier); 
						$requete =$requete.'" WHERE id='.$_POST["idressource"];
						mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

						include('include/close_connectionBase.inc'); 
						// redirection
						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$_POST["categorie"].'&retour='.$_POST["retour"].'&refpage='.$_POST["refpage"].'&idressource='.$_POST["idressource"].'&idprofil='.$idprofil.'"';
						echo '</script>';
					} else {
						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$_POST["categorie"].'&retour='.$_POST["retour"].'&refpage='.$_POST["refpage"].'&idressource='.$_POST["idressource"].'&idprofil='.$idprofil.'"';
						echo '</script>';
     					}
			}
}


?>
