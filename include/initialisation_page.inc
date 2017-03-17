<?php
session_start();

$pageencours = substr($_SERVER['PHP_SELF'],1,strlen($_SERVER['PHP_SELF'])-1); // R?cup?re le nom de la page en cours

if (isset($_SESSION['langue'])) {
	$lg=langue($_SESSION['langue']); // R?cup?ration du langage en cours
} else {
	if (isset($_GET["lg"])) {
		$lg=$_GET["lg"];
	} else {
		$lg="fr";
	}
}

if (! isset($idprofil)) {
	$idprofil=0;
}

include('include/couleur.inc'); // r?cup?ration des variables couleurs de l'habillage graphique - table COULEUR

include('include/versionlinguistique.inc'); // routines d'affichage des versions linguistiques d'un mot - table VERSIONLINGUISTIQUE





function langue()
{
	$query='SELECT langue FROM profil WHERE id='.$_SESSION['id'];
	$recup = mysql_query($query);

	if ($data = mysql_fetch_assoc($recup))
		{
			return $data['langue'];
		}
}
?>