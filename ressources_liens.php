<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


$idressource=$_GET["idressource"];
$idprofil=$_GET["idprofil"];


//************************************************************************
//			R�cup�ration des liens
//************************************************************************
	$requete = 'SELECT lien FROM ressources WHERE id='.$idressource;
	$recup2 = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup2))
			{
				$liens=$data['lien'];
			}


//**********************************
// Affichage des liens menu d�roulant
//**********************************
function affichage_choixlien()
	{

		global $lg,$pageencours, $liens, $idressource ; // r�cup�ration variable langue

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


					$requete = 'SELECT * FROM liens WHERE liencategories='.$data['id'];
					$recup2 = mysql_query($requete);
						while ($data2 = mysql_fetch_assoc($recup2))
							{
							$dejala=0;
								if ($liens<>"") {
									for ($i = count($eleconsultation)-2; $i >= 0; $i--) {
										if ($eleconsultation[$i]==$data2['id']) {
											$dejala=1;
										}
									}

									if ($dejala==1) {

									} else {
											echo '<option value="'.$data2['id'].'">->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data2['nom'];
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

		global $lg,$pageencours, $liens, $idressource; // r�cup�ration variable langue

		if ($liens<>"") {

echo '<table>';

			$eleconsultation = explode(";",$liens);


				for ($i = count($eleconsultation)-1; $i >= 0; $i--) {
					if ($eleconsultation[$i]<>"") {
					$requete = 'SELECT * FROM liens WHERE id='.$eleconsultation[$i];

					$recup2 = mysql_query($requete);
					while ($data2 = mysql_fetch_assoc($recup2))
						{
							echo '<tr>';
								echo '<td>';

										echo '<table border="0" cellpadding="6" cellspacing="2" bgcolor="'.couleur(1).'">';
											echo '<tr>';
												echo '<td colspan="2"><a href="'.$data2['lien'].'" target="_blank"><span class="texte_info12">'.$data2['nom'].'</span></a></td>';
											echo '</tr>';
										echo '</table><br>';
								echo '</td>';
							if ($_SESSION['niveau']>=50) {
								echo '<td>';

										echo '<table border="0" cellpadding="6" cellspacing="2" bgcolor="'.couleur(1).'">';
											echo '<tr>';
												echo '<td colspan="2"><a href="ressources_retirer_lien.php?idressource='.$idressource.'&liens='.$liens.'&lien='.$data2['id'].'"><span class="texte_info12">'.versionlinguistique(139).'</span></a></td>';
											echo '</tr>';
										echo '</table><br>';
								echo '</td>';	
							}
							echo '<tr>';


						}
					}
					}


				}
echo '</table>';


	}


?>
<html>
	<head>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>
	<body>



<?php if ($_SESSION['niveau']>=50) { ?>
		<form name="FormName" action="ressources_ajout_lien.php" method="post">
<p><?php echo versionlinguistique(140) //Connecter un lien ?> :</p>
			<?php affichage_choixlien() ?>
			<button id="buton1"  type="submit" class="stbuttonImp" ><?php echo versionlinguistique(51) //Ajouter ?></button>


		<input type="hidden" value="<?php echo $idressource; ?>" name="idressource">
		<input type="hidden" value="<?php echo $lg; ?>" name="lg">
		<input type="hidden" value="<?php echo $id; ?>" name="id">
		<input type="hidden" value="<?php echo $liens; ?>" name="liens">
		</form><br><br>
<?php } ?>
<br><p><?php echo versionlinguistique(141) //Connecter un lien ?> :</p><br>
<?php affichage_lien() ?>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>