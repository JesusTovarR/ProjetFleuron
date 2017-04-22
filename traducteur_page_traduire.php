<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}
$_SESSION['colonnes']=array();
 if(isset($_POST['table'])&&isset($_POST['code_id'])&&isset($_POST['code_lg'])){
	 $_SESSION['table']=$_POST['table'];//nom de la table dans la base de données
	 $_SESSION['code_id']=$_POST['code_id'];//identifiant du code dans la table de la bd
	 $_SESSION['code_lg']=$_POST['code_lg'];//code de la langue
 }else if(isset($_POST['table'])&&isset($_POST['code_lg'])){
	 $_SESSION['table']=$_POST['table'];//nom de la table dans la base de données
	 $_SESSION['code_id']="";//identifiant du code dans la table de la bd
	 $_SESSION['code_lg']=$_POST['code_lg'];//code de la langue
 }else if(!isset($_SESSION['table'])&&!isset($_SESSION['code_id'])&&!isset($_SESSION['code_lg'])){
	 include('include/close_connectionBase.inc');
	 header('Location: traducteur.php'); // redirection
 }

//Afichage du formulaire pour modifier
function edition_page()
{
	//Formulaire pour la table soustitres
	if($_SESSION['formulaire']==5){
		//requête pour récupérer les sosutitres
		$requete = 'SELECT * FROM '.$_SESSION['table'].' WHERE id_resource='. $_SESSION['id_res'].' AND code="'.$_SESSION['code_lg'].'" AND id_user='.$_SESSION['id'];
		$recupcont = mysql_query($requete);
		while ($data= mysql_fetch_assoc($recupcont)){
				echo '<tr>';
				echo '<td align="center">';
				echo '<textarea class="matextarea" name="text" cols="60" rows="25">'.$data['text'].'</textarea>';//affichage du soustitres
				echo '</td>';
				echo '</tr>';
		}
		echo '<input type="hidden" value="'.$_SESSION['table'].'" name="table">';//nom de la table où les soustitres appartient
		echo '<input type="hidden" value="'.$_SESSION['code_lg'].'" name="code_lg">';//code de la langue des soustitres
		echo '<input type="hidden" value="4" name="formulaire">';

	}else{
		//Formulaire pour tous les tables sauf soustitres, categorie_traduction, ressources_traduction
		//requête pour récupérer le contenu à traduire
		$requete = 'SELECT * FROM '.$_SESSION['table'].' WHERE id='.$_SESSION['code_id'].' AND code="'.$_SESSION['code_lg'].'"';
		$recupcont = mysql_query($requete);
		$donnees = mysql_fetch_assoc($recupcont);
		$count=1;
		foreach ($donnees as $cle => $value){
			if($cle=="id"||$cle=="code"||$cle=="status"||$cle=="id_user"||$cle=="ap_ref"){

			}else{
				$_SESSION['colonnes'][$count]=$cle;//nombre de lignes à enregistrer
				echo '<tr>';
				echo '<td align="center">';
				if($_SESSION['formulaire']==1){
					echo '<textarea name="value'.$count.'" cols="60" rows="31">'.$value.'</textarea>';//contenu avec balises html
				}else if($_SESSION['formulaire']==2){
					echo '<textarea class="matextarea" name="value'.$count.'" cols="60" rows="1">'.$value.'</textarea>';//contenu sans balises html
				}
				echo '</td>';
				echo '</tr>';
				$count=$count+1;
			}
		}
		echo '<input type="hidden" value="'.$_SESSION['table'].'" name="table">';//nom de la table
		echo '<input type="hidden" value="'.$_SESSION['code_id'].'" name="code_id">';//identifiant du code
		echo '<input type="hidden" value="'.$_SESSION['code_lg'].'" name="code_lg">';//code de la langue
		echo '<input type="hidden" value="1" name="formulaire">';//type de formulaire
		$count=0;
	}
}

