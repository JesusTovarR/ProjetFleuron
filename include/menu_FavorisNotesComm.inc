<?php 
if ($_SESSION['niveau']>0){ // Affichage menu Administration ?>

<?php
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

?>

<table>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
				<tr>
					<td align="center"><a href="favoris_list.php?lg=<?php echo $lg ?>&page=<?php echo $pageencours ?>&idprofil=<?php echo $_SESSION['id'] ?>"><span class="texte_info12"><?php echo tableau_du_bord('btnfavorite')// Favoris ?> (<?php echo $nbfavoris ?>)</span></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
				<tr>
					<td align="center"><a href="notes_list.php?lg=<?php echo $lg ?>&page=<?php echo $pageencours ?>&idprofil=<?php echo $_SESSION['id'] ?>"><span class="texte_info12"><?php echo tableau_du_bord('btnnote') //Notes ?> (<?php echo $nbnotes ?>)</span></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
				<tr>
					<td align="center"><a href="commentaires_list.php?lg=<?php echo $lg ?>&page=<?php echo $pageencours ?>&idprofil=<?php echo $_SESSION['id'] ?>"><span class="texte_info12"><?php echo tableau_du_bord('btncomment') //Commentaires ?> (<?php echo $nbcommentaires ?>)</span></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
				<tr>
					<td align="center"><a href="historique_list.php?lg=<?php echo $lg ?>&page=<?php echo $pageencours ?>&idprofil=<?php echo $_SESSION['id'] ?>"><span class="texte_info12"><?php echo tableau_du_bord('btnhistory') //Historique ?> (<?php echo $nbhistorique ?>)</span></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="4" cellspacing="2" bgcolor="<?php echo couleur(1); //couleur foncée ?>" width="220">
				<tr>
					<td align="center"><a href="glossaire.php?lg=<?php echo $lg ?>&page=<?php echo $pageencours ?>&idprofil=<?php echo $_SESSION['id'] ?>"><span class="texte_info12"><?php echo tableau_du_bord('btnglossary') //glossaire ?></span></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php } ?>