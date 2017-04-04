<?php

include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}

?>

<html>

	<head>
		<?php include('include/head.inc');  // header ?>
		<?php include('include/alexandria.inc');  // dictionnaire alexandria ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
		<link href="styles/new_style.css" rel="styleSheet" type="text/css">
	</head>

	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="white">
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
								<table width="100%" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(2); //couleur claire ?>" width="220">
									<tr>
										<td><a class="titre" href="admin_referent.php">Retour</a></td>
										<td align="center" height="30">
											<span class="titre"><?php echo versionlinguistique(150); //Reférent ?> Demande Referent</span>
										</td>
									</tr>
								</table>

<p>
    <table border="0" cellpadding="4" cellspacing="0"  width="600" height="60">

        <tr height="40" bgcolor="#e03e3e">
            <td align="center" class="cell">Nom</td>
            <td align="center" class="cell">Prenom</td>
            <td align="center" class="cell">Profil</td>
            <td align="center" class="cell">Validation</td>
        </tr>

        <?php

    $req = "SELECT * FROM profil WHERE demande_referent = 1";
    $resultat = mysql_query($req);
	
    $i = 0;
    while ($data = mysql_fetch_assoc($resultat)){

				$id_profil = $data['id'];
 
				$_SESSION['id_profil'.$i] = $id_profil;
       echo '<tr height="40">
            <td align="center" class="cell" >'.$data['nom'].'</td>
            <td align="center" class="cell" >'.$data['prenom'].'</td>';
            echo "<td align='center' class='cell' width='210'><form action='demande_referent_profil.php' method='POST'>
						<input type='hidden' name='nb' value='$i'>	
                        <input class='btn' type='submit' value='Profil' name=''>
                    </form></td>";
            
            echo "<td align='center' class='cell'><form method='POST'>
                        <input type='radio' name='choix$i' value='oui' checked='checked'><label>oui</label>
                        <input type='radio' name='choix$i' value='non'><label>non</label>
                        <input type='submit' name='form$i'>
                    </form></td></tr>";

            $new_ref ="";
            if(isset($_POST["form$i"]) && isset($_POST["choix$i"])){
                        if($_POST["choix$i"] == 'oui'){
                            
                            
                            $r = 'UPDATE profil SET niveau= 30, demande_referent= 2 WHERE id ='.$data['id'].'';
                            //$res = $db->prepare($r);
                            $res= mysql_query($r);
							//mysql_fetch_assoc($res);
                            //$res->execute();

                        }elseif($_POST["choix$i"] == 'non'){
                            echo "refus";
                            $r = 'UPDATE profil SET demande_referent = 3 WHERE id ='.$data['id'].'';
                            $res = mysql_query($r);
							mysql_fetch_assoc($res);
                            //$res->execute();
                            
                    }
       
            
        }
           $i+=1;
     } 
	 $_SESSION['i']=$i;?> 
    </table>
    </td>
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