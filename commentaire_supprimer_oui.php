<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL

include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)



// ***************************************************************
// Suppression du commentaire idcommentaire dans la table COMMENTAIRES
// ***************************************************************

$requete = "DELETE FROM `commentaires` WHERE `id`=".$_GET["idcommentaire"];
mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete


			$requete = 'SELECT * FROM commentaires WHERE reponse='.$_GET["idcommentaire"].' ORDER BY jour DESC';
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
					{
						$requete = "DELETE FROM `commentaires` WHERE `reponse`=".$_GET["idcommentaire"];
						mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete
						$idcom1 = $data['id'];



						$requete = 'SELECT * FROM commentaires WHERE reponse='.$idcom1.' ORDER BY jour DESC';
						$recup = mysql_query($requete);
						while ($data2 = mysql_fetch_assoc($recup))
							{
						$requete = "DELETE FROM `commentaires` WHERE `reponse`=".$idcom1;
						mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete
							$idcom2 = $data2['id'];

							$requete = "DELETE FROM `commentaires` WHERE `reponse`=".$idcom2;
							mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

							}
					}




include('include/close_connectionBase.inc');

// redirection
echo '<script>';
echo 'top.window.location="ressources_media.php?lg='.$lg.'&retour='.$_GET["retour"].'&idressource='.$_GET["idressource"].'&idprofil='.$_GET["idprofil"].'"';
echo '</script>';
?>
