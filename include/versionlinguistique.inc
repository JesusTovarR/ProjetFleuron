<?php

function versionlinguistique($codemot)
{


	global $lg; // récupération variable langue

	$requete='SELECT '.$lg.' FROM versionlinguistique WHERE id='.$codemot;
	$recup = mysql_query($requete);

	if ($data = mysql_fetch_assoc($recup))
		{
			return $data[$lg];
		}
}

//Fonction pour récupérer le text du menu

function affichage_menu($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM menu WHERE code="'.$lg.'"';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu du formulaire pour ajouter une langue

function choix_langue()
{

    global $lg; // récupération variable langue

    $requete='SELECT content, status FROM choix_langue WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data["content"];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu du login

function login($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM login WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu de la partie moteur de recherche

function moteur($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM moteur_de_recherche WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu de la partie dernier media

function dernier_media()
{


    global $lg; // récupération variable langue

    $requete='SELECT title, status FROM dernier_media WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data["title"];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu des boutons pour les brouillons

function afficher_ressource($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM affichage_ressource WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu des boutons pour l'administrateur

function tableau_du_bord($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM tableau_du_bord WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu du menu administrateur

function menu_administrateur($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM menu_admin WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer contenu en général du site

function content($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM content WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu de conseils.php

function conseils($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM conseils WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer contenu en général du site

function page_modification($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM page_edit WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);
    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu du moodule traducteur

function page_traducteur($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM traducteur WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);
    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

//Fonction pour récupérer contenu en général du site

function general($val)//$val contient le nom de la colonne dans la table
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM general WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);
    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}


?>