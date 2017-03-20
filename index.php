<?php
//*****************************************************************************************
// 	Réalisation par Steven DUDA - 2016 
//	06 63 10 33 21 - steven.duda@wanadoo.fr
//	www.stevenduda.com
//*****************************************************************************************

include('include/open_connectionBase.inc'); // connection à la base MYSQL
include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

if (! isset($_SESSION['niveau'])) {
	$_SESSION['niveau']=0;
}


if (isset($_GET["action"])) {
	$action=$_GET["action"]; // Variable permettant l'affichage de message suite à l'action d'édition de la page
}

//**********************************
// 	Si utilisateur inscrit : comptage des différentes activités : favoris, notes, commentaires, consultation
//**********************************
if ($_SESSION['niveau']>0) {

//**********************************
// 	Nombre de favoris de l'utilisateur - $nbfavoris
//**********************************
	$nbfavoris = 0;
	$requete = 'SELECT COUNT(id) AS total FROM favoris WHERE profil='.$_SESSION['id'];
	$recup = mysql_query($requete);
	$nbfavoris_array = mysql_fetch_assoc($recup);
	$nbfavoris = $nbfavoris_array['total'];

//**********************************
// 	Nombre de notes de l'utilisateur - $nbnotes
//**********************************
	$nbnotes = 0;
	$requete = 'SELECT COUNT(id) AS total FROM notes WHERE profil='.$_SESSION['id'];
	$recup = mysql_query($requete);
	$nbnotes_array = mysql_fetch_assoc($recup);
	$nbnotes = $nbnotes_array['total'];


//**********************************
// 	Nombre de commentaires de l'utilisateur - $nbcommentaires
//**********************************
	$nbcommentaires = 0;
	$requete = 'SELECT COUNT(id) AS total FROM commentaires WHERE profil='.$_SESSION['id'];
	$recup = mysql_query($requete);
	$nbcommentaires_array = mysql_fetch_assoc($recup);
	$nbcommentaires = $nbcommentaires_array['total'];


//**********************************
// 	Nombre de ressources consultées par l'utilisateur - $nbhistorique
//**********************************
	$requete = 'SELECT consultation FROM profil WHERE id='.$_SESSION['id'];
	$recup = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup))
			{
				$historique = $data['consultation'];
			}
	$elehistorique = explode (";",$historique);
	$nbhistorique = count($elehistorique)-1;

}


//**********************************
// Affichage des ressources de la catégorie retenue
//**********************************
function affichage_derconsul()
	{

		global $lg,$categorie,$pageencours,$page,$refpage; // récupération variable langue

			echo '<table border="0" cellspacing="5" >';

			$requete = 'SELECT consultation FROM profil WHERE id='.$_SESSION['id'];
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
				{

					if ($data['consultation']<>"") {
						$eleconsultation = explode(";",$data['consultation']);
						if (count($eleconsultation)>5) {
							for ($i = count($eleconsultation)-2; $i >= count($eleconsultation)-6; $i--) {
								affichage_ressource($eleconsultation[$i]);
							}
						} else {
							for ($i = count($eleconsultation)-2; $i >= 0; $i--) {
								affichage_ressource($eleconsultation[$i]);
							}
						}
					}

				}

			echo '</table>';

}


//**********************************
// Affichage des Catégories + dernière ressource de cette catégorie
//**********************************
function affichage_categorie()
	{

		global $lg; // récupération variable langue
			echo '<table border="0" width="100%" cellspacing="0" >';


			$requete = 'SELECT * FROM categorie';
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
				{

						echo '<tr>';
							echo '<td>';

								echo '<table border="0" cellpadding="4" cellspacing="0" bgcolor="'.couleur(1).'" width="100%" height="10">';
									echo '<tr>';
										echo '<td align="center"><a href="ressources_list.php?lg='.$lg.'&categorie='.$data['id'].'"><span class="texte_info12">'.$data[$lg].'</span></a></td>';
									echo '</tr>';
								echo '</table>';
							echo '</td>';
						echo '</tr>';
$requete = 'SELECT id FROM ressources  WHERE categorie='.$data['id'].' AND offline<>1 ORDER BY id DESC LIMIT 1';
$dernierressource=mysql_query($requete);
while ($data2 = mysql_fetch_assoc($dernierressource))
{ affichage_ressource($data2['id']); }
								
				}

			echo '</table>';

	}

include('include/affichage_ressource.inc'); // affichage d'une ressource	
include('include/affichage_page.inc'); // afficher le contenu rédactionnel d'une page
?>

<html>

	<head>
		<?php include('include/head.inc');  ?>
		<?php include('include/alexandria.inc');  ?>
		<link href="styles/styles.css" rel="styleSheet" type="text/css">
	</head>

	<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" bgcolor="white">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
			<tr height="67">
