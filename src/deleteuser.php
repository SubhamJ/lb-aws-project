<?php

error_reporting(E_ERROR | E_PARSE);

$host=file_get_contents("host.txt");
$username=file_get_contents("username.txt");
$password=file_get_contents("password.txt");
$database=file_get_contents("database.txt");

$con=mysqli_connect($host,$username,$password,$database);

//$_POST[userid] = "d0003";

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//insert the data into the table  
$sql="DELETE FROM users WHERE user_id ='" . $_POST[userid] . "'";
		
if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
//echo "user deleted";

//select all the data from the table
$result = mysqli_query($con,"SELECT * FROM users");

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

	$rows[]=$row;

}

echo json_encode($row);

mysqli_close($con);

?>