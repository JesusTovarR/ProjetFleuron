<?php


include('include/open_connectionBase.inc'); // connection � la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique, variable session)


$requete ='UPDATE profil SET '; // d�but de la composition de la requete de mise � jour

$requete = $requete.'nom="'.$_POST["nom"].'",';

$requete = $requete.'prenom="'.$_POST["prenom"].'",';

$requete = $requete.'email="'.$_POST["email"].'",';

$requete = $requete.'pays="'.$_POST["pays"].'",';

$requete = $requete.'langue="'.$_POST["langue"].'",';

$requete = $requete.'utilisateur="'.$_POST["utilisateur"].'",';

if(isset($_POST['traducteur'])){
    if($_POST["traducteur"]==1){
        $requete = $requete.'niveau=21,';
        $_SESSION['niveau']=21;
    }else if($_POST["traducteur"]==0){
        $requete = $requete.'niveau=10,';
        $_SESSION['niveau']=10;
    }
}


if($_POST['referent']){
    $requete2 = 'INSERT INTO langues_profil VALUES (null,"'.$_POST['langue_referent']. '",' . $_POST['id']. ')';
    var_dump($requete2);
    var_dump(mysql_query($requete2));
}


$requete = $requete.'demande_referent="'.$_POST["referent"].'",';

$requete = $requete.'motdepasse="'.$_POST["motdepasse"].'"';


$requete = $requete.' WHERE id='.$_POST["id"];


mysql_query($requete) or die('Erreur SQL !'.$sql.'<br />'.mysql_error()); // envoie de la requete : modification du profil

include('include/close_connectionBase.inc');

header('Location: profil.php?lg='.$_POST["langue"].'&action=ok'); // redirection
?>
