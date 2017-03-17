<?php

$pageencours = substr($_SERVER['PHP_SELF'],1,strlen($_SERVER['PHP_SELF'])-1); // Récupère le nom de la page en cours


$lg=$_GET["lg"]; // Récupération du langage en cours

if ($lg=="") {
$lg="fr";
}

include('include/couleur.inc'); // récupération des variables couleurs de l'habillage graphique - table COULEUR 

include('include/versionlinguistique.inc'); // routines d'affichage des versions linguistiques d'un mot - table VERSIONLINGUISTIQUE 

session_start();

?>