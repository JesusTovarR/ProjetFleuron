<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

if($_POST['formulaire']==1) {
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

    $requete = 'UPDATE ' . $_POST['table'] . ' SET ' . $val . ' WHERE id=' . $_POST['code_id'] . ' AND id_user=' . $_SESSION['id'] . ' AND code="' . $_POST['code_lg'] . '"';

    $recupcont = mysql_query($requete);
}else if($_POST['formulaire']==2){
    for ($i=1; $i<=$_POST['total']; $i++){


        $requete = 'UPDATE ' . $_POST['table'] . ' SET name="' .  addslashes($_POST["value".$i]). '" WHERE id=' . $_POST["id".$i] . ' AND id_user=' . $_SESSION['id'] . ' AND code="' . $_POST['code_lg'] . '"';

        $recupcont = mysql_query($requete);
    }

}

include('include/close_connectionBase.inc');


header('Location: traducteur.php'); // redirection
?>