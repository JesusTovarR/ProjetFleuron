<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}
$_SESSION['colonnes']=array();
 if(isset($_POST['table'])&&isset($_POST['code_id'])&&isset($_POST['code_lg'])){
	 $_SESSION['table']=$_POST['table'];
	 $_SESSION['code_id']=$_POST['code_id'];
	 $_SESSION['code_lg']=$_POST['code_lg'];
 }else if(isset($_POST['table'])&&isset($_POST['code_lg'])){
	 $_SESSION['table']=$_POST['table'];
	 $_SESSION['code_id']="";
	 $_SESSION['code_lg']=$_POST['code_lg'];
 }else if(!isset($_SESSION['table'])&&!isset($_SESSION['code_id'])&&!isset($_SESSION['code_lg'])){
	 include('include/close_connectionBase.inc');
	 header('Location: traducteur.php'); // redirection
 }

function edition_page()
{
	if($_SESSION['formulaire']==5){
		$requete = 'SELECT * FROM '.$_SESSION['table'].' WHERE id_resource='. $_SESSION['id_res'].' AND code="'.$_SESSION['code_lg'].'" AND id_user='.$_SESSION['id'];
		$recupcont = mysql_query($requete);
		while ($data= mysql_fetch_assoc($recupcont)){
				echo '<tr>';
				echo '<td align="center">';
				echo '<textarea class="matextarea" name="text" cols="60" rows="25">'.$data['text'].'</textarea>';
				echo '</td>';
				echo '</tr>';
		}
		echo '<input type="hidden" value="'.$_SESSION['table'].'" name="table">';
		echo '<input type="hidden" value="'.$_SESSION['code_lg'].'" name="code_lg">';
		echo '<input type="hidden" value="4" name="formulaire">';

	}else{
		$requete = 'SELECT * FROM '.$_SESSION['table'].' WHERE id='.$_SESSION['code_id'].' AND code="'.$_SESSION['code_lg'].'"';
		$recupcont = mysql_query($requete);
		$donnees = mysql_fetch_assoc($recupcont);
		$count=1;
		foreach ($donnees as $cle => $value){
			if($cle=="id"||$cle=="code"||$cle=="status"||$cle=="id_user"||$cle=="ap_ref"){

			}else{
				$_SESSION['colonnes'][$count]=$cle;
				echo '<tr>';
				echo '<td align="center">';
				if($_SESSION['formulaire']==1){
					echo '<textarea name="value'.$count.'" cols="60" rows="25">'.$value.'</textarea>';
				}else if($_SESSION['formulaire']==2){
					echo '<textarea class="matextarea" name="value'.$count.'" cols="60" rows="1">'.$value.'</textarea>';
				}
				echo '</td>';
				echo '</tr>';
				$count=$count+1;
			}
		}
		echo '<input type="hidden" value="'.$_SESSION['table'].'" name="table">';
		echo '<input type="hidden" value="'.$_SESSION['code_id'].'" name="code_id">';
		echo '<input type="hidden" value="'.$_SESSION['code_lg'].'" name="code_lg">';
		echo '<input type="hidden" value="1" name="formulaire">';
		$count=0;
	}
}

