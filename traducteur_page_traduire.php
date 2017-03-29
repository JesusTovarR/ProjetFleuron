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
		if($cle=="id"||$cle=="code"||$cle=="status"||$cle=="id_user"||$cle=="ap_ref"){

		}else{
			$_SESSION['colonnes'][$count]=$cle;
			echo '<tr>';
			echo '<td align="center">';
			if($_POST['formulaire']==1){
				echo '<textarea name="value'.$count.'" cols="60" rows="25">'.$value.'</textarea>';
			}else if($_POST['formulaire']==2){
				echo '<textarea class="matextarea" name="value'.$count.'" cols="60" rows="1">'.$value.'</textarea>';
			}
			echo '</td>';
			echo '</tr>';
			$count=$count+1;
		}
	}
			echo '<input type="hidden" value="'.$_POST['table'].'" name="table">';
			echo '<input type="hidden" value="'.$_POST['code_id'].'" name="code_id">';
			echo '<input type="hidden" value="'.$_POST['code_lg'].'" name="code_lg">';
			echo '<input type="hidden" value="1" name="formulaire">';
	$count=0;

}

function edition_page_type2()
{
	if($_POST['formulaire']==3) {

		$requete = 'SELECT * FROM categorie';
		$resultat = mysql_query($requete);
		$count = 1;
		echo '<form name="FormName" action="traducteur_update.php" method="post">';
		while($cat= mysql_fetch_assoc($resultat)) {

			$requete2 = 'SELECT * FROM ' . $_POST['table'] . ' WHERE category=' . $cat['id'] . ' AND code="' . $_POST['code_lg'] . '" AND id_user='.$_SESSION['id'];
			$recupcont = mysql_query($requete2);
			$donnees = mysql_fetch_assoc($recupcont);
			foreach ($donnees as $cle => $value) {
				if($cle=="id"){
					echo '<input type="hidden" value="' . $value . '" name="id'.$count.'">';
				}
				if ($cle == "name") {
					echo '<tr>';
					echo '<td align="center">';
					echo '<textarea class="matextarea" name="value' . $count . '" cols="60" rows="1">' . $value . '</textarea>';
					echo '</td>';
					echo '</tr>';
				}
			}
			$count = $count + 1;
		}
		echo '<input type="hidden" value="' . $_POST['table'] . '" name="table">';
		echo '<input type="hidden" value="' . $_POST['code_lg'] . '" name="code_lg">';
		echo '<input type="hidden" value="'.$count.'" name="total">';
		echo '<input type="hidden" value="2" name="formulaire">';
		$count = 0;
	}else if($_POST['formulaire']==4) {

		$requete = 'SELECT * FROM ' . $_POST['table'] . ' WHERE category=' . $_SESSION['ressource'] . ' AND code="' . $_POST['code_lg'] . '" AND id_user='.$_SESSION['id'];
		$resultat = mysql_query($requete);
		echo '<form name="FormName" action="traducteur_update.php" method="post">';
		while($data= mysql_fetch_assoc($resultat)) {
			foreach ($data as $cle => $value) {
				if($cle=="id"){
					echo '<input type="hidden" value="' . $value . '" name="idRessources">';
					echo '<tr>';
					echo '<td align="center">';
					echo '<textarea class="matextarea" name="' . $cle . '" cols="60" rows="1">' . $value . '</textarea>';
					echo '</td>';
					echo '</tr>';
				}
				if ($cle == "title" || $cle == "description") {
					echo '<tr>';
					echo '<td align="center">';
					echo '<textarea class="matextarea" name="' . $cle . '" cols="60" rows="1">' . $value . '</textarea>';
					echo '</td>';
					echo '</tr>';
				}
			}
			echo '<input type="hidden" value="' . $_POST['table'] . '" name="table">';
			echo '<input type="hidden" value="' . $_POST['code_lg'] . '" name="code_lg">';
			echo '<input type="hidden" value="3" name="formulaire">';
			echo '<tr>';
			echo '<td align="center">';
			echo '<input type="submit" value="Guardar" name="submitButtonName"><!--Cambiar-->';
			echo '<br>';
			echo '</td>';
			echo '</tr>';
			echo '</form>';
		}
	}

}

