<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

$new_ref ="";
if(isset($_POST["form".$_POST['nbi']]) && isset($_POST["choix".$_POST['nbi']])){
    if($_POST["choix".$_POST['nbi']] == 'oui'){


        $r = 'UPDATE profil SET niveau= 30, demande_referent= 0 WHERE id ='.$_POST['id_i'].'';
        $res= mysql_query($r);
        $requet = 'UPDATE langues_profil SET ap_ref=1 WHERE ap_ref=0 AND id_user ='.$_POST['id_i'].'';
        $resultat= mysql_query($requet);
        header('Location: demande_referent.php'); // redirection

    }else if($_POST["choix".$_POST['nbi']] == 'non'){
        $r = 'UPDATE profil SET demande_referent = 0 WHERE id ='.$_POST['id_i'].'';
        $res = mysql_query($r);
        $requet = 'DELETE FROM langues_profil WHERE ap_ref=0 AND id_user ='.$_POST['id_i'].'';
        $resultat= mysql_query($requet);
        header('Location: demande_referent.php'); // redirection
        //$res->execute();

    }


}