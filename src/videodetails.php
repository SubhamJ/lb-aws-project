<?php

error_reporting(E_ERROR | E_PARSE);

//comment the next line when login redirects to dashboard
//$_SESSION['company']='c0001';

//echo "Hello Users! :)";

// Create connection
$host=file_get_contents("host.txt");
$username=file_get_contents("username.txt");
$password=file_get_contents("password.txt");
$database=file_get_contents("database.txt");

$con=mysqli_connect($host,$username,$password,$database);

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM content where company_id = '".$_SESSION['company']."'");


while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	
	$rows[]=$row;

}

echo json_encode($rows);

mysqli_close($con);
		
?>