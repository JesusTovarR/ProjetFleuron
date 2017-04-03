<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

if (! isset($_SESSION['niveau'])) {
	$_SESSION['niveau']=0;
}

$categorie=$_GET["categorie"];

if (isset($_GET["refpage"])) {
	$refpage=$_GET["refpage"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
} else {
	$refpage=1;
}

if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}
if (isset($_GET["action2"])) {
	$action2=$_GET["action2"]; // Variable permettant l'affichage de message suite � l'action d'�dition de la page
}


//************************************************************************
//		Nombre de ressources associ�es � la cat�gorie - comptage du nombre de pages
//************************************************************************
$requete = 'SELECT COUNT(id) AS total FROM ressources WHERE categorie='.$categorie;
$recup = mysql_query($requete);
$data = mysql_fetch_assoc($recup);
$nbressources = $data['total']; 
$nbpage = ceil($nbressources/5);
if ($refpage==0) 
	{ 
		$refpage=1;
	}

$ressourcepagedeb=-4;
$ressourcepagefin=0;


//************************************************************************
//		Affichage des bouton pages
//************************************************************************
function affichage_boutonpages()
	{

	global $refpage,$nbpage,$categorie,$lg,$ressourcepagedeb,$ressourcepagefin,$idprofil;

	echo '<table><tr>';
		for ($i = 1; $i <= $nbpage; $i++) {
					$ressourcepagedeb=$ressourcepagedeb+5;
					$ressourcepagefin=$ressourcepagefin+5;
			echo '<td width="20">';
				if ($i==$refpage) {
					echo '<table border="0" cellpadding="4" cellspacing="2" width="30">'; // couleur fonc�e
						echo '<td align="center"><span class="texte_default">'.$i.'</span></td>';
					echo '</table>';
				} else {

					echo '<table border="0" cellpadding="4" cellspacing="2" bgcolor="'.couleur(1).'" width="30">'; // couleur fonc�e
						echo '<td align="center"><a href="?lg='.$lg.'&categorie='.$categorie.'&refpage='.$i.'"><span class="texte_info12">'.$i.'</span></a></td>';
					echo '</table>';
				}

			echo '</td>';

		}
	echo '</tr></table>';


	}


//**********************************
// Affichage des ressources de la cat�gorie retenue
//**********************************
function affichage_ressourcelist()
	{


		global $lg,$categorie,$pageencours,$page,$refpage,$idprofil; 

		$debpage=($refpage*5)-4;
		$compteur=0;
			echo '<table border="0" cellspacing="5" >';

			$requete = 'SELECT * FROM ressources WHERE categorie='.$categorie.' ORDER BY id DESC';
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
				{
					$compteur = $compteur + 1;
					if ($compteur>=$debpage && $compteur<=$debpage+4) {
						affichage_ressource($data['id']);
					}
				}

			echo '</table>';


}


include('include/recuperation_nom_categorie.inc'); // Routines d'affichage du nom de la cat�gorie retenue

include('include/affichage_ressource.inc'); // affichage des ressources dans une liste
?>

<html>

	<head>

		<?php include('include/head.inc');  // header ?>
		<?php include('include/alexandria.inc');  // dictionnaire alexandria ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>

	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="white">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
			<tr height="67">
				<td align="center" valign="middle" bgcolor="<?php echo couleur(2); // couleur claire ?>" height="67">
					<!-- Module affichage du bandeau contenant le logo FLEURON -->
					<?php include('include/logo_fleuron.inc');  ?>
				</td>
			</tr>
			<tr height="40">
				<td bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" height="40" align="center">
					<?php 
						// Menu Sup�rieur 
						include('include/menu_top.inc'); 

					?>
				</td>
			</tr>
			<tr>

				<td bgcolor="#f6f5ed" align="center" valign="top">
					<table border="0" cellpadding="10" cellspacing="2" width="900">
						<tr>
<!-- Partie centrale -->
							<td valign="top">
								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
									<tr>
										<td width="100"  bgcolor="<?php echo couleur(1) ?>">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="100">
												<tr>
													<td align="center">
														<a href="ressources.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center" bgcolor="<?php echo couleur(2); //couleur claire ?>">
											<span class="titre"><?php echo recuperation_categorie($categorie); //Ressources multimedia ?></span>
										</td>
										<!-- <td width="100">
											 &nbsp;
											</td> -->

									</tr>
								</table>


