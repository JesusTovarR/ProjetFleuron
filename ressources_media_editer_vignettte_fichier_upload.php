<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL

include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$extensions = array('.jpg','.gif','.jpeg','.png');
$extension = strrchr($_FILES['media']['name'], '.'); 


if (isset($_POST["categorie"])) {
	$categorie=$_POST["categorie"]; 
} else {
	$categorie=0;
}

if (isset($_POST["retour"])) {
	$retour=$_POST["retour"]; 
} else {
	$retour=0;
}

if (isset($_POST["idressource"])) {
	$idressource=$_POST["idressource"]; 
} else {
	$idressource=0;
}

if (isset($idprofil)) {
	$idprofil=$idprofil; 
} else {
	$idprofil=0;
}

if(!in_array($extension, $extensions)) 
	{
						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$categorie.'&retour='.$retour.'&idressource='.$idressource.'&idprofil='.$idprofil.'"';
						echo '</script>';
	} else {

		if(isset($_FILES['media']))
			{ 
				$dossier = 'ressources/';
				$fichier = $_POST["idressource"].strrchr($_FILES['media']['name'], '.');

				if(move_uploaded_file($_FILES['media']['tmp_name'], $dossier . $fichier))
					{
						$extension = strrchr($_FILES['media']['name'], '.');


						// Enregistrement dans la base de données du type de media (audio/video) et du nom du fichier source
						$requete ='UPDATE `ressources` SET ';

							$requete =$requete.'`sourcevignette`="'.addslashes($_FILES['media']['name']); 

						$requete =$requete.'" WHERE id='.$_POST["idressource"];

						mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

						include('include/close_connectionBase.inc'); 
						// redirection
						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$categorie.'&retour='.$retour.'&idressource='.$idressource.'&idprofil='.$idprofil.'"';
						echo '</script>';
					} else {
						echo '<script>';
						echo 'top.window.location="ressources_media.php?lg='.$lg.'&categorie='.$categorie.'&retour='.$retour.'&idressource='.$idressource.'&idprofil='.$idprofil.'"';
						echo '</script>';
     					}
			}
}


?>
