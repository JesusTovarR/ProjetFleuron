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

?>