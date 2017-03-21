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
    //var_dump($_POST);
    if($_POST['data']){
        $_POST['data'] = str_replace('!',' ',unserialize($_POST['data']));
        //var_dump($_POST['data']);
        //var_dump($_POST['table']);
        $_SESSION['colonnes']=array();
        $count=1;
        foreach ($_POST['data'] as $cle => $value) {
            if ($cle == "id" || $cle == "code" || $cle == "status" || $cle == "id_user") {

            } else {
                $_SESSION['colonnes'][$count]=$cle;
                echo '<tr>';
                echo '<td align="center">';
                echo '<textarea name="value'.$count.'" cols="110" rows="2">'.$value.'</textarea>';
                $count += 1;
            }
            echo '</td>';
            echo '</tr>';
        }
    }
}

function delete_traduccion(){

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
                                    <table border="0" cellpadding="0" cellspacing="5" width="600">
                                        <?php revision_referent();
                                            $table = $_POST['table'];
                                        $da= (serialize($_POST['data']));
                                        $d = str_replace(' ','!',$da);
                                        $d = str_replace('"','%',$da);
                                        ?>
                                        <input type="hidden" value="<?php echo $table ?>" name="table">
                                        <input type="hidden" value="<?php echo $d ?>" name="data">
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