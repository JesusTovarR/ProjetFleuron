<?php
include('include/open_connectionBase.inc'); 

include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

//$utilisateur = $_POST["utilisateur"];


$requete ='INSERT INTO `profil` (`id`,`utilisateur`,`motdepasse`,`nom`,`prenom`,`email`,`pays`,`langue`,`jour`,`niveau`) VALUES (NULL,'; // début de la composition de la requete de mise à jour
$requete = $requete.'\''.$_POST["utilisateur"].'\',';
$requete = $requete.'\''.$_POST["motdepasse"].'\',';
$requete = $requete.'\''.$_POST["nom"].'\',';
$requete = $requete.'\''.$_POST["prenom"].'\',';
$requete = $requete.'\''.$_POST["email"].'\',';
$requete = $requete.'\''.$_POST["pays"].'\',';
$requete = $requete.'\''.$_POST["langue"].'\',';
$requete = $requete.'\''.date("y-m-d").'\',';
$requete = $requete.'1)'; // niveau utilisateur

mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete

// Vérification de l'existence du user+motdepasse
	$requete='SELECT * FROM profil WHERE utilisateur="'.$_POST["utilisateur"].'" AND motdepasse="'.$_POST["motdepasse"].'"';
	$recup = mysql_query($requete);
		while ($data = mysql_fetch_assoc($recup))
		{

			$niveau=$data['niveau'];
			$utilisateur=$data['utilisateur'];
			$langue=$data['langue'];
			$id=$data['id'];
		}

include('include/close_connectionBase.inc'); 

		$_SESSION['utilisateur'] = $utilisateur;
		$_SESSION['niveau'] = $niveau;
		$_SESSION['langue'] =$langue;
		$_SESSION['id'] =$id;

header('Location: index.php?lg='.$_POST["langue"]); // redirection

?>
