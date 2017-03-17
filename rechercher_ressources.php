<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$motcle=$_GET["motcle"];
$motcleorigine=$motcle;

//$motcle="lettre";
if (substr($motcle,-1)<>" ") {
$motcle=$motcle." ";
}
$compteur=0;

//************************************************************************
//		Affichage des commentaires
//************************************************************************
function affichage_recherchelist($motcle)
	{
	global $lg,$compteur,$motcleorigine;
	$requete = 'SELECT * FROM ressources';
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				$zone = $data['nom_'.$lg].$data['nom_fr'].$data['description_'.$lg].$data['description_fr'];
				if (strpos($data['Transcription'],$motcle)>0)
					{


					$fichier = 'ressources/'.$data['id'].'.srt'; // fichier
					if (file_exists($fichier))
						{

						$lignes = file($fichier);
						$lignes=str_replace("Ã´","ô",$lignes);
						$lignes=str_replace("Ã©","é",$lignes);
						$lignes=str_replace("Ã","à",$lignes);
						$lignes=str_replace("à¨","è",$lignes);
						$lignes=str_replace("àª","ê",$lignes);
						$lignes=str_replace("à§","ç",$lignes);
						$lignes=str_replace("à»","û",$lignes);
						$lignes=str_replace("à¢","â",$lignes);
						$lignes=str_replace(chr(13),"",$lignes);
						$lignes=str_replace(chr(10),"",$lignes);
						$lignes=str_replace("  "," ",$lignes);
						$lignes=str_replace("à ","à",$lignes);
						$lignes=str_replace("à¹","ù",$lignes);
						$lignes=str_replace("ù ","ù",$lignes);

						foreach($lignes as $ligne_num => $ligne)
							{
								$zone = $zone.$ligne

								$position = strpos($zone,$motcle);
								if ($position>0) 
									{
										affichage_ressource($data['id']);
									}

							}



						}




				}

			}
	}


?>
<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<?php include('include/alexandria.inc');  ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>

	<body topmargin="4" leftmargin="4" marginheight="4" marginwidth="4">
		<center>
                <style type="text/css"> 
table {
 border-collapse:collapse;
 border-style:solid; 
 border-color:black;

 }
td { 
 border-width:1px;
 border-style:solid; 
 border-color:black;

 }
.grise {
 border:1px solid black; 
 background-color:#dbdbdb;
 padding:5;
 }
.blue {
 border:1px solid blue; 
 }
.none {
 border-style:none;

 }
		</style>

		<table border="1" width="880">
			<?php affichage_recherchelist($motcle) ?>
		</table>
				<?php 
					if ($compteur==0) {
						echo'<br><br><br>';
						echo '<tr><td><span class="texte_defaultGras">Aucun résultat trouvé</span>';
					}
				?>
		</center>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>