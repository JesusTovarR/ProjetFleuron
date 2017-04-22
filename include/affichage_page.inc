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

//Fonction pour récupérer le contenu de la page d'accueil (index.php)
function affichage_accueil()
{

    global $lg; // récupération variables de connexion


    $requete2 = 'SELECT * FROM accueil_contenu WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete2);
    while ($data = mysql_fetch_assoc($recup))
    {
        // récupération variable langue
        if($data["status"]==1){
            echo $data["content"];
        }else if($data["status"]==2){
            echo "texte en revision";
        }

    }
}

//Fonction pour récupérer le contenu de la partie central de conseils.php
function affichage_conseils()
{

    global $lg; // récupération de la variable de la langage

    $requete2 = 'SELECT * FROM conseils_contenu WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete2);
    while ($data = mysql_fetch_assoc($recup))
    {
        //vérification du statut du contenu
        if($data["status"]==1){
            echo $data["content"];
        }else if($data["status"]==2){
            echo "texte en revision";
        }

    }
}
//Fonction pour récupérer le contenu de la partie central de contact.php
function affichage_contact()
{

    global $lg; // récupération variables de connexion


    $requete2 = 'SELECT * FROM contact_contenu WHERE code="'.$lg.'" && status=1';
    $recup = mysql_query($requete2);
    while ($data = mysql_fetch_assoc($recup))
    {

        //vérification du statut du contenu
        if($data["status"]==1){
            echo $data["content"];
        }else if($data["status"]==2){
            echo "texte en revision";
        }

    }
}

?>