<hr/>
<span class="texte_default"><?php echo versionlinguistique(36); //Choisir une cat�gorie ?></span>
<br>
<?php

$categorie=$_GET['categorie'];
if(isset($_GET['type'])){
    $_SESSION['type']=$_GET['type'];// Variable permettant d'identifier la table dans la base de données
}

if(isset($_GET['id_res'])){
	$_SESSION['id_res']=$_GET['id_res'];// Variable permettant d'identifier le id d'un ressource
}


if(isset($_GET['cat_ressources'])){
    $_SESSION['ressource']=$_GET['cat_ressources'];// Variable permettant d'identifier la category d'un ressource
}



if($categorie==1){
    $requete2='SELECT * FROM accueil_contenu WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
    $nom_table="accueil_contenu";//nom de la table dans la base de données
	$_SESSION['formulaire']=1;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==2){
    $requete2='SELECT * FROM conseils_contenu WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
    $nom_table="conseils_contenu";//nom de la table dans la base de données
	$_SESSION['formulaire']=1;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==3){
    $requete2='SELECT * FROM contact_contenu WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
    $nom_table="contact_contenu";//nom de la table dans la base de données
	$_SESSION['formulaire']=1;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==4){
	$requete2='SELECT * FROM menu WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="menu";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==5){
	$requete2='SELECT * FROM choix_langue WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête
	$nom_table="choix_langue";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==6){
	$requete2='SELECT * FROM conseils WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="conseils";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==7){
	$requete2='SELECT * FROM dernier_media WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="dernier_media";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==8){
	$requete2='SELECT * FROM login WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="login";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==9){
	$requete2='SELECT * FROM menu_admin WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="menu_admin";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==10){
	$requete2='SELECT * FROM moteur_de_recherche WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="moteur_de_recherche";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==11){
	$requete2='SELECT * FROM tableau_du_bord WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="tableau_du_bord";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==12){
	$requete2='SELECT * FROM affichage_ressource WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="affichage_ressource";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==13){
	$requete2='SELECT * FROM content WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="content";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==14){
	$requete2='SELECT * FROM page_edit WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nom_table="page_edit";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==15){
    if($_SESSION['type']==1){
        $requete2='SELECT id, code, status, ap_ref FROM categorie_traduction WHERE id_user='.$_SESSION['id'];
        $nom_table="categorie_traduction";//nom de la table dans la base de données
		$_SESSION['formulaire']=3;//Type du formulaire pour la traduction
    }else if($_SESSION['type']==2){
        $requete2='SELECT id, code, status, ap_ref FROM ressources_traduction WHERE id_user='.$_SESSION['id'].' AND category='. $_SESSION['ressource'];
        $nom_table="ressources_traduction";//nom de la table dans la base de données
		$_SESSION['formulaire']=4;//Type du formulaire pour la traduction
    }
	$resultat = mysql_query($requete2);//contenu de la requête avec les traductions faites par les utilisateurs
	$nb_array=array();
	$list=array();
	$list2=array();
    $count=0;
    while ($codes = mysql_fetch_assoc($resultat)){
       $count=$count+1;
        $nb_array["code".$count]=$codes["code"];// code des traductions
		if($codes["status"]==1&&$codes["ap_ref"]==1){
			$list[]=$codes['code'];//code des traductions validées
		}else if($codes["status"]==2){
			$list2[]=$codes['code'];//code des traductions en cours de validation
		}
    }
   /* if($count==0){
		echo page_traducteur("message2");
	}else{*/
		$code = array_unique($nb_array);//on enlève les codes repetes
		$valides=array_unique($list);//on enlève les codes repetes
		$attend=array_unique($list2);//on enlève les codes repetes
		foreach ($code as $value){
			$valid=0;
			foreach ($valides as $val){
				if($val==$value){
					$valid=1;//Traduction validé
				}
			}
			foreach ($attend as $val2){
				if($val2==$value){
					$valid=2;//Traduction en cours de validation
				}
			}
			if($_SESSION['type']==2) {
				duexieme_structure($value, $nom_table, 0);//$value->code , $nom_table->nom de la table, 0-> brouillon
			}else{
				duexieme_structure($value, $nom_table, $valid);//$value->code , $nom_table->nom de la table, 0-> traduction valid ou en cours de validation
			}
		/*}*/
	}
}else if($categorie==16){
	$langues='SELECT code, status, ap_ref FROM soustitres WHERE id_resource='.$_SESSION['id_res'].' AND id_user='.$_SESSION['id'];
	$recup=mysql_query($langues);
	$nom_table="soustitres";//nom de la table dans la base de données
	$_SESSION['formulaire']=5;//Type du formulaire pour la traduction
	$soustitre=0;
	while($data=mysql_fetch_assoc($recup)){
		if($data['status']==1&&$data['ap_ref']==1){
			duexieme_structure($data['code'], $nom_table, 1);//code, nom de la table, traduction valide
		}else if($data['status']==2){
			duexieme_structure($data['code'], $nom_table, 2);//code, nom de la table, traduction en cours de validation
		}else{
			duexieme_structure($data['code'], $nom_table, 0);//code, nom de la table, brouillon
		}
		$soustitre=$soustitre+1;
	}
	/*if($soustitre==0) {
		echo page_traducteur("message2");
	}*/

}else if($categorie==17){
	$requete2='SELECT * FROM traducteur WHERE id_user='.$_SESSION['id'];
	$codes = mysql_query($requete2);
	$nom_table="traducteur";//nom de la table dans la base de données
	$_SESSION['formulaire']=2;//Type du formulaire pour la traduction
	premier_structure($codes, $nom_table);
}else if($categorie==18){
    $requete2='SELECT * FROM general WHERE id_user='.$_SESSION['id'];
    $codes = mysql_query($requete2);
    $nom_table="general";//nom de la table dans la base de données
    $_SESSION['formulaire']=2;//Type du formulaire pour la traduction
    premier_structure($codes, $nom_table);
}else{
    echo "error";
}

