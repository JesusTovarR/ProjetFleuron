<?php
include('include/open_connectionBase.inc'); 

$idressource = $_GET["idressource"];
$lien = $_GET["lien"];
$liens = $_GET["liens"];
$id = $_GET["id"];
$lg = $_GET["lg"];

$reliens="";
			$eleconsultation = explode(";",$liens);
			for ($i = count($eleconsultation); $i >= 0; $i--) {
				if ($eleconsultation[$i]==$lien) {

				} else {
					if ($eleconsultation[$i]<>"") {
						$reliens=$reliens.$eleconsultation[$i].';';
					} else {

					}
				}
			}

$requete ='UPDATE ressources SET '; // début de la composition de la requete de mise à jour

$requete = $requete.'lien="'.$reliens.'"';

$requete = $requete.' WHERE id='.$idressource; // fin composition de la requete


mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


include('include/close_connectionBase.inc'); 

header('Location: ressources_liens.php?lg='.$GET["lg"].'&idressource='.$_GET["idressource"].'&idprofil='.$_GET["idprofil"]); // redirection


?>
