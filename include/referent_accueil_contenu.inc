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

    for($i=1; $i<=$nb_col; $i++) {
        $requete = 'SELECT * FROM '.$tables[$i].' WHERE status=2';
        //echo $cantidad_inves = mysql_num_rows($requete);
        $resultat = mysql_query($requete);

        if ($resultat) {
            //$resultSet = array();
            while ($data = mysql_fetch_assoc($resultat)) {
                //$resultSet[] = $data;
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
                                        $da= (serialize($data));
                                        $d = str_replace(' ','!',$da);

                                        echo '<input type="hidden" value='.$d.' name="data">';
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
