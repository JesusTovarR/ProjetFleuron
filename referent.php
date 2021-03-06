<?php
/**
 * Created by PhpStorm.
 * User: dano
 * Date: 20/03/17
 * Time: 23:56
 */


include('include/open_connectionBase.inc'); // connection � la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



if (isset($_GET["action"])) {
    $action=$_GET["action"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}

if (isset($_GET["message"])) {
    $message=$_GET["message"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}else{
    $message=0;
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



                            <p>
                                <?php include('include/referent_accueil_contenu.inc'); ?>
                            </p>





                        </td>
                        <!-- Fin partie centrale -->
                        <!-- Colonne de droite -->
                        <td width="250" align="right" valign="top">
                            <table border="0" cellpadding="5" cellspacing="2">
                                <?php if ($_SESSION['niveau']<1) { ?>
                                    <tr>
                                        <td align="right">
                                            <!-- Module d'affichage des choix des langues disponibles - table LG -->
                                            <?php include('include/choix_langue.inc');  ?>
                                        </td>

                                    </tr>
                                <?php } ?>
                                <?php if ($_SESSION['niveau']<1) { ?>
                                    <tr>
                                        <td align="right">
                                            <!-- Module d'affichage du formulaire de connexion -->
                                            <?php include('include/login.inc');  ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                <td align="right">
                                    <!-- Module d'affichage du formulaire pour trier les resultats des bruillons par langue  -->
                                    <?php //include('include/traducteur_ajouter_traduction.inc');  ?>
                                    <?php referent_langue(); ?>
                                </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <!-- Module d'affichage du formulaire de recherche  -->
                                        <?php include('include/moteurderecherche.inc');  ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <!-- Module d'affichage du dernier media publi�  -->
                                        <?php include('include/derniermedia.inc');  ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <!-- Module d'affichage menu utilisateur  -->
                                        <?php include('include/menu_FavorisNotesComm.inc');  ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <!-- Module d'affichage menu Admin  -->
                                        <?php include('include/menu_admin.inc');  ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <!-- Fin colonne de droite -->
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