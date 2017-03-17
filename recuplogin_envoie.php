<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique, variable session)



$email = $_POST["email"];

$lg = $_POST["lg"];

$mess1 = versionlinguistique(142);
$mess2 = versionlinguistique(143);

			$requete='SELECT * FROM profil WHERE email="'.$email.'"';
			$recup = mysql_query($requete);
				while ($data = mysql_fetch_assoc($recup))
					{

						$iduser=$data['id'];
						$nom=$data['nom'];
						$prenom=$data['prenom'];
						$email=$data['email'];
						$pays=$data['pays'];
						$langue=$data['langue'];
						$utilisateur=$data['utilisateur'];
						$niveau=$data['niveau'];
						$motdepasse=$data['motdepasse'];

					}



//************************************************DEBUT AJOUT PAR NETISSIME

$destinataire = $email; // l'adresse du destinataire

$sujet = versionlinguistique(145);

$fromemetteur = "info@fleuron2016.com"; // l'adresse de l'émetteur qui DOIT exister en tant qu'adresse mail ou alias

				$message = $mess1.' '.$utilisateur.'( email : '.$email.')'."<br />";
				$message .= '&nbsp;'."<br />";
				$message .= $mess2.':'."<br />";

				$message .= '<b>'.$motdepasse.'</b>'."<br />";


$mailheaders  = "MIME-Version: 1.0 \r\n";
$mailheaders  .= "Content-type: text/html; charset=utf-8 \r\n";
$mailheaders  .= "From: ".$fromemetteur."  \r\n";
$mailheaders  .= "Reply-To: ".$fromemetteur." \r\n";
$mailheaders  .= "Content-Transfer-Encoding: 8bit \r\n";

if (mail($destinataire, $sujet, $message,$mailheaders,"-f $fromemetteur"))
{

}
else
{

}



include('include/close_connectionBase.inc');

header('Location: recuplogin_ok.php?lg='.$lg.'&action=ok'); // redirection
?>