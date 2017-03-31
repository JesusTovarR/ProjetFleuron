<?php
include('include/open_connectionBase.inc');
include('include/initialisation_page.inc');

//$_POST['data'] = unserialize(str_replace('%','"',str_replace('!',' ',$_POST['data'])));
$_POST["data"]=unserialize(base64_decode($_POST["data"]));
$_POST['data'] = str_replace('!',' ',$_POST['data']);
$_POST['data'] = str_replace('(','<',$_POST['data']);
$_POST['data'] = str_replace(')','>',$_POST['data']);
$_POST['data'] = str_replace('|','"',$_POST['data']);
$_POST['data'] = str_replace('~',"\n",$_POST['data']);
$_POST['data'] = str_replace('°',"\r",$_POST['data']);

echo "<pre>";
print_r($_POST);
echo "</pre>";

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
if($_POST['table']=='categorie_traduction' && $_POST['submit']==='Aceptar Traduction'){
    for ($i=1; $i<=($_POST['total']-1); $i++){
        $requete = 'UPDATE ' . $_POST['table'] . ' SET name="' .  addslashes($_POST["value".$i]). '" WHERE id=' . $_POST['data']["id".$i];
        $recupcont = mysql_query($requete);
    }
}else if($_POST['table']!='categorie_traduction' && $_POST['submit']==='Aceptar Traduction'){
    $requete = 'UPDATE '.$_POST['table'].' SET '.$val.', status='.$_POST['data']['status'].' WHERE id='.$_POST['data']['id']. '';
    mysql_query($requete);
}else{
    $requete = 'DELETE FROM '.$_POST['table'].' WHERE id='.$_POST['data']['id'];
    mysql_query($requete);
}


include('include/close_connectionBase.inc');


header('Location: referent.php'); // redirection
?>