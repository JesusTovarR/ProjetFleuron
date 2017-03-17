<?php
//************************************************************************
//			Récupération Infos de la ressource
//************************************************************************
	$requete = 'SELECT * FROM ressources WHERE id='.$idressource;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
//--------------------------------------------------------------------
// ordre de la récupération linguistique : choisi, fr, uk pour nom et description
// si la langgue retenue n'est pas présente, afficher la version française sinon l'anglaise.
//--------------------------------------------------------------------
				$nom=$data['nom_'.$lg];
				if ($nom=="") {
					$nom=$data['nom_fr'];
				}
				if ($nom=="") {
					$nom=$data['nom_uk'];
				}

				$description=$data['description_'.$lg];
				if ($description=="") {
					$description=$data['description_fr'];
				}
				if ($description=="") {
					$description=$data['description_uk'];
				}
				$offline=$data['offline'];
				$categorie=$data['categorie'];
				$typemedia=$data['typemedia'];
				$sourcemedia=$data['sourcemedia'];
				$sourcemedia2=$data['sourcemedia2'];
				$sourcevignette=$data['sourcevignette'];
				$sourcetranscription=$data['sourcetranscription'];
				$visiteur=$data['visiteur'];
				$liens=$data['lien'];
			}
?>