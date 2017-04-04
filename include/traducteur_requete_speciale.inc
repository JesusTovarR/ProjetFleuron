<?
function creer_brouillon($table, $lg, $status, $ap_ref, $nb_table){
	$requete='SELECT code FROM '.$table.' WHERE id_user='.$_SESSION['id'].' AND code="'.$lg.'"';
	$recup = mysql_query($requete);
	$requete2='SELECT code FROM '.$table.' WHERE id_user='.$_SESSION['id'].' AND code="'.$lg.'"';
	$recup2 = mysql_query($requete2);

    if ($data=mysql_fetch_assoc($recup)){
        $_SESSION['exist']=$_SESSION['exist']+1;
    }else if($data2=mysql_fetch_assoc($recup2)){
        $_SESSION['exist']=$_SESSION['exist']+1;
    }else {
			$requete4='SELECT * FROM '.$table.' WHERE code="'.$lg.'" AND status='.$status.' AND ap_ref='.$ap_ref;
			$recup4 = mysql_query($requete4);
			if ($data4 = mysql_fetch_assoc($recup4))
			{
				$count= 0;
				$col="";
				$val="";
				foreach ($data4 as $cle => $value){

					if($cle!="id"&&$cle!="code"&&$cle!="status"&&$cle!="id_user"&&$cle!="ap_ref"){
						$count=$count+1;
						if ($count==1) {
							// Replacer les '
							$col ="".$cle;
							$val ='\''.addslashes($value).'\'';
						} else {
							$col = $col.", ".$cle;
							$val =$val.', \''.addslashes($value).'\'';
						}
					}

				}

			}

			$requete5='INSERT INTO '.$table.' ('.$col.', code, status, id_user, ap_ref) VALUES ( '.$val.', \''.$lg.'\', 0, '.$_SESSION['id'].', 0)';
			$exec = mysql_query($requete5);
			$_SESSION['cree']=$_SESSION['cree']+1;
		}
}

function creer_brouillon_ressource($table, $id_resource, $lg, $status, $ap_ref, $nb_table){
/*    $requete="";
    $recup="";
    $requete2="";
    $recup2="";
    $data="";
    $data2="";
    $ressources="";
    $recupRes="";
    $dataRes="";
    $name="";
    $categorie="";
    $title="";
    $description="";
    $exec="";*/
    if($nb_table==15){
        $requete='SELECT code FROM '.$table.' WHERE category='.$id_resource.' AND id_user='.$_SESSION['id'].' AND code="'.$lg.'"';
        $recup = mysql_query($requete);
    }else{
        $requete='SELECT code FROM '.$table.' WHERE id_resource='.$id_resource.' AND id_user='.$_SESSION['id'].' AND code="'.$lg.'"';
        $recup = mysql_query($requete);
    }

    $total = mysql_num_rows($recup);

    if ($total>0){
        $_SESSION['exist']=$_SESSION['exist']+1;
    }else {
            if($nb_table==15){
                $ressources='SELECT * FROM '.$table.' WHERE  category='.$id_resource.' AND code="'.$lg.'" AND status='.$status.' AND ap_ref='.$ap_ref;
                $recupRes=mysql_query($ressources);
            }else{
                $ressources='SELECT * FROM '.$table.' WHERE  id_resource='.$id_resource.' AND code="'.$lg.'" AND status='.$status.' AND ap_ref='.$ap_ref;
                $recupRes=mysql_query($ressources);
            }
            while($dataRes=mysql_fetch_assoc($recupRes)) {
                if($nb_table==15){
                    $name= addslashes($dataRes['name']);
                    $categorie = 'INSERT INTO ' . $table . ' (name, category, code, status, id_user, ap_ref) VALUES ( \'' .$name.'\', '.$dataRes['category'].', \'' . $lg . '\', 0, ' . $_SESSION['id'] . ', 0)';
                }else if($nb_table==16){
                    $title= addslashes($dataRes['title']);
                    $description= addslashes($dataRes['description']);
                    $categorie = 'INSERT INTO ' . $table . ' (title, description, category, id_resource, code, status, id_user, ap_ref) VALUES ( \'' .$title.'\', \'' .$description.'\', '.$dataRes['category'].','.$dataRes['id_resource'].', \'' . $lg . '\', 0, ' . $_SESSION['id'] . ', 0)';
                }else if($nb_table==17){
                    $text= addslashes($dataRes['text']);
                    $categorie = 'INSERT INTO ' . $table . ' (text, id_resource, code, status, id_user, ap_ref) VALUES ( \'' .$text.'\', '.$dataRes['id_resource'].', \'' . $lg . '\', 0, ' . $_SESSION['id'] . ', 0)';
                }
                $exec = mysql_query($categorie);
            }
    }
}