function edition_page_fr()
{
	$requete = 'SELECT * FROM '.$_POST['table'].' WHERE status=1 AND ap_ref=1  AND code="fr"';
	$recupcont = mysql_query($requete);
	$donnees = mysql_fetch_assoc($recupcont);
	$count=1;
	foreach ($donnees as $cle => $value){
		if($cle=="id"||$cle=="code"||$cle=="status"||$cle=="id_user"||$cle=="ap_ref"){

		}else{
			$_SESSION['colonnes'][$count]=$cle;
			if($_POST['formulaire']==1){
//				echo '<textarea name="value'.$count.'" cols="60" rows="25">'.$value.'</textarea>';
				echo '<table class="mytext" border="0" cellpadding="4" cellspacing="1">';
				echo '<tr>';
				echo '<td align="left" bgcolor="white"><span class="texte_info12">'.$value.'<span></td>';
				echo '</tr>';
				echo '</table>';
			}else if($_POST['formulaire']==2){
				echo '<table border="0" cellpadding="4" cellspacing="1"  width="450" height="45">';
				echo '<tr>';
				echo '<td align="center" bgcolor="'.couleur(2).'"><span class="texte_info12">'.$value.'</span></td> <!--Cambiar-->';
				echo '</tr>';
				echo '</table>';
			}
			$count=$count+1;
		}
	}
	$count=0;

}

function edition_page_type2_fr()
{
	if($_POST['table']=="categorie_traduction") {

		$requete = 'SELECT * FROM categorie';
		$resultat = mysql_query($requete);
		$count = 1;
		while($cat= mysql_fetch_assoc($resultat)) {

			$requete2 = 'SELECT * FROM ' . $_POST['table'] . ' WHERE category=' . $cat['id'] . ' AND code="fr" AND status=1 AND ap_ref=1';
			$recupcont = mysql_query($requete2);
			$donnees = mysql_fetch_assoc($recupcont);
			foreach ($donnees as $cle => $value) {
				if ($cle == "name") {
					echo '<table border="0" cellpadding="4" cellspacing="1"  width="450" height="45">';
					echo '<tr>';
					echo '<td align="center" bgcolor="'.couleur(2).'"><span class="texte_info12">'.$value.'</span></td> <!--Cambiar-->';
					echo '</tr>';
					echo '</table>';
				}
			}
			$count = $count + 1;
		}
		$count = 0;
	}

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
										<table border="0" cellpadding="0" cellspacing="5" width="900" bgcolor="<?php echo couleur(1);?>'">
											<tr>
												<td>
													<table border="0" cellspacing="0">
														<tr>
															<td align="center">
																<table border="0" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="425" height="60">
																	<tr>
																		<td >
																				<?php if($_POST['formulaire']==3||$_POST['formulaire']==4){
																					edition_page_type2_fr();
																				}else{
																					edition_page_fr();
																				}?>
																		</td><!--Cambiar-->
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
												<td>
													<table border="0" cellspacing="0">
														<tr>
															<td align="center">
																<table border="0" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="425" height="60">
																	<tr>
																		<td align="center">
																			<?php if($_POST['formulaire']==3||$_POST['formulaire']==4){
																				edition_page_type2();
																			}else{
																				echo '<form name="FormName" action="traducteur_update.php" method="post">';
																				edition_page();
																			}?>
																		</td><!--Cambiar-->
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									<?php
										if($_POST['formulaire']!=4) {
									?>
											<input type="submit" value="Guardar" name="submitButtonName"><!--Cambiar-->
											</form>
									<?php
										}
									?>
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