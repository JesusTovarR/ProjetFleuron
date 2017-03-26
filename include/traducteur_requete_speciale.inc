<?
function creer_brouillon($table, $lg, $status, $ap_ref, $nb_table){
	$requete='SELECT code FROM '.$table.' WHERE status=1 AND id_user='.$_SESSION['id'].' AND code="'.$lg.'"';
	$recup = mysql_query($requete);
	$requete2='SELECT code FROM '.$table.' WHERE status=0 AND id_user='.$_SESSION['id'].' AND code="'.$lg.'"';
	$recup2 = mysql_query($requete2);
	if ($data = mysql_fetch_assoc($recup)){
		$_SESSION['exist']=$_SESSION['exist']+1;
	}else if($data2 = mysql_fetch_assoc($recup2)){
		$_SESSION['exist']=$_SESSION['exist']+1;
	}else{
		if($nb_table==15){
			$categoriesId='SELECT id FROM categorie';
			$recupCategories=mysql_query($categoriesId);
			while($dataCategorie=mysql_fetch_assoc($recupCategories)){
				$requete3='SELECT * FROM categorie_traduction WHERE  category='.$dataCategorie['id'].' AND code="'.$lg.'" AND status='.$status.' AND ap_ref='.$ap_ref;
				$recup3=mysql_query($requete3);
				while($data3=mysql_fetch_assoc($recup3)) {
					$name= addslashes($data3['name']);
					$categorie = 'INSERT INTO ' . $table . ' (name, category, code, status, id_user, ap_ref) VALUES ( \'' .$name.'\', '.$dataCategorie['id'].', \'' . $lg . '\', 0, ' . $_SESSION['id'] . ', 0)';
					$exec = mysql_query($categorie);
				}
			}
			$_SESSION['cree']=$_SESSION['cree']+1;
		}else{
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
}

function ajouter_langue($table, $lg, $nb_table){
	if($nb_table==15){
		$categoriesId='SELECT id FROM categorie';
		$recupCategorie=mysql_query($categoriesId);
		while($dataCategorie=mysql_fetch_assoc($recupCategorie)){
			$requete3='SELECT * FROM categorie_traduction WHERE  category='.$dataCategorie['id'].' AND code="fr" AND status=1';
			$recup3=mysql_query($requete3);
			while($data3=mysql_fetch_assoc($recup3)) {
				$name= addslashes($data3['name']);
				$categorie = 'INSERT INTO ' . $table . ' (name, category, code, status, id_user, ap_ref) VALUES (\' ' . $name .'\', '.$dataCategorie['id'].', \'' . $lg . '\', 1, ' . $_SESSION['id'] . ', 0)';
				$exec = mysql_query($categorie);
			}
		}
		$_SESSION['cree']=$_SESSION['cree']+1;
	}else{
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
}
?>