function ajouter_langue($table, $lg, $nb_table){
		$requete = 'SELECT * FROM ' . $table . ' WHERE code="fr" AND status=1';
		$recup = mysql_query($requete);
		if ($data = mysql_fetch_assoc($recup)) {
			$count = 0;
			$col = "";
			$val = "";
			foreach ($data as $cle => $value) {

				if ($cle != "id" && $cle != "code" && $cle != "status" && $cle != "id_user" && $cle != "ap_ref") {
					$count = $count + 1;
					if ($count == 1) {
						// Replacer les '
						$col = "" . $cle;
						$val = '\'' . addslashes($value) . '\'';
					} else {
						$col = $col . ", " . $cle;
						$val = $val . ', \'' . addslashes($value) . '\'';
					}
				}

			}

		}
		$requete2 = 'INSERT INTO ' . $table . ' (' . $col . ', code, status, id_user, ap_ref) VALUES ( ' . $val . ', \'' . $lg . '\', 1, ' . $_SESSION['id'] . ', 0)';
		$exec = mysql_query($requete2);
		$_SESSION['cree'] = $_SESSION['cree'] + 1;
}

function ajouter_langue_ressource($table, $id_resource, $lg, $nb_table){
/*    $ressources="";
    $recupRes="";
    $dataRes="";
    $name="";
    $categorie="";
    $title="";
    $description="";
    $exec="";*/
            if($nb_table==15){
                $ressources='SELECT * FROM '.$table.' WHERE  category='.$id_resource.' AND code="fr" AND status=1';
                $recupRes=mysql_query($ressources);
            }else{
                $ressources='SELECT * FROM '.$table.' WHERE  id_resource='.$id_resource.' AND code="fr" AND status=1';
                $recupRes=mysql_query($ressources);
            }
            while($dataRes=mysql_fetch_assoc($recupRes)) {
                if($nb_table==15){
                    $name= addslashes($dataRes['name']);
                    $categorie = 'INSERT INTO ' . $table . ' (name, category, code, status, id_user, ap_ref) VALUES ( \'' .$name.'\', '.$dataRes['category'].', \'' . $lg . '\', 1, ' . $_SESSION['id'] . ', 0)';
                }else if($nb_table==16){
                    $title= addslashes($dataRes['title']);
                    $description= addslashes($dataRes['description']);
                    $categorie = 'INSERT INTO ' . $table . ' (title, description, category, id_resource, code, status, id_user, ap_ref) VALUES ( \'' .$title.'\', \'' .$description.'\', '.$dataRes['category'].', '.$dataRes['id_resource'].', \'' . $lg . '\', 1, ' . $_SESSION['id'] . ', 0)';
                }else if($nb_table==17){
                    $text= addslashes($dataRes['text']);
                    $categorie = 'INSERT INTO ' . $table . ' (text, id_resource, code, status, id_user, ap_ref) VALUES ( \'' .$text.'\', '.$dataRes['id_resource'].', \'' . $lg . '\', 1, ' . $_SESSION['id'] . ', 0)';
                }
                $exec = mysql_query($categorie);
            }
        $_SESSION['cree']=$_SESSION['cree']+1;
}
?>