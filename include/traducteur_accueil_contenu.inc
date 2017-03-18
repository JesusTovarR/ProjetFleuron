<hr/>
<span class="texte_default"><?php echo versionlinguistique(36); //Choisir une catégorie ?></span>
<br>
<?php

$categorie=$_GET['categorie'];
if($categorie==1){
    $requete2='SELECT * FROM accueil_contenu WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);
    $nom_table="accueil_contenu";
    $formulaire=1;
}else if($categorie==2){
    $requete2='SELECT * FROM conseils_contenu WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);
    $nom_table="conseils_contenu";
    $formulaire=1;
}else if($categorie==3){
    $requete2='SELECT * FROM menu WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);
    $nom_table="menu";
    $formulaire=2;
}else{
    echo "error";
}


while ($code = mysql_fetch_assoc($codes))
{
	echo '<table border="0" cellspacing="0">';
	echo '<tr>';
	echo '<td>';
	echo '<table border="0" cellspacing="0">';
	echo '<tr>';
	echo '<td align="center">';
	echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="300" height="60">';
								echo '<tr>';
									$requete='SELECT nom, code FROM langues ORDER BY nom';
									$recuplg = mysql_query($requete);
									while ($choixlg2 = mysql_fetch_assoc($recuplg))
									{
										if($choixlg2['code']==$code['code']){
											echo '<td align="center"><span class="texte_info12">'.$choixlg2['nom'].'</span></td>';
										}
									}
									echo '</tr>';
								echo '</table>';
							echo '</td>';
						echo '</tr>';
					echo '</table>';
				echo '</td>';
			echo '<td>';
				echo '<table border="0" cellspacing="0">';
					echo '<tr>';
						echo '<td align="center">';
							echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="300" height="60">';
	echo '<tr>';
		echo '<form name="Formlg" action="traducteur_page_traduire.php" method="post">';
		echo '<input type="hidden" value="'.$code['code'].'" name="code_lg">';
		echo '<input type="hidden" value="'.$nom_table.'" name="table">';
		echo '<input type="hidden" value="'.$code['id'].'" name="code_id">';
		echo '<input type="hidden" value="'.$formulaire.'" name="formulaire">';
		echo '<td align="center"><span class="texte_info12"><input type="submit" value="Modificar" name="submitButtonName"></span></td>';//Cambiar
		echo '</form>';
	echo '</tr>';
	echo '</table>';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	echo '</td>';
	echo '</table>';
}

function ajouter_langue(){

echo '<form action="traducteur_insert.php?categorie='.$_GET['categorie'].'" method="post">';

	echo '<p>';
	echo '<table border="0" cellpadding="7" cellspacing="2" bgcolor="'.couleur(2).'" width="220">';// couleur claire
		echo '<tr>';
			echo '<td colspan="2" align="center">';
				echo '<span class="Texte_menu">Agregar nuevo idioma</span>';// Cambiar
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td colspan="2" align="center">';
				echo '<center>';
					echo '<select name="lg" size="1">';

						$requete='SELECT * FROM langues WHERE status=0 ORDER BY nom';
						$recuplg = mysql_query($requete);
						while ($choixlg = mysql_fetch_assoc($recuplg))
						{
							echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];
						}

	echo '</select></center>';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
	echo '<input type="hidden"  value="'.$choixlg['code'].'" name="code">';
			echo '<td colspan="2" bgcolor="'.couleur(1).'">';//couleur foncée
				echo '<center>';
					echo '<span class="texte_menu"><input type="submit" value="'.choix_langue().'" name="submitButtonName"></span></center>'; // Choisir cette langue
			echo '</td>';
		echo '</tr>';
	echo '</table>';
	echo '</p>';
	echo '</form>';


}

?>
