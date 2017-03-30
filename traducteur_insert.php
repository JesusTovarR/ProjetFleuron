<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');
include('include/traducteur_requete_speciale.inc');

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
    15 => 'categorie_traduction',
    16 => 'ressources_traduction',
    17 => 'soustitres'
    );

$nb_col= count($tables);
    $col="";
    $val="";
    $_SESSION['exist']=0;
    $_SESSION['cree']=0;
    for($i=1; $i<=$nb_col; $i++){
         if($i==15||$i==16||$i==17){
             if($i==15){
                 $requeteR='SELECT id FROM categorie';
                 $recupid=mysql_query($requeteR);
             }else{
                 $requeteR='SELECT id FROM ressources';
                 $recupid=mysql_query($requeteR);
             }
            while($dataR=mysql_fetch_assoc($recupid)){
                if($i==15){
                    $requete = 'SELECT code FROM ' . $tables[$i] . ' WHERE category=' . $dataR['id'] . ' AND code="' . $_POST['lg'] . '" AND status=1 AND ap_ref=1';
                    $resultat = mysql_query($requete);
                    $requete2 = 'SELECT code FROM ' . $tables[$i] . ' WHERE category=' . $dataR['id'] . ' AND status=1 AND ap_ref=0 AND code="' . $_POST['lg'] . '"';
                    $resultat2 = mysql_query($requete2);
                }else{
                    $requete = 'SELECT code FROM ' . $tables[$i] . ' WHERE id_resource=' . $dataR['id'] . ' AND code="' . $_POST['lg'] . '" AND status=1 AND ap_ref=1';
                    $resultat = mysql_query($requete);
                    $requete2 = 'SELECT code FROM ' . $tables[$i] . ' WHERE id_resource=' . $dataR['id'] . ' AND status=1 AND ap_ref=0 AND code="' . $_POST['lg'] . '"';
                    $resultat2 = mysql_query($requete2);
                }

                if ($validation=mysql_fetch_assoc($resultat)) {
                    creer_brouillon_ressource($tables[$i], $dataR['id'], $_POST['lg'], 1, 1, $i);
                } else if ($validation2=mysql_fetch_assoc($resultat2)) {
                    creer_brouillon_ressource($tables[$i], $dataR['id'], $_POST['lg'], 1, 0, $i);

                } else {
                    if($i==15){
                        $requete3 = 'SELECT code FROM ' . $tables[$i] . ' WHERE category=' . $dataR['id'] . ' status=0 AND id_user=' . $_SESSION['id'] . ' AND code="' . $_POST['lg'] . '"';
                        $recup = mysql_query($requete3);
                    }else{
                        $requete3 = 'SELECT code FROM ' . $tables[$i] . ' WHERE id_resource=' . $dataR['id'] . ' status=0 AND id_user=' . $_SESSION['id'] . ' AND code="' . $_POST['lg'] . '"';
                        $recup = mysql_query($requete3);
                    }

                    if ($recup != false) {
                        $_SESSION['exist'] = $_SESSION['exist'] + 1;
                    } else {
                        ajouter_langue_ressource($tables[$i], $dataR['id'], $_POST['lg'], $i);
                    }

                    $requete6 = 'SELECT * FROM lg WHERE code="' . $_POST['lg'] . '"';
                    $recup3 = mysql_query($requete6);
                    if ($data = mysql_fetch_assoc($recup3)) {
                        if ($data['online'] == 0) {
                            $requete7 = 'UPDATE lg SET online=1 WHERE  code="' . $_POST['code_lg'] . '" AND online=0';
                            $recupcont = mysql_query($requete7);
                        }
                    } else {
                        $requete8 = 'SELECT nom FROM langues WHERE code="' . $_POST['lg'] . '"';
                        $recup4 = mysql_query($requete8);
                        while ($data2 = mysql_fetch_assoc($recup4)) {
                            $requete9 = 'INSERT INTO lg ( nom, code, commentaire, online) VALUES ("' . $data2["nom"] . '", "' . $_POST["lg"] . '", "", 1)';
                            $exec2 = mysql_query($requete9);
                        }
                    }
                }
            }

        }else{
            $requete='SELECT code FROM '.$tables[$i].' WHERE status=1 AND ap_ref=1 AND code="'.$_POST['lg'].'"';
            $resultat= mysql_query($requete);
            $requete2='SELECT code FROM '.$tables[$i].' WHERE status=1 AND ap_ref=0 AND code="'.$_POST['lg'].'"';
            $resultat2= mysql_query($requete2);

            if($validation = mysql_fetch_assoc($resultat)){
                creer_brouillon($tables[$i],$_POST['lg'], 1, 1, $i);
            }else if($validation2 = mysql_fetch_assoc($resultat2)){
                creer_brouillon($tables[$i],$_POST['lg'], 1, 0, $i);

            }else {
                $requete3 = 'SELECT code FROM ' . $tables[$i] . ' WHERE status=0 AND id_user=' . $_SESSION['id'] . ' AND code="' . $_POST['lg'] . '"';
                $recup = mysql_query($requete3);
                if ($data = mysql_fetch_assoc($recup)) {
                    $_SESSION['exist'] = $_SESSION['exist'] + 1;
                } else {
                    ajouter_langue($tables[$i], $_POST['lg'], $i);
                }

                $requete6 = 'SELECT * FROM lg WHERE code="' . $_POST['lg'] . '"';
                $recup3 = mysql_query($requete6);
                if ($data = mysql_fetch_assoc($recup3)) {
                    if($data['online']==0){
                        $requete7 = 'UPDATE lg SET online=1 WHERE  code="'.$_POST['code_lg'].'" AND online=0';
                        $recupcont = mysql_query($requete7);
                    }
                }else{
                    $requete8 = 'SELECT nom FROM langues WHERE code="' . $_POST['lg'] . '"';
                    $recup4 = mysql_query($requete8);
                    while ($data2= mysql_fetch_assoc($recup4)){
                        $requete9 = 'INSERT INTO lg ( nom, code, commentaire, online) VALUES ("'.$data2["nom"].'", "'.$_POST["lg"].'", "", 1)';
                        $exec2 = mysql_query($requete9);
                    }
                }
            }
        }


    }
    include('include/close_connectionBase.inc');
    header('Location: traducteur_choix_langue.php?categorie=' . $_GET['categorie'] . '&message=1'); // redirection
?>