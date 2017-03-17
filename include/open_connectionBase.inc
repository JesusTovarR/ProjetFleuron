<?php
$link = mysql_connect('localhost', 'root','root');
if (!$link) {
	die('Could not connect: ' . mysql_error());
}


$bdd = mysql_select_db('fleuron',$link);
if (!$bdd){
	die('Could not connect: ' . mysql_error());
}


?>


