<?php

function couleur($codecouleur)
{


	global $bdd; // r�cup�ration variables de connexion � la base et langue


	$query='SELECT couleur FROM couleur WHERE id='.$codecouleur;
	$recup = mysql_query($query);

	if ($data = mysql_fetch_assoc($recup))
		{
			return $data['couleur'];
		}
}

?>