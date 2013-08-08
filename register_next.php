<?php
include("connect.php");

$test = $_POST["username"];

//test to see if username is alpha-numeric 
$pattern ='/^[-a-zA-Z0-9_\x{30A0}-\x{30FF}'
         .'\x{3040}-\x{309F}\x{4E00}-\x{9FBF}\s]*$/u';

if(preg_match($pattern,$test))
{
	//test for duplicate names
	$query = "SELECT username FROM users WHERE username = '$_POST[username]'";
	$result =mysql_query($query);
	$numUsername = mysql_num_rows($result);
	
	if($numUsername == 0){
		if($_POST["email"] == $_POST["email2"]){
			$query = "SELECT email FROM users WHERE username = '$_POST[email]'";
			$result =mysql_query($query);
			$numEmails = mysql_num_rows($result);
			if($numEmails == 0){
				if($_POST["pass"] == $_POST["pass2"])
				{
					//generate random confirmation code
					$confimation_code=md5(uniqid(rand()));
					
					//get rid of all html from hackers
					$name=strip_tags($_POST["username"]);
					$email=strip_tags($_POST["email"]);
					$pass=strip_tags($_POST["pass"]);
					
					//insert data into db
					$sql="INSERT INTO temp SET code='$confimation_code', username = '$name', email = '$email', password = '$pass'";
					$result =mysql_query($sql);
					
					if($result)
					{
						$message = "Your Confirmation link\r\n";
						$message .= "Click on this link to activate your account\r\n";
						$message .= "localhost/confirmation.php?passkey=$confimation_code";
						
						$sentemail = mail('$email','Registration Confirmation','$message');
						echo "Thank you! ";
					}
					else {
						echo "did not find you email in the database";
					}
					//If email sucessfully sends
					if ($sentemail){
						echo "Your confirmation link has been sent to your e-mail address";
					}
					else {
						"Cannot confirmation link to your e-mail address";
					}
				}
				else
				{
					echo "Passwords did not match";
				}
			}
			else
			{
				echo "Email already exists";
			}		
		}
		else{
			echo "Emails did not match";
		}
	}
	else{
		echo "Name in use";
	}
}
else
{
	echo "Sorry that name is invalid";
	//header("Location:invalidname.html");
}

?>