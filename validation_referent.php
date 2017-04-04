<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

$new_ref ="";
if(isset($_POST["form".$_POST['nbi']]) && isset($_POST["choix".$_POST['nbi']])){
    if($_POST["choix".$_POST['nbi']] == 'oui'){


        $r = 'UPDATE profil SET niveau= 30, demande_referent= 2 WHERE id ='.$_POST['id_i'].'';
        $res= mysql_query($r);
        header('Location: demande_referent.php'); // redirection

    }elseif($_POST["choix".$_POST['nbi']] == 'non'){
        $r = 'UPDATE profil SET demande_referent = 0 WHERE id ='.$_POST['id_i'].'';
        $res = mysql_query($r);
        header('Location: demande_referent.php'); // redirection
        //$res->execute();

    }


}