<?php

$host ="localhost";
$username = "Jeremy";
$password = "password";

$dbc = mysql_connect($host,$username,$password);
if (!$dbc){
	die('Not connected : ' . mysql_error());
}
//select database
$db_selected = mysql_select_db("practice",$dbc);
if(!$db_selected) 
{
	die("cant connect : " .  mysql_error());	
}

?>