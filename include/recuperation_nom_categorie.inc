<?php

//**********************************
// récupération du nom de la catégorie retenue
//**********************************
function recuperation_categorie($codemot)
	{

	global $lg; // récupération variable langue

	$requete='SELECT '.$lg.' FROM categorie WHERE id='.$codemot;
	$recup = mysql_query($requete);

	if ($data = mysql_fetch_assoc($recup))
		{
			return $data[$lg];
		}

	}

?>