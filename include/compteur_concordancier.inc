<?php


//************************************************************************
//		Affichage des commentaires
//************************************************************************
function compteur_concordancier($motcle)
	{

	global $compteurcon;
	$requete = 'SELECT * FROM ressources';
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				if (strpos($data['Transcription'],$motcle)>0)
					{


					$fichier = 'ressources/'.$data['id'].'.srt'; // fichier
					if (file_exists($fichier))
						{

						$lignes = file($fichier);
						$lignes=str_replace("ô","�",$lignes);
						$lignes=str_replace("é","�",$lignes);
						$lignes=str_replace("�","�",$lignes);
						$lignes=str_replace("�","�",$lignes);
						$lignes=str_replace("�","�",$lignes);
						$lignes=str_replace("�","�",$lignes);
						$lignes=str_replace("�","�",$lignes);
						$lignes=str_replace("�","�",$lignes);
						$lignes=str_replace(chr(13),"",$lignes);
						$lignes=str_replace(chr(10),"",$lignes);
						$lignes=str_replace("� "," ",$lignes);
						$lignes=str_replace("�","�",$lignes);
						$lignes=str_replace("�","�",$lignes);
						$lignes=str_replace("��","�",$lignes);

						foreach($lignes as $ligne_num => $ligne)
							{

								$position = strpos($ligne,$motcle);
								if ($position>-1) 
									{

									$compteurcon=$compteurcon+1;
echo "toto=".$compteurcon;

									}

							}



						}




				}

			}
	}


?>