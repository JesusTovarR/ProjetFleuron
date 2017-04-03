<?php
/**
 * Created by PhpStorm.
 * User: dano
 * Date: 20/03/17
 * Time: 23:57
 */
include('include/open_connectionBase.inc');


$tables = array(
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

$con = mysqli_connect("localhost", "root", "root", "fleuron");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


$nb_col = count($tables);
$col = "";
$val = "";
$lang_revision="fr";

for ($i = 1; $i <= $nb_col; $i++) {

    if (isset($_POST['lang'])) {
        $requete = 'SELECT * FROM ' . $tables[$i] . ' WHERE status=2 and code="' . $_POST['lang'] . '"';
        $resultat = mysql_query($requete);
    } else {
        $requete = 'SELECT * FROM langues_profil WHERE id_user=' . $_SESSION['id'];
        $recuplg = mysql_query($requete);
        $choixlg = mysql_fetch_assoc($recuplg);
        $_POST['lang'] = $choixlg['code'];
        $requete = 'SELECT * FROM ' . $tables[$i] . ' WHERE status=2 and code="' . $_POST['lang'] . '"';
        $resultat = mysql_query($requete);
    }






    if ($i == 15) {
        //var_dump($_POST['lang']);
        // Function pour ramener les text de categorie en francais
        $data_categorie_fr = textFrenchCategorie($tables, $i);

        $user = Array();
        $contdor=0;
        $requete2 = 'SELECT id_user FROM categorie_traduction WHERE  status=2';
        $recupcont = mysql_query($requete2);
        while($donnees = mysql_fetch_assoc($recupcont)){
            $contdor=$contdor+1;
            $user[$contdor]=$donnees['id_user'];
        }
       //var_dump($user);
        $user = array_unique($user);

        //por cada Usuario de la tabla Categorie_traduction con estatus 2
        foreach ($user as $u){
            // recuperar traducciones
            $requete = 'SELECT * FROM categorie';
            $resultat = mysql_query($requete);
            $count = 1;
            $array_categorie_data = Array();
            while($cat= mysql_fetch_assoc($resultat)) {

                $requete2 = 'SELECT * FROM ' . $tables[$i]  . ' WHERE category=' . $cat['id'] . ' AND code="' . $_POST['lang'] . '" AND status=2 AND id_user="'.$u.'"';
                $recupcont = mysql_query($requete2);
                $donnees = mysql_fetch_assoc($recupcont);
                if($donnees) {
                    foreach ($donnees as $cle => $value) {
                        if($cle=="id"){
                            $array_categorie_data["id".$count]=$value;
                        }
                        if ($cle == "name") {
                            $array_categorie_data["value".$count]=$value;
                            //echo '<tr>';
                            //echo '<td align="center">';
                            ////////////////////////////////			echo '<p>Que hace esto</p>';
                            //echo '<textarea class="matextarea" name="value' . $count . '" cols="60" rows="1">' . $value . '</textarea>';
                            //echo '</td>';
                            //echo '</tr>';
                        }
                    }
                    $count = $count + 1;
                }else{
                    // echo "No hay categorias en este idioma";
                }
            }
            //var_dump($array_categorie_data);
            $data_categorie = base64_encode(serialize($array_categorie_data));
            //echo "<br/><br/>";
            //var_dump($donnees['code']);
            if(!empty($array_categorie_data)) {

                // chercher les profil qui corresponde a chaque traduction
                $requete2 = 'SELECT nom, prenom FROM profil WHERE id=' . $u;
                $resultat2 = mysql_query($requete2);
                if ($resultat2) {
                    $data_profil = mysql_fetch_array($resultat2);
                }

                echo '<table border="0" cellspacing="0">';
                echo '<tr>';
                echo '<td>';
                echo '<table border="0" cellspacing="0">';
                echo '<tr>';
                echo '<td align="center">';
                echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="' . couleur(1) . '" width="300" height="60">';
                echo '<tr>';
                echo '<td align="center"><span class="texte_info12">' . $data_profil['prenom'] . " " . $data_profil['nom'] . '</span></td>';
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

                echo '<input type="hidden" value="' . $data_categorie_fr . '" name="datafr">';
                echo '<input type="hidden" value="' . $data_categorie . '" name="data">';
                echo '<input type="hidden" value="' . $tables[$i] . '" name="table">';
                echo '<input type="hidden" value="' . $count . '" name="total">';
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



    }else {







        // SI LA TABLA NO ES LA DE CATERGORIA ENTONCES HAZ LO SIGUIENTE
        // SI LA TABLA NO ES LA DE CATERGORIA ENTONCES HAZ LO SIGUIENTE
        // SI LA TABLA NO ES LA DE CATERGORIA ENTONCES HAZ LO SIGUIENTE
        // SI LA TABLA NO ES LA DE CATERGORIA ENTONCES HAZ LO SIGUIENTE
        // SI LA TABLA NO ES LA DE CATERGORIA ENTONCES HAZ LO SIGUIENTE
        // SI LA TABLA NO ES LA DE CATERGORIA ENTONCES HAZ LO SIGUIENTE



        if ($resultat) {
            while ($data = mysql_fetch_assoc($resultat)) {
                if ($data['status'] == 2) {
                    // chercher tous les texte en francais pour comparer avec la traduction
                    $textfr = 'SELECT * FROM ' . $tables[$i] . ' WHERE code="' . $lang_revision . '"';
                    $resulfr = mysql_query($textfr);
                    $datafr = mysql_fetch_assoc($resulfr);
                    foreach ($datafr as $cle => $value) {
                        //codifier la data en francais
                        if ($cle != "id" && $cle != "code" && $cle != "status" && $cle != "id_user" && $cle != "ap_ref") {
                            $datafr[$cle] = str_replace('>', ')', $value);
                            $datafr[$cle] = str_replace('<', '(', $datafr[$cle]);
                            $datafr[$cle] = str_replace(' ', '!', $datafr[$cle]);
                            $datafr[$cle] = str_replace('"', '|', $datafr[$cle]);
                            $datafr[$cle] = str_replace("\n", '~', $datafr[$cle]);
                            $datafr[$cle] = str_replace("\r", '°', $datafr[$cle]);
                        }
                    }
                }
                if ($data) {
                    foreach ($data as $cle => $value) {
                        if ($cle === 'id_user') {
                            // chercher les profil qui corresponde a chaque traduction
                            $requete2 = 'SELECT nom, prenom FROM profil WHERE id=' . $value;
                            $resultat2 = mysql_query($requete2);
                            if ($resultat2) {
                                $data_profil = mysql_fetch_array($resultat2);
                            }

                            if ($data_profil) {
                                //$id = "id";
                                // codifier la data de traduction
                                foreach ($data as $cle => $value) {
                                    if ($cle != "id" && $cle != "code" && $cle != "status" && $cle != "id_user" && $cle != "ap_ref") {

                                        $data[$cle] = str_replace('>', ')', $value);
                                        $data[$cle] = str_replace('<', '(', $data[$cle]);
                                        $data[$cle] = str_replace(' ', '!', $data[$cle]);
                                        $data[$cle] = str_replace('"', '|', $data[$cle]);
                                        $data[$cle] = str_replace("\n", '~', $data[$cle]);
                                        $data[$cle] = str_replace("\r", '°', $data[$cle]);
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
                                echo '<td align="center"><span class="texte_info12">' . $data_profil['prenom'] . " " . $data_profil['nom'] . '</span></td>';
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


                                $data = base64_encode(serialize($data));
                                $dafr = base64_encode(serialize($datafr));

                                //echo '<input type="hidden" value="' . $data_categorie_fr . '" name="data_categorie_fr">';
                                echo '<input type="hidden" value="' . $data . '" name="data">';
                                echo '<input type="hidden" value=' . $dafr . ' name="datafr">';
                                echo '<input type="hidden" value="' . $tables[$i] . '" name="table">';
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


                } else {
                    echo "error";
                }
            }
            //var_dump($resultSet);

        } else {
            //echo $i;
        }
    }
}


function referent_langue()
{

    echo '<form action="referent.php" method="post">';

    echo '<p>';
    echo '<table border="0" cellpadding="7" cellspacing="2" bgcolor="' . couleur(2) . '" width="220">';// couleur claire
    echo '<tr>';
    echo '<td colspan="2" align="center">';
    echo '<span class="Texte_menu">Langues des Traductions</span>';// Cambiar
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="2" align="center">';
    echo '<center>';
    echo '<select name="lang" size="1">';

    $requete = 'SELECT * FROM langues_profil WHERE id_user=' . $_SESSION['id'];
    $recuplg = mysql_query($requete);

    while ($choixlg = mysql_fetch_assoc($recuplg)) {
        $requete2 = 'SELECT * FROM langues WHERE code="' . $choixlg['code'] . '"';
        $nomLg = mysql_query($requete2);
        $nomLg = mysql_fetch_assoc($nomLg);
        echo '<option value="' . $choixlg['code'] . '">' . $nomLg['nom'];
    }

    echo '</select></center>';
    echo '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="2" bgcolor="' . couleur(1) . '">';//couleur fonc�e
    echo '<center>';
    echo '<span class="texte_menu"><input type="submit" value="' . choix_langue() . '" name="submitButtonName"></span></center>'; // Choisir cette langue
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</p>';
    echo '</form>';


}

Function textFrenchCategorie($tables,$i){
    // recuperar texto en frances
    $requete = 'SELECT * FROM categorie';
    $resultat = mysql_query($requete);
    $count = 1;
    $array_categorie = Array();
    while ($cat = mysql_fetch_assoc($resultat)) {

        $requete2 = 'SELECT * FROM ' . $tables[$i] . ' WHERE category=' . $cat['id'] . ' AND code="fr" AND status=1 AND ap_ref=1';
        $recupcont = mysql_query($requete2);
        $donnees = mysql_fetch_assoc($recupcont);

        foreach ($donnees as $cle => $value) {
            if ($cle == "name") {
                array_push($array_categorie, $value);
                //echo '<table border="0" cellpadding="4" cellspacing="1"  width="450" height="45">';
                //echo '<tr>';
                ////////////		////////////		echo 'Escribo aqui';
                //echo '<td align="center" bgcolor="'.couleur(2).'"><span class="texte_info12">'.$value.'</span></td> <!--Cambiar-->';
                //echo '</tr>';
                //echo '</table>';
            }
        }
        $count = $count + 1;
    }
    $count = 0;
   // var_dump($array_categorie);
   return $data_categorie_fr = base64_encode(serialize($array_categorie));
    //echo $data_categorie_fr;
}