<!-- ******************************* Affichage LOGO ********************* -->
				<td align="center" valign="middle" bgcolor="<?php echo couleur(2); // couleur claire ?>" height="67">
					<?php include('include/logo_fleuron.inc'); // Affichage bandeau LOGO FLEURON ?>
				</td>
			</tr>
			<tr height="40">
<!-- ******************************* Menu principal ********************* -->
				<td bgcolor="<?php echo couleur(1); //couleur foncée ?>" height="40" align="center">
					<?php include('include/menu_top.inc'); // Menu supérieur ?>
				</td>
			</tr>
			<tr>

				<td bgcolor="#f6f5ed" align="center" valign="top">
					<table border="0" cellpadding="10" cellspacing="2" width="900">
						<tr>
<!-- Partie centrale -->
							<td valign="top">
								<?php if (isset($_GET["action"])) { ?>
									<p><div align="center"><span class="message"><?php echo content("line174"); // page modifiée ?></span></div>
								<?php } ?>

								<?php if ($_SESSION['niveau']<1) {  ?>

<!-- ******************************* Affichage page d'accueil pour le visiteur lambda ********************* -->
									<p>
										<?php affichage_accueil() ?>
									</p>
								<?php } ?>

								<?php if ($_SESSION['niveau']>0) { ?>

<!-- ******************************* Affichage page d'accueil pour un utilisateur inscrit ********************* -->

								<span class="titreaccueil"><?php echo content('line190') //Bonjour ?> <?php echo $_SESSION['utilisateur'] ?></span>
								<?php if ($nbhistorique<1) { ?>
									<?php echo '<br><br>'.content("line192").'<br><br>' //Découvrez nos ressources multimedia ?>
									<?php affichage_categorie() ?>
								<?php } ?>



								<?php } ?>

								<?php if ($_SESSION['niveau']>=50) {  ?>
<!-- ******************************* Affichage page d'accueil visiteur pour admin (édition) ********************* -->
									<div align="right">
										<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
											<tr>
												<td align="center"><a href="page_edit.php?lg=<?php echo $lg ?>&id=1&page=<?php echo $pageencours ?>"><span class="texte_info12"><?php echo content("line205_216") //Editer ?></span></a></td>
											</tr>
										</table>
									</div>
									<p>
										<?php affichage_page($pageencours) ?>
									</p>

									<div align="right">
										<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
											<tr>
												<td align="center"><a href="page_edit.php?lg=<?php echo $lg ?>&id=1&page=<?php echo $pageencours ?>"><span class="texte_info12"><?php echo content("line205_216") //Editer ?></span></a></td>
											</tr>
										</table>
									<br><br>
								<?php } ?>
								<?php if ($_SESSION['niveau']>0) { ?>
									<?php if ($nbhistorique>0) { ?>
<!-- ******************************* Affichage 5 dernières ressources consultées ********************* -->
										<table width="100%">
											<tr>
												<td align="center" bgcolor="<?php echo couleur(2); //couleur claire ?>">
													<span class="titre"><?php echo content("line227") //Vos dernières ressources consultées ?></span>
												</td>
											</tr>
										</table>
										<?php affichage_derconsul(); ?>

									<?php } ?>
								<?php } ?>
							</td>
<!-- ---------------------- Fin partie centrale ------------------------------- -->
<!-- -----------------------Colonne de droite --------------------------------- -->
							<td width="250" align="right" valign="top">
								<table border="0" cellpadding="5" cellspacing="2">
								<?php if ($_SESSION['niveau']<1) { ?>
<!-- Module d'affichage des choix des langues disponibles (table LG) -->
									<tr>

										<td align="right">
											<?php include('include/choix_langue.inc');  ?>
										</td>
									</tr>
								<?php } ?>
								<?php if ($_SESSION['niveau']<1) { ?>
<!-- Module d'affichage du formulaire de connexion -->
									<tr>
										<td align="right">
											<?php include('include/login.inc');  ?>
										</td>
									</tr>
								<?php } ?>
<!-- Module d'affichage du formulaire de recherche  -->
									<tr>
										<td align="right">
											<?php include('include/moteurderecherche.inc');  ?>
										</td>
									</tr>
<!-- Module d'affichage du dernier media publié  -->
									<tr>
										<td align="right">
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
<!-- -------------------------- Fin colonne de droite ----------------------------- -->
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
<!-- Module d'affichage du dernier media publié  -->
				<?php include('include/logo_basdepage.inc');  ?>
				</td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
	</body>
<!-- ****************************************************************************************** -->
<!--  	Réalisation par Steven DUDA pour CNRS/ATILF - 2016 					-->
<!--	06 63 10 33 21 - steven.duda@wanadoo.fr							-->
<!--	www.stevenduda.com									-->
<!-- ****************************************************************************************** -->
</html>
<?php include('include/close_connectionBase.inc');  ?>
