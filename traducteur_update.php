<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

if($_POST['formulaire']==1) {//type de formulaire->une seul mise à jour
    $nb_col = count($_SESSION['colonnes']);//nombre des éléments ajoutés
    $col = "";
    $val = "";
    for ($i = 1; $i <= $nb_col; $i++) {
        if ($i == 1) {
            $col = "" . $_SESSION['colonnes'][$i];
            $val = $col . '=\'' . addslashes($_POST['value' . $i . '']) . '\'';//on retire les slash
        } else {
            $col = $_SESSION['colonnes'][$i];
            $val = $val . ', ' . $col . '=\'' . addslashes($_POST['value' . $i . '']) . '\'';//on retire les slash
        }
    }

    //On met à jour
    $requete = 'UPDATE ' . $_POST['table'] . ' SET ' . $val . ' WHERE id=' . $_POST['code_id'] . ' AND id_user=' . $_SESSION['id'] . ' AND code="' . $_POST['code_lg'] . '"';

    $recupcont = mysql_query($requete);
}else if($_POST['formulaire']==2){//type de formulaire-> plusieurs mise à jour de categories
    $POST_['total']=$POST_['total']-1;
    //on met à jour
    for ($i=1; $i<=$_POST['total']; $i++){

        //On met à jour
        $requete = 'UPDATE ' . $_POST['table'] . ' SET name="' .  addslashes($_POST["value".$i]). '" WHERE id=' . $_POST["id".$i] . ' AND id_user=' . $_SESSION['id'] . ' AND code="' . $_POST['code_lg'] . '"';

        $recupcont = mysql_query($requete);
    }

}else if($_POST['formulaire']==3){//type de formulaire-> une mise à jour d'une ressource
        $requete = 'UPDATE ' . $_POST['table'] . ' SET title="' .  addslashes($_POST['title']). '", description="' .  addslashes($_POST['description']). '" WHERE id=' . $_POST["idRessources"] . ' AND id_user=' . $_SESSION['id'] . ' AND code="' . $_POST['code_lg'] . '"';
        $recupcont = mysql_query($requete);
        include('include/close_connectionBase.inc');
        header('Location: traducteur_page_traduire.php'); // redirection
        die();
}else if($_POST['formulaire']==4){//type de formulaire-> une mise à jour d'un soustitre
    $requete = 'UPDATE ' . $_POST['table'] . ' SET text="' .  addslashes($_POST['text']). '" WHERE id_resource=' . $_SESSION["id_res"] . ' AND id_user=' . $_SESSION['id'] . ' AND code="' . $_POST['code_lg'] . '"';
    $recupcont = mysql_query($requete);
    include('include/close_connectionBase.inc');
    header('Location: traducteur_soustitres_categorie.php?&id_cat='.$_SESSION['id_cat']); // redirection
    die();
}

include('include/close_connectionBase.inc');


header('Location: traducteur.php'); // redirection
?>