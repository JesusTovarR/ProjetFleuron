<?php
/**
* Created by PhpStorm.
* User: dano
* Date: 21/03/17
* Time: 12:34
*/

include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

if (isset($_GET["action"])) {
$action=$_GET["action"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}

function revision_referent(){

if($_POST['data']){
$_POST["data"]=unserialize(base64_decode($_POST["data"]));
$_POST["datafr"]=unserialize(base64_decode($_POST["datafr"]));
$_POST['data'] = str_replace('!',' ',$_POST['data']);
$_POST['data'] = str_replace('(','<',$_POST['data']);
$_POST['data'] = str_replace(')','>',$_POST['data']);
$_POST['data'] = str_replace('|','"',$_POST['data']);
$_POST['data'] = str_replace('~',"\n",$_POST['data']);
$_POST['data'] = str_replace('°',"\r",$_POST['data']);


$_POST['datafr'] = str_replace('!',' ',$_POST['datafr']);
$_POST['datafr'] = str_replace('(','<',$_POST['datafr']);
$_POST['datafr'] = str_replace(')','>',$_POST['datafr']);
$_POST['datafr'] = str_replace('|','"',$_POST['datafr']);
$_POST['datafr'] = str_replace('~',"\n",$_POST['datafr']);
$_POST['datafr'] = str_replace('°',"\r",$_POST['datafr']);

$_SESSION['colonnes']=array();
$count=1;
foreach ($_POST['data'] as $cle => $value) {
if ( preg_match('#^id.*#s', $cle) || $cle == "id" || $cle == "code" || $cle == "status" || $cle == "id_user" || $cle == "ap_ref") {

} else {
$_SESSION['colonnes'][$count] = $cle;

//echo $_POST['data'][$cle][0];
if ($_POST['data'][$cle][0] == '<') {
include('include/traitementtexte.inc');

echo '<tr>';
    echo '<td class="text_original" width="400" align="center">';
        echo '<p  >' . $_POST['datafr'][$cle] . '</p>';
        echo '</td>';
    echo '<td align="center">';
        echo '<textarea name="value' . $count . '"cols="60" rows="48">' . $value . '</textarea>';
        $count += 1;
        } else {


        /*echo '<tr>';
    echo '<td align="center">';
        echo '<p>'.$_POST['datafr'][$cle].'</p>';
        echo '</td>';
    echo '</tr>';*/

// si la valor de $cle comence par value donc on enleve le mot "value"
if (preg_match('#^value.*#s', $cle)){
$rest = intval(substr($cle, 5,2));
$cle = $rest-1;
}

echo '<tr>';
    echo '<td width="400" align="center">';
        echo '<p>' . $_POST['datafr'][$cle] . '</p>';
        echo '</td>';
    echo '<td align="center">';
        echo '<textarea name="value' . $count . '"cols="60" rows="2">' . $value . '</textarea>';
        $count += 1;
        }
        }
        echo '</td>';
    echo '</tr>';
}
}
}


?>

<html>

<head>
    <?php include('include/head.inc');  // header ?>
    <?php include('include/alexandria.inc');  // dictionnaire alexandria ?>


    <link href="styles/styles.css" rel="styleSheet" type="text/css">

</head>

<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="white" >
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
    <tr height="67">
        <td align="center" valign="middle" bgcolor="<?php echo couleur(2); // couleur claire ?>" height="67">
            <!-- Module affichage du bandeau contenant le logo FLEURON -->
            <?php include('include/logo_fleuron.inc');  ?>
        </td>
    </tr>
    <tr height="40">
        <td bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" height="40" align="center">
            <?php
            // Menu Sup�rieur
            include('include/menu_top.inc');

            ?>
        </td>
    </tr>
    <tr>

        <td bgcolor="#f6f5ed" align="center" valign="top">
            <table border="0" cellpadding="10" cellspacing="2" width="900">
                <tr>
                    <!-- Partie centrale -->
                    <td valign="top">
                        <table width="100%" border="0">
                            <tr>
                                <td width="150">
                                    <table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
                                        <tr>
                                            <td align="center">
                                                <a href="referent.php"><span class="texte_menu"><?php echo page_modification("line97") //Retour ?></span></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="center">
                                    <span class="titre_admin">Traduire</span>
                                </td>
                                <td width="150" align="center">
                                    <span class="titre_admin"><?php echo page_modification("line106") //Editer ?></span>
                                </td>
                            </tr>
                        </table>
                        <center>
                            <br>
                            <form name="FormName" action="referent_update.php" method="post">
                                <table border="0" cellpadding="0" cellspacing="5" width="100%">
                                    <?php revision_referent();
                                    $table = $_POST['table'];
                                    if($table != "categorie_traduction"){
                                        $_POST['total']=0;
                                    }
                                    //echo "<pre>";
                                    //print_r($_POST['data']);
                                    //echo "</pre>";


                                    $_POST['data'] = str_replace('>', ')', $_POST['data']);
                                    $_POST['data'] = str_replace('<', '(', $_POST['data']);
                                    $_POST['data'] = str_replace(' ', '!', $_POST['data']);
                                    $_POST['data'] = str_replace('"', '|', $_POST['data']);
                                    $_POST['data'] = str_replace("\n", '~', $_POST['data']);
                                    $_POST['data'] = str_replace("\r", '°', $_POST['data']);
                                    $data = base64_encode(serialize($_POST['data']));



                                    //$da= (serialize($_POST['data']));
                                    //$d = str_replace(' ','!',$da);
                                    //$d = str_replace('"','%',$da);
                                    //echo $data;
                                    ?>
                                    <input type="hidden" value="<?php echo $table ?>" name="table">
                                    <input type="hidden" value="<?php echo $data ?>" name="data">
                                    <input type="hidden" value="<?php echo $_POST['total'] ?>" name="total">
                                </table>
                                <input class="boton verde" type="submit" value="Aceptar Traduction" name="submit"><!--Cambiar-->
                                <input class="boton rojo" type="submit" value="Rechazar Traduction" name="submit"><!--Cambiar-->
                            </form>

                    </td>

                </tr>
            </table>
        </td>
        <!-- Fin partie centrale -->
    </tr>
</table>
</td>
</tr>
<tr height="40">
    <td bgcolor="<?php echo couleur(2); // couleur clair ?>" height="40" align="center">
        <!-- Module d'affichage du bandeau de bas de page  -->
        <?php include('include/bandeau_basdepage.inc');  ?>
    </td>
</tr>
<tr height="150">
    <td height="150" align="center">
        <!-- Module d'affichage du dernier media publi�  -->
        <?php include('include/logo_basdepage.inc');  ?>
    </td>
</tr>
<tr>
    <td></td>
</tr>
</table>
</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>