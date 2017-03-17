<?php

include('include/open_connectionBase.inc'); // connection à la base MYSQL

include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)


if ($_POST["utilisateur"]=="")
	{
		header('Location: '.$_POST["pageencours"].'?lg='.$_POST["lg"]); // redirection vers index
	}


if ($_POST["motdepasse"]=="")
	{
		header('Location: '.$_POST["pageencours"].'?lg='.$_POST["lg"]); // redirection vers index
	}

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

include('include/close_connectionBase.inc'); // fin de connexion à la base

if ($niveau=="")
	{
		header('Location: '.$_POST["pageencours"].'?lg='.$_POST["lg"]); // redirection vers index
	} else {
		$_SESSION['utilisateur'] = $utilisateur;
		$_SESSION['niveau'] = $niveau;
		$_SESSION['langue'] =$langue;
		$_SESSION['id'] =$id;
		header('Location: index.php?lg='.$langue); // redirection vers index
	}


?>