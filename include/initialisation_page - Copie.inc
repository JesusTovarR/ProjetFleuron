<?php
session_start();

$pageencours = substr($_SERVER['PHP_SELF'],1,strlen($_SERVER['PHP_SELF'])-1); // Récupère le nom de la page en cours

if (isset($_SESSION['id'])) {
	$lg=langue($_SESSION['id']); // Récupération du langage en cours
} else {
	if (isset($_GET["lg"])) {
		$lg=$_GET["lg"];
	} else {
		$lg="fr";
		$_SESSION['id']="fr";
	}
}

include('include/couleur.inc'); // récupération des variables couleurs de l'habillage graphique - table COULEUR 

include('include/versionlinguistique.inc'); // routines d'affichage des versions linguistiques d'un mot - table VERSIONLINGUISTIQUE 





function langue($idprofil)
{
	$query='SELECT langue FROM profil WHERE id='.$idprofil;
	$recup = mysql_query($query);

	if ($data = mysql_fetch_assoc($recup))
		{
			return $data['langue'];
		}
}
?>