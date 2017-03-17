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

    $requete='SELECT '.$val.' FROM menu WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}

function choix_langue()
{


    global $lg; // récupération variable langue

    $requete='SELECT content FROM choix_langue WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data["content"];

    }
}

function login($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.' FROM login WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}

function moteur($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.' FROM moteur_de_recherche WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}

function dernier_media()
{


    global $lg; // récupération variable langue

    $requete='SELECT title FROM dernier_media WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data["title"];

    }
}

function afficher_ressource($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.' FROM affichage_ressource WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}

function tableau_du_bord($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.' FROM tableau_du_bord WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}

function menu_administrateur($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.' FROM menu_admin WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}

function content($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.' FROM content WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}

function conseils($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.' FROM conseils WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}

function page_modification($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.' FROM page_edit WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}

function categorie($val)
{


    global $lg; // récupération variable langue

    $requete='SELECT '.$val.' FROM categorie_ressources WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete);

    if ($data = mysql_fetch_assoc($recup))
    {
        return $data[$val];

    }
}


?>