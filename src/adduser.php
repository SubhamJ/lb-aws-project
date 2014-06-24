<?php

error_reporting(E_ERROR | E_PARSE);

$con=mysqli_connect("localhost","root","","toonify");

//$_POST[userid] = "d0006";
//$_POST[username] = "Itachi Uchiha";
//$_POST[password] = "Mangekyo";
//$_POST[role] = "user";
//$_POST[company_id] = "c0001";

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//insert the data into the table  
$sql="INSERT INTO users (user_id,user_name,password,role,company_id)
VALUES
('$_POST[userid]','$_POST[username]','$_POST[password]','$_POST[role]','$_POST[company_id]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error($con));
  }
//echo "user added";

//select all the data from the table
$result = mysqli_query($con,"SELECT * FROM users");

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

	$rows[]=$row;

}

echo json_encode($rows);

mysqli_close($con);

?>