<?php if (isset($_GET["action"])) { ?>
<p><div align="center"><span class="message"><?php echo versionlinguistique(70); // Ressource modifi�e ?></span></div>
<?php } ?>
<?php if (isset($_GET["action2"])) { ?>
<p><div align="center"><span class="message"><?php echo versionlinguistique(73); // Ressource supprim�e ?></span></div>
<?php } ?>

<br>
<div align="right">
<?php if ($_SESSION['niveau']>=50) { // Affichage Bouton �dition page ?>
											<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur fonc�e ?>" width="220">
												<tr>
													<td align="center"><a href="ressource_ajouter.php?lg=<?php echo $lg ?>&page=<?php echo $pageencours ?>&categorie=<?php echo $categorie ?>"><span class="texte_info12"><?php echo versionlinguistique(42)// Ajouter une ressource ?></span></a></td>
												</tr>
											</table>
<?php } ?>
</div>

				<p>
<!-- ***********************  Affichage boutons pages ********************************** -->
					<div align="center"><center>
						<?php affichage_boutonpages() ?>
					</center></div>
<!-- ***********************  Affichage liste des ressources par page ****************** -->
<!-- 											 -->
					<?php affichage_ressourcelist() ?>
<!-- 											 -->
<!-- ************************************************************************************ -->
<!-- ***********************  Affichage boutons pages ********************************** -->
					<div align="center"><center>
						<?php affichage_boutonpages() ?>
					</center></div>
				</p>

								<table width="100%" border="0" cellpadding="0" cellspacing="0" >
									<tr>
										<td width="100"  bgcolor="<?php echo couleur(1) ?>">
											<table border="0"  bgcolor="<?php echo couleur(1) ?>" cellpadding="5" cellspacing="0" width="100">
												<tr>
													<td align="center">
														<a href="ressources.php?lg=<?php echo $lg ?>"><span class="texte_menu"><?php echo versionlinguistique(26) //Retour ?></span></a>
													</td>
												</tr>
											</table>
										</td>
										<td align="center" bgcolor="<?php echo couleur(2); //couleur claire ?>">
											<span class="titre"><?php echo recuperation_categorie($categorie); //Ressources multimedia ?></span>
										</td>
										<!-- <td width="100">
											 &nbsp;
											</td> -->

									</tr>
								</table>

							</td>
<!-- Fin partie centrale -->
<!-- Colonne de droite -->
							<td width="250" align="right" valign="top">
								<table border="0" cellpadding="5" cellspacing="2">
	<?php if ($_SESSION['niveau']<1) { ?>
									<tr>
										<td align="right">
<!-- Module d'affichage des choix des langues disponibles - table LG -->
<?php include('include/choix_langue.inc');  ?>
											</td>
									</tr>
				<?php } ?>
	<?php if ($_SESSION['niveau']<1) { ?>
									<tr>
										<td align="right">
<!-- Module d'affichage du formulaire de connexion -->
<?php include('include/login.inc');  ?>
											</td>
									</tr>
				<?php } ?>
									<tr>
										<td align="right">
<!-- Module d'affichage du formulaire de recherche  -->
<?php include('include/moteurderecherche.inc');  ?>
											</td>
									</tr>
									<tr>
										<td align="right">
<!-- Module d'affichage du dernier media publi�  -->
<?php include('include/derniermedia.inc');  ?>
										</td>
									</tr>
									<tr>
										<td align="center">
<!-- Module d'affichage menu utilisateur  -->
<?php include('include/menu_FavorisNotesComm.inc');  ?>		
										</td>
									</tr>
									<tr>
										<td align="center">
<!-- Module d'affichage menu Admin  -->
<?php include('include/menu_admin.inc');  ?>		
										</td>
									</tr>
								</table>
							</td>
<!-- Fin colonne de droite -->
						</tr>
					</table>
				</td>
			</tr>
			<tr height="40">
				<td bgcolor="<?php echo couleur(2); // couleur clair ?>" height="40" align="center">
					<!-- Module d'affichage du bandeau de bas de page  -->
					<?php include('include/bandeau_basdepage.inc');  ?>
				</td>
			</tr>
			<tr height="150">
				<td height="150" align="center">
					<!-- Module d'affichage du dernier media publi�  -->
					<?php include('include/logo_basdepage.inc');  ?>
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
	</body>

</html>
<?php include('include/close_connectionBase.inc');  ?>