<?php

function couleur($codecouleur)
{


	global $bdd; // récupération variables de connexion à la base et langue


	$query='SELECT couleur FROM couleur WHERE id='.$codecouleur;
	$recup = mysql_query($query);

	if ($data = mysql_fetch_assoc($recup))
		{
			return $data['couleur'];
		}
}

?>