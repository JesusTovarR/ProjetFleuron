<hr/>
<span class="texte_default"><?php echo versionlinguistique(36); //Choisir une cat�gorie ?></span>
<br>
<?php

$categorie=$_GET['categorie'];
if(isset($_GET['type'])){
    $_SESSION['type']=$_GET['type'];
}

if(isset($_GET['id_res'])){
	$_SESSION['id_res']=$_GET['id_res'];
}


if(isset($_GET['cat_ressources'])){
    $_SESSION['ressource']=$_GET['cat_ressources'];
}

if($categorie==1){
    $requete2='SELECT * FROM accueil_contenu WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);
    $nom_table="accueil_contenu";
	$_SESSION['formulaire']=1;
	premier_structure($codes, $nom_table);
}else if($categorie==2){
    $requete2='SELECT * FROM conseils_contenu WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);
    $nom_table="conseils_contenu";
	$_SESSION['formulaire']=1;
	premier_structure($codes, $nom_table);
}else if($categorie==3){
    $requete2='SELECT * FROM contact_contenu WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);
    $nom_table="contact_contenu";
	$_SESSION['formulaire']=1;
	premier_structure($codes, $nom_table);
}else if($categorie==4){
	$requete2='SELECT * FROM menu WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="menu";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==5){
	$requete2='SELECT * FROM choix_langue WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="choix_langue";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==6){
	$requete2='SELECT * FROM conseils WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="conseils";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==7){
	$requete2='SELECT * FROM dernier_media WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="dernier_media";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==8){
	$requete2='SELECT * FROM login WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="login";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==9){
	$requete2='SELECT * FROM menu_admin WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="menu_admin";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==10){
	$requete2='SELECT * FROM moteur_de_recherche WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="moteur_de_recherche";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==11){
	$requete2='SELECT * FROM tableau_du_bord WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="tableau_du_bord";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==12){
	$requete2='SELECT * FROM affichage_ressource WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="affichage_ressource";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==13){
	$requete2='SELECT * FROM content WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="content";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==14){
	$requete2='SELECT * FROM page_edit WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="page_edit";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==15){
    if($_SESSION['type']==1){
        $requete2='SELECT id, code, status, ap_ref FROM categorie_traduction WHERE id_user='.$_SESSION['id'];
        $nom_table="categorie_traduction";
		$_SESSION['formulaire']=3;
    }else if($_SESSION['type']==2){
        $requete2='SELECT id, code, status, ap_ref FROM ressources_traduction WHERE id_user='.$_SESSION['id'].' AND category='. $_SESSION['ressource'];
        $nom_table="ressources_traduction";
		$_SESSION['formulaire']=4;
    }
	$resultat = mysql_query($requete2);
	$nb_array=array();
	$list=array();
	$list2=array();
    $count=0;
    while ($codes = mysql_fetch_assoc($resultat)){
       $count=$count+1;
        $nb_array["code".$count]=$codes["code"];
		if($codes["status"]==1&&$codes["ap_ref"]==1){
			$list[]=$codes['code'];
		}else if($codes["status"]==2){
			$list2[]=$codes['code'];
		}
    }
   /* if($count==0){
		echo page_traducteur("message2");
	}else{*/
		$code = array_unique($nb_array);
		$valides=array_unique($list);
		$attend=array_unique($list2);
		foreach ($code as $value){
			$valid=0;
			foreach ($valides as $val){
				if($val==$value){
					$valid=1;
				}
			}
			foreach ($attend as $val2){
				if($val2==$value){
					$valid=2;
				}
			}
			if($_SESSION['type']==2) {
				duexieme_structure($value, $nom_table, 0);
			}else{
				duexieme_structure($value, $nom_table, $valid);
			}
		/*}*/
	}
}else if($categorie==16){
	$langues='SELECT code, status, ap_ref FROM soustitres WHERE id_resource='.$_SESSION['id_res'].' AND id_user='.$_SESSION['id'];
	$recup=mysql_query($langues);
	$nom_table="soustitres";
	$_SESSION['formulaire']=5;
	$soustitre=0;
	while($data=mysql_fetch_assoc($recup)){
		if($data['status']==1&&$data['ap_ref']==1){
			duexieme_structure($data['code'], $nom_table, 1);
		}else if($data['status']==2){
			duexieme_structure($data['code'], $nom_table, 2);
		}else{
			duexieme_structure($data['code'], $nom_table, 0);
		}
		$soustitre=$soustitre+1;
	}
	/*if($soustitre==0) {
		echo page_traducteur("message2");
	}*/

}else if($categorie==17){
	$requete2='SELECT * FROM traducteur WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="traducteur";
	$_SESSION['formulaire']=2;
	premier_structure($codes, $nom_table);
}else if($categorie==18){
    $requete2='SELECT * FROM general WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);
    $nom_table="general";
    $_SESSION['formulaire']=2;
    premier_structure($codes, $nom_table);
}else{
    echo "error";
}


