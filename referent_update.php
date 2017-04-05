<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

//$_POST['data'] = unserialize(str_replace('%','"',str_replace('!',' ',$_POST['data'])));
if($_POST['table']=="soustitres"){
    if ($_POST['submit'] === 'Aceptar Traduction') {
        $select='DELETE FROM '.$_POST['table'].' WHERE status=1 AND ap_ref=1 AND code="'.$_POST['lang'].'" AND id_resource='.$_POST["idRes"];
        $exec=mysql_query($select);
        $requete = 'UPDATE ' . $_POST['table'] . ' SET text="'.addslashes($_POST['soustitre']).'", status=1, ap_ref=1 WHERE id=' . $_POST['resid'] . '';
        mysql_query($requete);

        $nombre_archivo = "ressources/".$_POST["idRes"].$_POST['lang'].".srt";

        if(file_exists($nombre_archivo))
        {
            $mensaje =$_POST['soustitre'];
        }

        else
        {
            $mensaje =$_POST['soustitre'];
        }

        if($archivo = fopen($nombre_archivo, "w"))
        {
            if(fwrite($archivo,   $mensaje))
            {
                echo "Se ha ejecutado correctamente";//Cambiar
            }
            else
            {
                echo "Ha habido un problema al crear el archivo";//Cambiar
            }

            fclose($archivo);
        }


    } else {
        $requete = 'DELETE FROM ' . $_POST['table'] . ' WHERE id=' . $_POST['resid'];
        mysql_query($requete);
    }
}else if($_POST['table']=="ressources_traduction"){
    if ($_POST['submit'] === 'Aceptar Traduction') {
        $select='DELETE FROM '.$_POST['table'].' WHERE status=1 AND ap_ref=1 AND code="'.$_POST['lang'].'" AND id_resource=' . $_POST['idRes'];
        $exec=mysql_query($select);
        $requete = 'UPDATE ' . $_POST['table'] . ' SET title="' . addslashes($_POST['title']) . '",  description="' . addslashes($_POST['description']) . '",status=1, ap_ref=1 WHERE id=' . $_POST['resid'] . '';
        mysql_query($requete);
    } else {
        $requete = 'DELETE FROM ' . $_POST['table'] . ' WHERE id=' . $_POST['resid'];
        mysql_query($requete);
    }
}else {
    $_POST["data"] = unserialize(base64_decode($_POST["data"]));
    $_POST['data'] = str_replace('!', ' ', $_POST['data']);
    $_POST['data'] = str_replace('(', '<', $_POST['data']);
    $_POST['data'] = str_replace(')', '>', $_POST['data']);
    $_POST['data'] = str_replace('|', '"', $_POST['data']);
    $_POST['data'] = str_replace('~', "\n", $_POST['data']);
    $_POST['data'] = str_replace('°', "\r", $_POST['data']);

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    $_POST['data']['status'] = 1;

    $nb_col = count($_SESSION['colonnes']);
    $col = "";
    $val = "";
    for ($i = 1; $i <= $nb_col; $i++) {
        if ($i == 1) {
            $col = "" . $_SESSION['colonnes'][$i];
            $val = $col . '=\'' . addslashes($_POST['value' . $i . '']) . '\'';
        } else {
            $col = $_SESSION['colonnes'][$i];
            $val = $val . ', ' . $col . '=\'' . addslashes($_POST['value' . $i . '']) . '\'';
        }
    }

    /*
    Array
    (
        [id1] => 31
        [value1] => proccc
        [id2] => 32
        [value2] =>  Sit
        [id3] => 33
        [value3] =>  Dem
        [id4] => 34
        [value4] =>  Obt
        [id5] => 35
        [value5] =>  Cho
        [id6] => 36
        [value6] =>  Com
        [id7] => 37
        [value7] =>  Exp
        [id8] => 38
        [value8] =>  Uti
        [id9] => 39
        [value9] =>  Com
        [id10] => 40
        [value10] =>  Tem
        [table] => categorie_traduction
        [code_lg] => ab
        [total] => 11
        [formulaire] => 2
        [submitButtonName] => Guardar
    )

    */

    if ($_POST['table'] == 'categorie_traduction') {
        if ($_POST['submit'] === 'Aceptar Traduction') {
            for ($i = 1; $i <= ($_POST['total'] - 1); $i++) {
                $select='SELECT category, code FROM ' . $_POST['table'] . ' WHERE id=' . $_POST['data']["id" . $i];
                $recup=mysql_query($select);
                while($data=mysql_fetch_assoc($recup)){
                    $select='DELETE FROM '.$_POST['table'].' WHERE status=1 AND ap_ref=1 AND code="'.$data['code'].'" AND category='.$data['category'];
                    $exec=mysql_query($select);
                    $requete = 'UPDATE ' . $_POST['table'] . ' SET name="' . addslashes($_POST["value" . $i]) . '", status=1, ap_ref=1 WHERE id=' . $_POST['data']["id" . $i];
                    $recupcont = mysql_query($requete);
                }
            }
        } else {
            for ($i = 1; $i <= ($_POST['total'] - 1); $i++) {
                $requete = 'DELETE FROM ' . $_POST['table'] . ' WHERE id=' . $_POST['data']["id" . $i];
                mysql_query($requete);
            }
        }
    } else {
        if ($_POST['submit'] === 'Aceptar Traduction') {
            $select='DELETE FROM '.$_POST['table'].' WHERE status=1 AND ap_ref=1 AND code="'.$_POST['data']['code'].'"';
            $exec=mysql_query($select);
            $requete = 'UPDATE ' . $_POST['table'] . ' SET ' . $val . ', status=' . $_POST['data']['status'] . ', ap_ref=1 WHERE id=' . $_POST['data']['id'] . '';
            mysql_query($requete);
        } else {
            $requete = 'DELETE FROM ' . $_POST['table'] . ' WHERE id=' . $_POST['data']['id'];
            mysql_query($requete);
        }
    }
}


include('include/close_connectionBase.inc');


header('Location: referent.php'); // redirection
?>