//Fonction pour afficher les traductions faites pour les tables avec la premiere structute->une ligne par table
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
		//requête pour récupérer tous les codes et les nom de langues disponibles
		$requete = 'SELECT nom, code FROM langues';
		$recuplg = mysql_query($requete);
		while ($choixlg2 = mysql_fetch_assoc($recuplg)) {
			//validation de trouver des codes similaires
			if ($choixlg2['code'] == $code['code']) {
				echo '<td align="center"><span class="texte_info12">' . $choixlg2['nom'] . '</span></td>';//nom de la langue
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
		echo '<input type="hidden" value="' . $code['code'] . '" name="code_lg">';//code de la traduction
		echo '<input type="hidden" value="' . $nom_table . '" name="table">';//nom de la table où la traduction appartient
		echo '<input type="hidden" value="' . $code['id'] . '" name="code_id">';//identifiant du code dans la table
		if($code['status']==1 && $code['ap_ref']==1) {
			echo '<td align="center"><span class="texte_info12">'.page_traducteur("message5").'</span></td>';//Message:Traduction valide
		}else if($code['status']==2){
			echo '<td align="center"><span class="texte_info12">'.page_traducteur("message6").'</span></td>';//Message:Text en validation
		}else{
			echo '<td align="center"><span class="texte_info12"><input type="submit" value="'.afficher_ressource("option1").'" name="submitButtonName"></span></td>';//Editer
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

//Fonction pour afficher les traductions faites pour les tables avec la premiere structute->plusiers lignes par table
function duexieme_structure($code, $nom_table, $valid){
	echo '<table border="0" cellspacing="0">';
	echo '<tr>';
	echo '<td>';
	echo '<table border="0" cellspacing="0">';
	echo '<tr>';
	echo '<td align="center">';
	echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="300" height="60">';
	echo '<tr>';
	//requête pour récupérer tous les codes et les nom de langues disponibles
	$requete='SELECT id, nom, code FROM langues';
	$recuplg = mysql_query($requete);
	while ($choixlg2 = mysql_fetch_assoc($recuplg))
	{
		//validation de trouver des codes similaires
		if($choixlg2['code']==$code){
			echo '<td align="center"><span class="texte_info12">'.$choixlg2['nom'].'</span></td>';//nom de la langue
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
	echo '<input type="hidden" value="'.$code.'" name="code_lg">';//code de la langue
	echo '<input type="hidden" value="'.$nom_table.'" name="table">';//nom de la table où la traduction appartient
	if($valid==1){
		echo '<td align="center"><span class="texte_info12">'.page_traducteur("message5").'</span></td>';//Message:Traduction valide
	}else if($valid==2){
		echo '<td align="center"><span class="texte_info12">'.page_traducteur("message6").'</span></td>';;//Message:Text en validation
	}else{
		echo '<td align="center"><span class="texte_info12"><input type="submit" value="'.afficher_ressource("option1").'" name="submitButtonName"></span></td>';//Editer
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

//Formulaire pour creer une nouvelle traduction
function ajouter_langue(){

echo '<form action="traducteur_insert.php?categorie='.$_GET['categorie'].'" method="post">';

	echo '<p>';
	echo '<table border="0" cellpadding="7" cellspacing="2" bgcolor="'.couleur(2).'" width="220">';// couleur claire
		echo '<tr>';
			echo '<td colspan="2" align="center">';
				echo '<span class="Texte_menu">'.page_traducteur("title5").'</span>';//Ajouter une nouvelle langue
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
			echo '<td colspan="2" align="center">';
				echo '<center>';
					echo '<select name="lg" size="1">';
						//requête pour récupérer tous les codes et les nom de langues disponibles
						//pour les afficher dans la liste du select
						$requete='SELECT * FROM langues WHERE status=0 ORDER BY nom';
						$recuplg = mysql_query($requete);
						while ($choixlg = mysql_fetch_assoc($recuplg))
						{
							echo '<option value="'.$choixlg['code'].'">'.$choixlg['nom'];//Nom de la langue dans le formulaire
						}


	echo '</select></center>';
			echo '</td>';
		echo '</tr>';
		echo '<tr>';
	echo '<input type="hidden"  value="'.$choixlg['code'].'" name="code">';//code de la langue à envoyer par post
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
