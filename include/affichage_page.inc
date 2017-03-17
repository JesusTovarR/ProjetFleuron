<?php

function affichage_page($ref)
	{

		global $lg; // récupération variables de connexion


			$requete2 = 'SELECT '.$lg.' FROM page WHERE nompage="'.$ref.'"';
			$recup = mysql_query($requete2);
				while ($data = mysql_fetch_assoc($recup))
					{

						echo $data[$lg];

					}
	}

function affichage_accueil()
{

    global $lg; // récupération variables de connexion


    $requete2 = 'SELECT content FROM accueil_contenu WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete2);
    while ($data = mysql_fetch_assoc($recup))
    {

        echo $data["content"];

    }
}

function affichage_conseils()
{

    global $lg; // récupération variables de connexion


    $requete2 = 'SELECT content FROM conseils_contenu WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete2);
    while ($data = mysql_fetch_assoc($recup))
    {

        echo $data["content"];

    }
}

function affichage_contact()
{

    global $lg; // récupération variables de connexion


    $requete2 = 'SELECT content FROM contact WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete2);
    while ($data = mysql_fetch_assoc($recup))
    {

        echo $data["content"];

    }
}

?>