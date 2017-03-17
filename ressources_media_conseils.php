<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$idressource=$_GET["idressource"];
//$idprofil=$_GET["idprofil"];


//************************************************************************
//			Récupération page conseils
//************************************************************************
	$requete = 'SELECT * FROM conseils_page WHERE ressource='.$idressource;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				$idconseil=$data['id'];
				$page=$data['page'];

			}


//************************************************************************
//			Récupération des liens
//************************************************************************
	$requete = 'SELECT lien FROM ressources WHERE id='.$idressource;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				$liens=$data['lien'];
			}
if (! isset($page)) {
	$page="";
}

//**********************************
// Affichage des liens menu déroulant
//**********************************
function affichage_choixlien()
	{

		global $lg,$pageencours, $liens; // récupération variable langue

					if ($liens<>"") {
						$eleconsultation = explode(";",$liens);

					}

$deja=0;

					echo '<select name="lien" size="1">';
		$requete = 'SELECT * FROM liencategories ORDER BY refVL';
		$recup = mysql_query($requete);
			while ($data = mysql_fetch_assoc($recup))
				{
						echo '<option value="0">---------------------------';
						echo '<option value="0">'.$data['nom'].' : ';


					$requete = 'SELECT * FROM liens WHERE liencategories='.$data['id'].' AND aff=1';
					$recup2 = mysql_query($requete);
						while ($data2 = mysql_fetch_assoc($recup2))
							{

								if ($liens<>"") {
									for ($i = count($eleconsultation)-2; $i >= 0; $i--) {
										if ($eleconsultation[$i]==$data2['id']) {
											$deja=1;
										} else {
										echo '<option value="'.$data2['id'].'">->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data2['nom'];
										}

									}
								} else {
									echo '<option value="'.$data2['id'].'">->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data2['nom'];
								}
							}


				}
					echo '</select>';
	}



//**********************************
// Affichage des liens
//**********************************
function affichage_lien()
	{

		global $lg,$pageencours, $liens; // récupération variable langue

					if ($liens<>"") {
						$eleconsultation = explode(";",$liens);

					}

$deja=0;

					echo '<select name="lien" size="1">';
		$requete = 'SELECT * FROM liencategories ORDER BY refVL';
		$recup = mysql_query($requete);
			while ($data = mysql_fetch_assoc($recup))
				{
						echo '<option value="0">---------------------------';
						echo '<option value="0">'.$data['nom'].' : ';


					$requete = 'SELECT * FROM liens WHERE liencategories='.$data['id'].' AND aff=1';
					$recup2 = mysql_query($requete);
						while ($data2 = mysql_fetch_assoc($recup2))
							{

								if ($liens<>"") {
									for ($i = count($eleconsultation)-2; $i >= 0; $i--) {
										if ($eleconsultation[$i]==$data2['id']) {
											$deja=1;
										} else {
										echo '<option value="'.$data2['id'].'">->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data2['nom'];
										}

									}
								} else {
									echo '<option value="'.$data2['id'].'">->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data2['nom'];
								}
							}


				}
					echo '</select>';
	}


?>
<html>
	<head>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>
	<body>
			<div align="right">
				<?php if ($_SESSION['niveau']>1) { // Affichage Bouton édition page ?>
				<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
					<tr>
						<td align="center"><a href="ressources_media_conseils_edit.php?lg=<?php echo $lg ?>&idressource=<?php echo $idressource ?>&idconseil=<?php echo $idconseil ?>&page=<?php echo $pageencours ?>"><span class="texte_info12"><?php echo versionlinguistique(47) //Editer ?></span></a></td>
					</tr>
				</table>
				<?php } ?>
			</div>

				<?php echo $page ?>



<br>

	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>