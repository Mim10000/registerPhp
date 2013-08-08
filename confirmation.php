<?php
include("connect.php");

//set variable
$passkey=$_GET['passkey'];

$sql1 = "SELECT * FROM temp WHERE code = '$passkey'";
$result1 = mysql_query($sql1); 

//if sucessfully queried
if($result1) {
	//how many rows has key?
	$count = mysql_num_rows($result1);
	
	//if passkey is in db retrieve it
	if($count == 1)
	{
		$rows = mysql_fetch_array($result1);
		$namex = $rows['username'];
		$emailx =  $rows['email'];
		$passx =  $rows['password'];
		
		//takeoutspace (For Security)
		$name = str_replace(' ','',$namex);
		$email = str_replace(' ','',$emailx);
		$pass = str_replace(' ','',$passx);
		
		//insert into tables
		$sql2 = "INSERT INTO users SET uesrname '$name', email = '$email',password = '$pass' "; 
		$result = mysql_query($sql2);
		
	}
}
?>