//Afichage du formulaire pour modifier
function edition_page_type2()
{
	//Formulaire pour la table categorie_traduction
	if($_SESSION['formulaire']==3) {
		//requête pour récupérer les identifiants des categories
		$requete = 'SELECT * FROM categorie';
		$resultat = mysql_query($requete);
		$count = 1;
		echo '<form style="display: none" name="FormName" action="traducteur_update.php" method="post">';
		while($cat= mysql_fetch_assoc($resultat)) {
			//on récupére les categories une par une
			$requete2 = 'SELECT * FROM ' . $_SESSION['table'] . ' WHERE category=' . $cat['id'] . ' AND code="' . $_SESSION['code_lg'] . '" AND id_user='.$_SESSION['id'];
			$recupcont = mysql_query($requete2);
			$donnees = mysql_fetch_assoc($recupcont);
			foreach ($donnees as $cle => $value) {
				if($cle=="id"){
					echo '<input type="hidden" value="' . $value . '" name="id'.$count.'">';//id de la traduction de la categorie dans la table categorie_traduction
				}
				if ($cle == "name") {
					echo '<tr>';
					echo '<td align="center">';
					echo '<textarea class="matextarea" name="value' . $count . '" cols="60" rows="1">' . $value . '</textarea>';//text à traduire
					echo '</td>';
					echo '</tr>';
				}
			}
			$count = $count + 1;
		}
		echo '<input type="hidden" value="' . $_SESSION['table'] . '" name="table">';//nom de la table
		echo '<input type="hidden" value="' . $_SESSION['code_lg'] . '" name="code_lg">';//code de la langue
		echo '<input type="hidden" value="'.$count.'" name="total">';//total des éléments enregistrés
		echo '<input type="hidden" value="2" name="formulaire">';
		$count = 0;
	}else if($_SESSION['formulaire']==4) {
		//Formulaire pour la table ressources_traduction
		$requete = 'SELECT * FROM ' . $_SESSION['table'] . ' WHERE category=' . $_SESSION['ressource'] . ' AND code="' . $_SESSION['code_lg'] . '" AND id_user='.$_SESSION['id'].' ORDER BY title ASC';
		$resultat = mysql_query($requete);
		$dat=0;
		while($data= mysql_fetch_assoc($resultat)) {
			echo '<form style="display: none" name="FormName" action="traducteur_update.php" method="post">';
			foreach ($data as $cle => $value) {
				if($cle=="id"){
					echo '<input type="hidden" value="' . $value . '" name="idRessources">';//identifiant du ressource
					$dat=$value;
				}
				if ($cle == "title" || $cle == "description") {
					echo '<tr>';
					echo '<td align="center">';
					if($cle == "description"){
						echo '<textarea class="matextarea" name="' . $cle . '" cols="60" rows="5">' . $value . '</textarea>';//titre du ressource
					}else{
						echo '<textarea class="matextarea" name="' . $cle . '" cols="60" rows="1">' . $value . '</textarea>';//description du ressource
					}
					echo '</td>';
					echo '</tr>';
				}
			}
			echo '<input type="hidden" value="' . $_SESSION['table'] . '" name="table">';//nom de la table
			echo '<input type="hidden" value="' . $_SESSION['code_lg'] . '" name="code_lg">';//code de la langue
			echo '<input type="hidden" value="3" name="formulaire">';//type de formulaire
			echo '<tr>';
			echo '<td align="center">';
			echo '<input class="btn" type="submit" value="'. content("btn2").'" name="submitButtonName">';//Enregistrer
			echo '</form>';
			echo '<a href="traducteur_demande_referent.php?dat='.$dat.'"><input class="btn" type="submit" value="'.content("btn").'" name="submitButtonName"></a>';//Demande référent
			echo '</td>';
			echo '</tr>';
		}
	}

}

//Affichage du text en francaise
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
				echo '<tr>';
				echo '<td align="center">';
				if ($_SESSION['formulaire'] == 1) {
					echo '<textarea class="matextarea" name="value'.$count.'" cols="60" rows="23" disabled>'.$value.'</textarea>';
				} else if ($_SESSION['formulaire'] == 2) {
					echo '<textarea class="matextarea" name="value'.$count.'" cols="60" rows="1" disabled>'.$value.'</textarea>';
				}
				echo '</td>';
				echo '</tr>';
				$count = $count + 1;
			}
		}
		$count = 0;
	}

}

//Affichage du text en francaise
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
					echo '<tr>';
					echo '<td align="center">';
					echo '<textarea class="matextarea" name="" cols="60" rows="1" disabled>'.$value.'</textarea>';
					echo '</td>';
					echo '</tr>';
				}
			}
			$count = $count + 1;
		}
		$count = 0;
	}else if($_SESSION['formulaire']==4) {
		$requete2 = 'SELECT id_resource FROM ' . $_SESSION['table'] . ' WHERE category=' . $_SESSION['ressource'] . ' AND code="' . $_SESSION['code_lg'] . '" AND id_user='.$_SESSION['id'].' ORDER BY title ASC';
		$resultat2 = mysql_query($requete2);
		while($data2= mysql_fetch_assoc($resultat2)) {
			$requete = 'SELECT * FROM ' . $_SESSION['table'] . ' WHERE id_resource='.$data2['id_resource'].' AND category=' . $_SESSION['ressource'] . ' AND code="fr" AND ap_ref=1 ORDER BY title ASC';
			$resultat = mysql_query($requete);
			while($data= mysql_fetch_assoc($resultat)) {
				echo '<tr>';
				echo '<td align="center">';
				echo '<textarea class="matextarea" name="" cols="60" rows="1" disabled>' . $data['title'] . '</textarea>';
				echo '<textarea class="matextarea" name="" cols="60" rows="5" disabled>' . $data['description'] . '</textarea>';
				echo '</td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td align="center">';
				echo '<input class="btn2" type="submit" value="Traduction en francaise" name=""><!--Cambiar-->';
				echo '</td>';
				echo '</tr>';

			}
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
											<span class="titre_admin"><?php echo page_traducteur("title6");?></span>
										</td>
										<td width="150" align="center">
											<?php
											if($_SESSION['formulaire']!=4&&$_SESSION['formulaire']!=5){
											?>
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="150">
												<tr>
													<td align="center">
														<a href="traducteur_demande_referent.php"><span class="texte_menu"><?php echo content("btn");?></span></a><!--Cambiar-->
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
										<table border="0" cellpadding="0" cellspacing="5" width="900" bgcolor="<?php echo couleur(1);?>'">
											<tr>
												<td style="vertical-align: top;">
													<table border="0" cellspacing="0">
														<tr>
															<td align="center">
																<table border="0" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="425" height="60">
																	<tr>
																		<td align="center" >
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
												<td style="vertical-align: top;">
													<table border="0" cellspacing="0">
														<tr>
															<td align="center">
																<table border="0" cellpadding="0" cellspacing="0" bgcolor="<?php echo couleur(1);?>'" width="425" height="60">
																	<tr>
																		<td align="center">
																			<?php if($_SESSION['formulaire']==3||$_SESSION['formulaire']==4){
																				edition_page_type2();
																			}else{
																				echo '<form style="display: none" FormName="" action="traducteur_update.php" method="post">';
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
								<center>
									<?php
										if($_SESSION['formulaire']!=4) {
									?>
											<input class="btn3" type="submit" value="<?php echo content("btn2");?>" name="submitButtonName"><!--Cambiar-->
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