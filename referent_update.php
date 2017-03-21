<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

$_POST['data'] = unserialize(str_replace('%','"',str_replace('!',' ',$_POST['data'])));
var_dump($_POST);


$_POST['data']['status'] = 1;

$nb_col= count($_SESSION['colonnes']);
$col="";
$val="";
for($i=1; $i<=$nb_col; $i++){
    if($i==1){
        $col="".$_SESSION['colonnes'][$i];
        $val=$col.'=\''.addslashes($_POST['value'.$i.'']).'\'';
    }else{
        $col=$_SESSION['colonnes'][$i];
        $val=$val.', '.$col.'=\''.addslashes($_POST['value'.$i.'']).'\'';
    }
}

if($_POST['submit']==='Aceptar Traduction'){
    $requete = 'UPDATE '.$_POST['table'].' SET '.$val.', status='.$_POST['data']['status'].' WHERE id='.$_POST['data']['id']. '';
    mysql_query($requete);
}else{
    $requete = 'DELETE FROM '.$_POST['table'].' WHERE id='.$_POST['data']['id'];
    mysql_query($requete);
}


include('include/close_connectionBase.inc');


//header('Location: referent_update.php'); // redirection
?>