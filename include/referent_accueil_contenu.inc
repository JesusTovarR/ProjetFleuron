<?php
/**
 * Created by PhpStorm.
 * User: dano
 * Date: 20/03/17
 * Time: 23:57
 */
include('include/open_connectionBase.inc');


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

$con=mysqli_connect("localhost","root","root","fleuron");
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



$nb_col= count($tables);
$col="";
$val="";
$lang="'fr'";

    for($i=1; $i<=$nb_col; $i++) {
        $requete = 'SELECT * FROM '.$tables[$i].' WHERE status=2';
        $resultat = mysql_query($requete);
        if ($resultat) {
            //$resultSet = array();
            //var_dump($resultat);
            while ($data = mysql_fetch_assoc($resultat)) {
                //$resultSet[] = $data;
                if($data['status']==2) {
                    $textfr = 'SELECT * FROM ' . $tables[$i] . ' WHERE code=' . $lang;
                    $resulfr = mysql_query($textfr);
                    $datafr = mysql_fetch_assoc($resulfr);
                    foreach ($datafr as $cle => $value) {
                        if ($cle != "id" && $cle != "code" && $cle != "status" && $cle != "id_user") {
                            $datafr[$cle] = str_replace('>', ')', $value);
                            $datafr[$cle] = str_replace('<', '(', $datafr[$cle]);
                            $datafr[$cle] = str_replace(' ', '!', $datafr[$cle]);
                            $datafr[$cle] = str_replace('"', '|', $datafr[$cle]);
                            $datafr[$cle] = str_replace("\n", '~', $datafr[$cle]);
                            $datafr[$cle] = str_replace("\r", '°', $datafr[$cle]);
                            //echo $dfr;
                        }
                    }
                }
                //var_dump($data);
                if ($data) {
                    foreach ($data as $cle => $value) {
                        if ($cle === 'id_user') {
                            $requete2 = 'SELECT nom, prenom FROM profil WHERE id=' .$value;
                            $resultat2 = mysql_query($requete2);
                            if ($resultat2) {
                                $data_profil = mysql_fetch_array($resultat2);
                               // var_dump($data_profil);
                            }

                            if ($data_profil) {
                                //var_dump($data); || $cle != "code" || $cle != "status" || $cle != "id_user"
                                $id="id";
                                foreach ($data as $cle => $value) {
                                    if ($cle != "id" && $cle != "code" && $cle != "status" && $cle != "id_user") {

                                        //$data[$cle] = implode("#$",$value);
                                        $data[$cle] = str_replace('>',')',$value);
                                        $data[$cle] = str_replace('<','(',$data[$cle]);
                                        $data[$cle] = str_replace(' ','!',$data[$cle]);
                                        $data[$cle] = str_replace('"','|',$data[$cle]);
                                        $data[$cle] = str_replace("\n",'~',$data[$cle]);
                                        $data[$cle] = str_replace("\r",'°',$data[$cle]);
                                    }
                                }
                                        echo '<table border="0" cellspacing="0">';
                                        echo '<tr>';
                                        echo '<td>';
                                        echo '<table border="0" cellspacing="0">';
                                        echo '<tr>';
                                        echo '<td align="center">';
                                        echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="' . couleur(1) . '" width="300" height="60">';
                                        echo '<tr>';
                                        echo '<td align="center"><span class="texte_info12">' . $data_profil['prenom'] . " " .$data_profil['nom']. '</span></td>';
                                        echo '</tr>';
                                        echo '</table>';
                                        echo '</td>';
                                        echo '</tr>';
                                        echo '</table>';
                                        echo '</td>';
                                        echo '<td>';
                                        echo '<table border="0" cellspacing="0">';
                                        echo '<tr>';
                                        echo '<td align="center">';
                                        echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="' . couleur(1) . '" width="300" height="60">';
                                        echo '<tr>';
                                        echo '<form action="referent_page_revision.php" method="post">';


                                        $data= base64_encode(serialize($data));
                                        $dafr= base64_encode(serialize($datafr));

                                        echo '<input type="hidden" value="'.$data.'" name="data">';
                                        echo '<input type="hidden" value='.$dafr.' name="datafr">';
                                        echo '<input type="hidden" value="'.$tables[$i].'" name="table">';
                                        //echo '<input type="hidden" value="'.$code['id'].'" name="code_id">';
                                        //echo '<input type="hidden" value="'.$formulaire.'" name="formulaire">';
                                        echo '<td align="center"><span class="texte_info12"><input type="submit" value="voir traduction" name="submitButtonName"></span></td>';//Cambiar
                                        echo '</form>';
                                        echo '</tr>';
                                        echo '</table>';
                                        echo '</td>';
                                        echo '</tr>';
                                        echo '</table>';
                                        echo '</td>';
                                        echo '</table>';

                            }
                        }

                    }


                }else{
                    echo "error";
                }
            }
            //var_dump($resultSet);

        }else{
            //echo $i;
        }
    }


function referent_langue(){

    //echo '<form action="traducteur_insert.php?categorie='.$_GET['categorie'].'" method="post">';

    echo '<p>';
    echo '<table border="0" cellpadding="7" cellspacing="2" bgcolor="'.couleur(2).'" width="220">';// couleur claire
    echo '<tr>';
    echo '<td colspan="2" align="center">';
    echo '<span class="Texte_menu">Langues des Traductions</span>';// Cambiar
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="2" align="center">';
    echo '<center>';
    echo '<select name="lg" size="1">';

    var_dump($_SESSION);
    $requete='SELECT * FROM langue_referent WHERE profil=1 ORDER BY nom';
    $recuplg = mysql_query($requete);
    var_dump($recuplg);
    while ($choixlg = mysql_fetch_assoc($recuplg))
    {
        var_dump($choixlg);
        echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];
    }

    echo '</select></center>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<input type="hidden"  value="'.$choixlg['code'].'" name="code">';
    echo '<td colspan="2" bgcolor="'.couleur(1).'">';//couleur fonc�e
    echo '<center>';
    echo '<span class="texte_menu"><input type="submit" value="'.choix_langue().'" name="submitButtonName"></span></center>'; // Choisir cette langue
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</p>';
    echo '</form>';


}


    /* obtener lo que hay dentro de cada tabla en textsAreas
        if($data){
            foreach ($data as $cle => $value) {
                if ($cle == "id" || $cle == "code" || $cle == "status" || $cle == "id_user") {

                } else {
                    echo '<tr>';
                    echo '<td align="center">';
                    echo '<textarea name="value" cols="110" rows="25">' . $value . '</textarea>';
                }
                echo '</td>';
                echo '</tr>';
            }
        }
    */
