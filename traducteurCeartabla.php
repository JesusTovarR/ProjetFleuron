<?php


include('include/open_connectionBase.inc'); // connection à la base MYSQL


include('include/initialisation_page.inc'); // initialisation des variables de la page (page encours,lg,couleur, version linguistique)

$array=array(3, 5, 6, 8, 9, 11, 13, 14, 16, 18, 19, 20, 21, 22, 23, 25, 27, 33, 34, 38, 39, 41, 42, 43, 44, 45, 49, 53, 54, 55, 56, 57, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 70, 72, 73, 74, 76, 81, 82, 84, 85, 86, 87, 88, 89, 90, 91, 93, 95, 97, 98, 99, 100, 101, 102, 104, 105, 106, 107, 109, 110, 111, 114, 115, 117, 118, 119, 120, 121, 122, 123, 124, 130, 131, 132, 135, 138, 139, 140, 141, 142, 143, 144, 145  );

//var_dump($array);

$resultado = array_unique($array);
sort($resultado);
$inser=array();
$count=0;

foreach ($resultado as $value){
	$requete2='SELECT id, es FROM versionlinguistique WHERE id='.$value;
	$resultat = mysql_query($requete2);
	while ($codes = mysql_fetch_assoc($resultat)){
		$inser[$count]=array("id"=> $codes["id"], "valor"=> $codes["es"]);
		$count=$count+1;
	}

}
$col="";
$data="";
$col2=array();
$data2=array();
$validation=null;
foreach ($array as $num){
	foreach ($inser as $val){
		foreach ($val as $cle => $valor){
			if($cle=="id"){
				$validation=$valor;
			}
			if($cle=="valor"){
				if(!is_null($validation)){
					if($validation==$num){
						$data=$data.'"'.addslashes($valor).'", ';
						array_push($data2,$valor);

					}
				}
			}
		}

	}
	$col=$col."text".$num.", ";
	array_push($col2,$num);
}

$requete5='INSERT INTO new_versionlinguistique ('.$col.'code, status, id_user, ap_ref) VALUES ('.$data.'"es", 1, 1, 1)';
var_dump($requete5);
$exec = mysql_query($requete5);

/*
 * $requet=$requet.", text".$value." longtext COLLATE utf8_general_ci NOT NULL";
 * $sql = "CREATE TABLE new_versionlinguistisque (id INT(10) AUTO_INCREMENT PRIMARY KEY ".$requet.")";
$codes = mysql_query($sql);*/



include('include/close_connectionBase.inc');


?>