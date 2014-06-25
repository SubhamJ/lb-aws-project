<?php
include_once("Mail.php");
error_reporting(E_ERROR | E_PARSE);

// Create connection
$con = mysqli_connect ( "localhost", "root", "", "toonify" );

// Check connection
if (mysqli_connect_errno ()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

//$_POST[user_id] =  file_get_contents("./details/recipients_email.txt");
$user_id = file_get_contents("./details/recipients_email.txt");

// CHECKING DETAILS FOR ADMIN
$verifyadmin = "SELECT * FROM admin_table where admin_id = '".$user_id."'";
echo $verifyadmin;
echo '<br>';

$adminresult = mysqli_query ( $con, $verifyadmin );

if($adminresult) {

	while ( $newadmin = mysqli_fetch_assoc ( $adminresult ) ) {
		$password = $newadmin ['password'];
		$user_name = $newadmin ['admin_name'];
	
		echo $password;
		echo '<br>';
		echo $user_name;
		echo '<br>';
		break;
	}
}*/

{

	//CHECKING DETAILS FOR USERS
	$verifyuser = "SELECT * FROM users where user_id = '".$user_id."'";

	echo $verifyuser;
	echo '<br>';
	
	$result = mysqli_query ( $con, $verifyuser );
	
	if($result) {
	{
		while ( $newuser = mysqli_fetch_assoc ( $result ) ) {
		
			echo '<br>';
			echo "Here";
			
			$user_name = $newuser ['user_name'];
			$password = $newuser ['password'];
			
			echo $password;
			echo '<br>';
			echo $user_name;
			echo '<br>';
			break;
		}
	}
	
	/*else {
		echo "Mail does not exist";
		exit();
	}*/
}

//$user_id = $_POST[user_id]; 
//$user_name = file_get_contents("./details/recipients_name.txt");
//$password = file_get_contents("./details/recipients_password.txt");
$sender = file_get_contents("./details/senders_email.txt");
  
$From = "Toonify <$sender>";
$To = "$user_name <$user_id>";
$Subject = "Toonify Password";
$Message = "The Password for your account is '".$password."'";
  
$Host = "smtp.gmail.com";
$Username = "$sender";
$Password = file_get_contents("./details/senders_password.txt");
  
$Headers = array ('From' => $From, 'To' => $To, 'Subject' => $Subject);
$SMTP = Mail::factory('smtp', array ('host' => $Host, 'auth' => true,
'username' => $Username, 'password' => $Password));
  
$mail = $SMTP->send($To, $Headers, $Message);
  
if (PEAR::isError($mail)){
echo($mail->getMessage());
} else {
echo("Email Message sent!");
}
?>
