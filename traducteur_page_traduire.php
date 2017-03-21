<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}
$_SESSION['colonnes']=array();

function edition_page()
{
	$requete = 'SELECT * FROM '.$_POST['table'].' WHERE id='.$_POST['code_id'].' AND code="'.$_POST['code_lg'].'"';
	$recupcont = mysql_query($requete);
	$donnees = mysql_fetch_assoc($recupcont);
	$count=1;
	foreach ($donnees as $cle => $value){
		if($cle=="id"||$cle=="code"||$cle=="status"||$cle=="id_user"){

		}else{
			$_SESSION['colonnes'][$count]=$cle;
			echo '<tr>';
			echo '<td align="center">';
			if($_POST['formulaire']==1){
				echo '<textarea name="value'.$count.'" cols="110" rows="25">'.$value.'</textarea>';
			}else if($_POST['formulaire']==2){
				echo '<textarea name="value'.$count.'" cols="60" rows="2">'.$value.'</textarea>';
			}
			echo '</td>';
			echo '</tr>';
			$count=$count+1;
		}
	}
			echo '<input type="hidden" value="'.$_POST['table'].'" name="table">';
			echo '<input type="hidden" value="'.$_POST['code_id'].'" name="code_id">';
			echo '<input type="hidden" value="'.$_POST['code_lg'].'" name="code_lg">';
	$count=0;

}


?>

<html>

	<head>
		<?php include('include/head.inc');  // header ?>
		<?php include('include/alexandria.inc');  // dictionnaire alexandria ?>

		<?php if($_POST['formulaire']==1){include('include/traitementtexte.inc');} // Traitement de texte TinyMCE');  ?>
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
														<a href="traducteur.php"><span class="texte_menu"><?php echo page_modification("line97") //Retour ?></span></a>
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
									<form name="FormName" action="traducteur_update.php" method="post">
										<table border="0" cellpadding="0" cellspacing="5" width="600">
											<?php edition_page()?>
										</table>
										<input type="submit" value="Guardar" name="submitButtonName"><!--Cambiar-->
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