<?php

if (isset($_POST["lg"])) {
	$lg=$_POST["lg"];
} else {
	$lg="fr";
}

if (isset($_POST["pageencours"])) {
	$pageencours=$_POST["pageencours"];
}

if (!isset($_POST["categorie"])) {
	$categorie="&categorie=a";

} else {
	$categorie="&categorie=".$_POST["categorie"];
}

if (!isset($_POST["idressource"])) {
	$idressource="&idressource=0";

} else {
	$idressource="&idressource=".$_POST["idressource"];
}

if (!isset($_POST["id"])) {
	$id="&id=0";

} else {
	$id="&id=".$_POST["id"];
}



header('Location: '.$pageencours.'?lg='.$lg.$categorie.$idressource.$id);
?>