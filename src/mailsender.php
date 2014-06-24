<?php
include_once("Mail.php");

error_reporting(E_ERROR | E_PARSE);

// Create connection
$con = mysqli_connect ( "localhost", "root", "", "toonify" );

// Check connection
if (mysqli_connect_errno ()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

//$_POST[user_id] =  "";
 
$user_id = $_POST[userid]; 

$verifyid = "SELECT * FROM users where user_id = '" . $user_id1 . "'";

$idresult = mysqli_query ( $con, $verifyid );

while ( $newuser = mysqli_fetch_assoc ( $idresult ) ) {
	$user_id2 = $newuser ['user_id'];
	$password2 = $newuser ['password'];
	$role2 = $newuser ['role'];
	$company_id2 = $newuser ['company_id'];
	$user_name2 = $newuser ['user_name'];
	break;
}
  
$user_name = $user_name2;
$password = $password2;

$From = "Toonify <sender's email>";
$To = "$user_name <$user_id>";
$Subject = "Toonify Password";
$Message = "The Password for your account is '".$password."'";
  
$Host = "smtp.gmail.com"; //smtp host for sender's email
$Username = "Last Bench Email";
$Password = "";
  
  
$Headers = array ('From' => $From, 'To' => $To, 'Subject' => $Subject);
$SMTP = Mail::factory('smtp', array ('host' => $Host, 'auth' => true,
'username' => $Username, 'password' => $Password));
  
$mail = $SMTP->send($To, $Headers, $Message);
  
if (PEAR::isError($mail)){
echo($mail->getMessage());
} else {
echo("Email Message sent!");
}

mysqli_close($con);

?>
