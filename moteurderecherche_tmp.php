<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$lg=$_POST["lg"];

echo '<script>';
echo 'top.window.location="moteurderecherche.php?lg='.$lg.'&motcle='.$_POST["motcle"].'#"';
echo '</script>';

?>
