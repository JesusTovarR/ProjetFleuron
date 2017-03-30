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

function affichage_menu($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM menu WHERE code="'.$lg.'"';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function choix_langue()
{


    global $lg; // récupération variable langue

    $requete='SELECT content, status FROM choix_langue WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data["content"];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function login($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM login WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function moteur($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM moteur_de_recherche WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function dernier_media()
{


    global $lg; // récupération variable langue

    $requete='SELECT title, status FROM dernier_media WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data["title"];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function afficher_ressource($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM affichage_ressource WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function tableau_du_bord($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM tableau_du_bord WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function menu_administrateur($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM menu_admin WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function content($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM content WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function conseils($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM conseils WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}

function page_modification($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.', status FROM page_edit WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);
    while ($data = mysql_fetch_assoc($recup))
    {
        if($data['status']==1){
            return $data[$val];
        }else if($data['status']==2){
            return "texte en revision";
        }

    }
}


?>