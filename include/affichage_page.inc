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


    $requete2 = 'SELECT * FROM accueil_contenu WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete2);
    while ($data = mysql_fetch_assoc($recup))
    {

        if($data["status"]==1){
            echo $data["content"];
        }else if($data["status"]==2){
            echo "texte en revision";
        }

    }
}

function affichage_conseils()
{

    global $lg; // récupération variables de connexion


    $requete2 = 'SELECT * FROM conseils_contenu WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete2);
    while ($data = mysql_fetch_assoc($recup))
    {

        if($data["status"]==1){
            echo $data["content"];
        }else if($data["status"]==2){
            echo "texte en revision";
        }

    }
}

function affichage_contact()
{

    global $lg; // récupération variables de connexion


    $requete2 = 'SELECT * FROM contact_contenu WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete2);
    while ($data = mysql_fetch_assoc($recup))
    {

        if($data["status"]==1){
            echo $data["content"];
        }else if($data["status"]==2){
            echo "texte en revision";
        }

    }
}

?>