function edition_page_type2()
{
	if($_SESSION['formulaire']==3) {
		$requete = 'SELECT * FROM categorie';
		$resultat = mysql_query($requete);
		$count = 1;
		echo '<form name="FormName" action="traducteur_update.php" method="post">';
		while($cat= mysql_fetch_assoc($resultat)) {

			$requete2 = 'SELECT * FROM ' . $_SESSION['table'] . ' WHERE category=' . $cat['id'] . ' AND code="' . $_SESSION['code_lg'] . '" AND id_user='.$_SESSION['id'];
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
		echo '<input type="hidden" value="' . $_SESSION['table'] . '" name="table">';
		echo '<input type="hidden" value="' . $_SESSION['code_lg'] . '" name="code_lg">';
		echo '<input type="hidden" value="'.$count.'" name="total">';
		echo '<input type="hidden" value="2" name="formulaire">';
		$count = 0;
	}else if($_SESSION['formulaire']==4) {

		$requete = 'SELECT * FROM ' . $_SESSION['table'] . ' WHERE category=' . $_SESSION['ressource'] . ' AND code="' . $_SESSION['code_lg'] . '" AND id_user='.$_SESSION['id'];
		$resultat = mysql_query($requete);
		$dat=0;
		while($data= mysql_fetch_assoc($resultat)) {
			echo '<form name="FormName" action="traducteur_update.php" method="post">';
			foreach ($data as $cle => $value) {
				if($cle=="id"){
					echo '<input type="hidden" value="' . $value . '" name="idRessources">';
					$dat=$value;
				}
				if ($cle == "title" || $cle == "description") {
					echo '<tr>';
					echo '<td align="center">';
					echo '<textarea class="matextarea" name="' . $cle . '" cols="60" rows="1">' . $value . '</textarea>';
					echo '</td>';
					echo '</tr>';
				}
			}
			echo '<input type="hidden" value="' . $_SESSION['table'] . '" name="table">';
			echo '<input type="hidden" value="' . $_SESSION['code_lg'] . '" name="code_lg">';
			echo '<input type="hidden" value="3" name="formulaire">';
			echo '<tr>';
			echo '<td align="center">';
			echo '<input type="submit" value="Enregistrer" name="submitButtonName"><!--Cambiar-->';
			echo '</form>';
			echo '<a href="traducteur_demande_referent.php?dat='.$dat.'"><input type="submit" value="Referent" name="submitButtonName"></a><!--Cambiar-->';
			echo '<br>';
			echo '</td>';
			echo '</tr>';
		}
	}

}

function edition_page_fr()
{
	if($_SESSION['formulaire']==5){
		$requete = 'SELECT * FROM '.$_SESSION['table'].' WHERE id_resource='. $_SESSION['id_res'].' AND code="fr" AND status=1 AND ap_ref=1';
		$recupcont = mysql_query($requete);
		while ($data= mysql_fetch_assoc($recupcont)){
			echo '<tr>';
			echo '<td align="center">';
			echo '<textarea class="matextarea" name="text" cols="60" rows="25" disabled>'.$data['text'].'</textarea>';
			echo '</td>';
			echo '</tr>';
		}
		echo '<input type="hidden" value="'.$_SESSION['table'].'" name="table">';
		echo '<input type="hidden" value="'.$_SESSION['code_lg'].'" name="code_lg">';
		echo '<input type="hidden" value="4" name="formulaire">';

	}else {
		$requete = 'SELECT * FROM ' . $_SESSION['table'] . ' WHERE status=1 AND ap_ref=1  AND code="fr"';
		$recupcont = mysql_query($requete);
		$donnees = mysql_fetch_assoc($recupcont);
		$count = 1;
		foreach ($donnees as $cle => $value) {
			if ($cle == "id" || $cle == "code" || $cle == "status" || $cle == "id_user" || $cle == "ap_ref") {

			} else {
				$_SESSION['colonnes'][$count] = $cle;
				if ($_SESSION['formulaire'] == 1) {
//				echo '<textarea name="value'.$count.'" cols="60" rows="25">'.$value.'</textarea>';
					echo '<table class="mytext" border="0" cellpadding="4" cellspacing="1">';
					echo '<tr>';
					echo '<td align="left" bgcolor="white"><span class="texte_info12">' . $value . '<span></td>';
					echo '</tr>';
					echo '</table>';
				} else if ($_SESSION['formulaire'] == 2) {
					echo '<table border="0" cellpadding="4" cellspacing="1"  width="450" height="45">';
					echo '<tr>';
					echo '<td align="center" bgcolor="' . couleur(2) . '"><span class="texte_info12">' . $value . '</span></td> <!--Cambiar-->';
					echo '</tr>';
					echo '</table>';
				}
				$count = $count + 1;
			}
		}
		$count = 0;
	}

}

function edition_page_type2_fr()
{
	if($_SESSION['formulaire']==3) {

		$requete = 'SELECT * FROM categorie';
		$resultat = mysql_query($requete);
		$count = 1;
		while($cat= mysql_fetch_assoc($resultat)) {

			$requete2 = 'SELECT * FROM ' . $_SESSION['table'] . ' WHERE category=' . $cat['id'] . ' AND code="fr" AND status=1 AND ap_ref=1';
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
	}else if($_SESSION['formulaire']==4) {
		$requete = 'SELECT * FROM ' . $_SESSION['table'] . ' WHERE category=' . $_SESSION['ressource'] . ' AND code="' . $_SESSION['code_lg'] . '" AND id_user='.$_SESSION['id'];
		$resultat = mysql_query($requete);
		echo '<form name="FormName" action="traducteur_update.php" method="post">';
		while($data= mysql_fetch_assoc($resultat)) {
				echo '<table border="0" cellpadding="4" cellspacing="1"  width="450" height="45">';
				echo '<tr>';
				echo '<td align="center" bgcolor="'.couleur(2).'"><span class="texte_info12">'.$data['title'].'</span></td> <!--Cambiar-->';
				echo '</tr>';
				echo '<tr>';
				echo '<td align="center" bgcolor="'.couleur(2).'"><span class="texte_info12">'.$data['description'].'</span></td> <!--Cambiar-->';
				echo '</tr>';
				echo '</table>';
		}
	}

}


?>

<html>

	<head>
		<?php include('include/head.inc');  // header ?>
		<?php include('include/alexandria.inc');  // dictionnaire alexandria ?>

		<?php if($_SESSION['formulaire']==1){include('include/traitementtexte.inc');} // Traitement de texte TinyMCE');  ?>
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
											<?php
											if($_SESSION['formulaire']!=4&&$_SESSION['formulaire']!=5){
											?>
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="traducteur_demande_referent.php"><span class="texte_menu">Referent</span></a><!--Cambiar-->
													</td>
												</tr>
											</table>
											<?php
												}else if($_SESSION['formulaire']==5){
												?>
												<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
													<tr>
														<td align="center">
															<a href="traducteur_demande_referent.php?dat=<?php echo $_SESSION['id_res']?>"><span class="texte_menu">Referent</span></a><!--Cambiar-->
														</td>
													</tr>
												</table>
												<?php
												}
												?>

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
																				<?php if($_SESSION['formulaire']==3||$_SESSION['formulaire']==4){
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
																			<?php if($_SESSION['formulaire']==3||$_SESSION['formulaire']==4){
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
										if($_SESSION['formulaire']!=4) {
									?>
											<input type="submit" value="Guardar" name="submitButtonName"><!--Cambiar-->
											</form>
									<?php
										}
									?>
								</center>
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