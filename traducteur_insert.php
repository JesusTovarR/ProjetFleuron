<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

$tables= array(
    1 => 'accueil_contenu',
    2 => 'choix_langue',
    3 => 'conseils',
    4 => 'conseils_contenu',
    5 => 'contact_contenu',
    6 => 'dernier_media',
    7 => 'login',
    8 => 'menu',
    9 => 'menu_admin',
    10 => 'moteur_de_recherche',
    11 => 'tableau_du_bord'
    );

$nb_col= count($tables);
    $col="";
    $val="";
    for($i=1; $i<=$nb_col; $i++){

        $requete='SELECT * FROM '.$tables[$i].' WHERE code="fr" AND status=1';
        $recup = mysql_query($requete);
        if ($data = mysql_fetch_assoc($recup))
        {
            $count= 0;
            $col="";
            $val="";
            foreach ($data as $cle => $value){

                if($cle!="id"&&$cle!="code"&&$cle!="status"&&$cle!="id_user"){
                    $count=$count+1;
                    if ($count==1) {
                        // Replacer les '
                        $col ="".$cle;
                        $val ='\''.addslashes($value).'\'';
                    } else {
                        $col = $col.", ".$cle;
                        $val =$val.', \''.addslashes($value).'\'';
                    }
                }

            }

            $requete2='INSERT INTO '.$tables[$i].' ('.$col.', code, status, id_user) VALUES ( '.$val.', \''.$_POST['lg'].'\', 0, '.$_SESSION['id'].')';
            $exec = mysql_query($requete2);
        }
    }


include('include/close_connectionBase.inc');
header('Location: traducteur_choix_langue.php?categorie='.$_GET['categorie'].'&message=1'); // redirection
?>