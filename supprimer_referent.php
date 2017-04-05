<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

    $r = 'UPDATE profil SET niveau= 21, demande_referent = 0 WHERE id ='.$_POST['id_i'].'';
    $res= mysql_query($r);
    $requet = 'DELETE FROM langues_profil WHERE id_user ='.$_POST['id_i'].'';
    $resultat= mysql_query($requet);
    header('Location: gestion_referent.php'); // redirection
