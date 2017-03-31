<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

if($_SESSION['formulaire']==1||$_SESSION['formulaire']==2){
	$requete = 'UPDATE ' .  $_SESSION['table'] . ' SET status=2 WHERE id=' .$_SESSION['code_id'] . ' AND ap_ref=0 AND id_user=' . $_SESSION['id'] . ' AND code="' .  $_SESSION['code_lg'] . '"';
    $recupcont = mysql_query($requete);
}else if($_SESSION['formulaire']==3){
	$categories='SELECT id FROM categorie_traduction';
	$recup=mysql_query($categories);
	while($data=mysql_fetch_assoc($recup)){
		$requete = 'UPDATE ' . $_SESSION['table'] . ' SET status=2 WHERE category=' . $data["id"] . ' AND ap_ref=0 AND id_user=' . $_SESSION['id'] . ' AND code="' . $_SESSION['code_lg'] . '"';
		$recupcont = mysql_query($requete);
	}
}else if($_SESSION['formulaire']==4){
		if(isset($_GET['dat'])){
			$requete = 'UPDATE ' . $_SESSION['table'] . ' SET status=2 WHERE id=' . $_GET['dat'] . ' AND ap_ref=0 AND id_user=' . $_SESSION['id'] . ' AND code="' . $_SESSION['code_lg'] . '"';
			$recupcont = mysql_query($requete);
		}
}else if($_SESSION['formulaire']==5){
	if(isset($_GET['dat'])){
	$requete = 'UPDATE ' . $_SESSION['table'] . ' SET status=2 WHERE id_resource=' . $_GET['dat'] . ' AND ap_ref=0 AND id_user=' . $_SESSION['id'] . ' AND code="' . $_SESSION['code_lg'] . '"';
	$recupcont = mysql_query($requete);
	}
}

include('include/close_connectionBase.inc');
header('Location: traducteur.php'); // redirection
?>