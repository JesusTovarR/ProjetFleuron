<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


//include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$ressource=$_GET["ressource"];
$idprofil=$_GET["id"];



			$requete = 'SELECT id FROM favoris WHERE ressource='.$ressource.' AND profil='.$idprofil;
			$recup = mysql_query($requete);
			$num_rows = mysql_num_rows($recup);

	echo '<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">';
if ($num_rows>0) {
	echo '<a href="favoris_retirer.php?id='.$idprofil.'&ressource='.$ressource.'"><img src="visuel/pictos/etoile_on.png" border="0"></a>';
} else {
	echo '<a href="favoris_ajouter.php?id='.$idprofil.'&ressource='.$ressource.'"><img src="visuel/pictos/etoile_off_liste.png" border="0"></a>';
}
	echo '</body>';

include('include/close_connectionBase.inc');
?>