function premier_structure($codes, $nom_table)
{
	while ($code = mysql_fetch_assoc($codes)) {
		echo '<table border="0" cellspacing="0">';
		echo '<tr>';
		echo '<td>';
		echo '<table border="0" cellspacing="0">';
		echo '<tr>';
		echo '<td align="center">';
		echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="' . couleur(1) . '" width="300" height="60">';
		echo '<tr>';
		$requete = 'SELECT nom, code FROM langues';
		$recuplg = mysql_query($requete);
		while ($choixlg2 = mysql_fetch_assoc($recuplg)) {
			if ($choixlg2['code'] == $code['code']) {
				echo '<td align="center"><span class="texte_info12">' . $choixlg2['nom'] . '</span></td>';
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
		echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="' . couleur(1) . '" width="300" height="60">';
		echo '<tr>';
		echo '<form name="Formlg" action="traducteur_page_traduire.php" method="post">';
		echo '<input type="hidden" value="' . $code['code'] . '" name="code_lg">';
		echo '<input type="hidden" value="' . $nom_table . '" name="table">';
		echo '<input type="hidden" value="' . $code['id'] . '" name="code_id">';
		if($code['status']==1 && $code['ap_ref']==1) {
			echo '<td align="center"><span class="texte_info12">'.page_traducteur("message5").'</span></td>';//Cambiar
		}else if($code['status']==2){
			echo '<td align="center"><span class="texte_info12">'.page_traducteur("message6").'</span></td>';//Cambiar
		}else{
			echo '<td align="center"><span class="texte_info12"><input type="submit" value="'.afficher_ressource("option1").'" name="submitButtonName"></span></td>';//Cambiar
		}
		echo '</form>';
		echo '</tr>';
		echo '</table>';
		echo '</td>';
		echo '</tr>';
		echo '</table>';
		echo '</td>';
		echo '</table>';

	}

	/*if($count==0) {
		echo page_traducteur("message2");
	}*/
}

function duexieme_structure($code, $nom_table, $valid){
	echo '<table border="0" cellspacing="0">';
	echo '<tr>';
	echo '<td>';
	echo '<table border="0" cellspacing="0">';
	echo '<tr>';
	echo '<td align="center">';
	echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="300" height="60">';
	echo '<tr>';
	$requete='SELECT id, nom, code FROM langues';
	$recuplg = mysql_query($requete);
	while ($choixlg2 = mysql_fetch_assoc($recuplg))
	{
		if($choixlg2['code']==$code){
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
	echo '<input type="hidden" value="'.$code.'" name="code_lg">';
	echo '<input type="hidden" value="'.$nom_table.'" name="table">';
	if($valid==1){
		echo '<td align="center"><span class="texte_info12">'.page_traducteur("message5").'</span></td>';//Cambiar
	}else if($valid==2){
		echo '<td align="center"><span class="texte_info12">'.page_traducteur("message6").'</span></td>';//Cambiar
	}else{
		echo '<td align="center"><span class="texte_info12"><input type="submit" value="'.afficher_ressource("option1").'" name="submitButtonName"></span></td>';//Cambiar
	}
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
				echo '<span class="Texte_menu">'.page_traducteur("title5").'</span>';// Cambiar
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
			echo '<td colspan="2" bgcolor="'.couleur(1).'">';//couleur fonc�e
				echo '<center>';
					echo '<span class="texte_menu"><input type="submit" value="'.choix_langue().'" name="submitButtonName"></span></center>'; // Choisir cette langue
			echo '</td>';
		echo '</tr>';
	echo '</table>';
	echo '</p>';
	echo '</form>';


}

?>
