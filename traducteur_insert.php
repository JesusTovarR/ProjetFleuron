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
    11 => 'tableau_du_bord',
    12 => 'affichage_ressource',
    13 => 'content',
    14 => 'page_edit',
    15 => 'categorie_traduction'
    );

$nb_col= count($tables);
    $col="";
    $val="";
    $_SESSION['exist']=0;
    $_SESSION['cree']=0;
    for($i=1; $i<=$nb_col; $i++){

        $requete='SELECT code, ap_ref FROM '.$tables[$i].' WHERE status=1 AND code="'.$_POST['lg'].'"';
        $resultat= mysql_query($requete);
        if($validation = mysql_fetch_assoc($resultat)){
            while ($validation){
                echo $validation['code'];
                echo $validation['ap_ref'];
            }
            die();
            /*$requete2='SELECT code FROM '.$tables[$i].' WHERE id_user='.$_SESSION['id'].' AND code="'.$_POST['lg'].'"';
            if(){

            }else{
                $requete3='SELECT * FROM '.$tables[$i].' WHERE code="fr" AND status=1';
                $recup = mysql_query($requete3);
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

                }
                $requete4='INSERT INTO '.$tables[$i].' ('.$col.', code, status, id_user) VALUES ( '.$val.', \''.$_POST['lg'].'\', 1, '.$_SESSION['id'].')';
                $exec = mysql_query($requete4);
            }
            include('include/close_connectionBase.inc');
            header('Location: traducteur_choix_langue.php?categorie=' . $_GET['categorie'] . '&message=2'); // redirection
            die();*/
        }else{
            $requete2='SELECT code FROM '.$tables[$i].' WHERE status=0 AND id_user='.$_SESSION['id'].' AND code="'.$_POST['lg'].'"';
            $recup = mysql_query($requete2);
            if ($data = mysql_fetch_assoc($recup)){
                $_SESSION['exist']=$_SESSION['exist']+1;
            }else{
                $requete3='SELECT * FROM '.$tables[$i].' WHERE code="fr" AND status=1';
                $recup2 = mysql_query($requete3);
                if ($data2 = mysql_fetch_assoc($recup2))
                {
                    $count= 0;
                    $col="";
                    $val="";
                    foreach ($data2 as $cle => $value){

                        if($cle!="id"&&$cle!="code"&&$cle!="status"&&$cle!="id_user"&&$cle!="ap_ref"){
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

                }
                $requete4='INSERT INTO '.$tables[$i].' ('.$col.', code, status, id_user, ap_ref) VALUES ( '.$val.', \''.$_POST['lg'].'\', 1, '.$_SESSION['id'].', 0)';
                $exec = mysql_query($requete4);
                $_SESSION['cree']=$_SESSION['cree']+1;
            }
        }
    }
    include('include/close_connectionBase.inc');
    header('Location: traducteur_choix_langue.php?categorie=' . $_GET['categorie'] . '&message=1'); // redirection
?>