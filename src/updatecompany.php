<?php

error_reporting(E_ERROR | E_PARSE);

//$_POST['companyid'] = "c0003";
//$_POST['updatekey'] = "ip_add_end_range";
//$_POST['updatevalue'] = "172.16.30.198";

$host=file_get_contents("host.txt");
$username=file_get_contents("username.txt");
$password=file_get_contents("password.txt");
$database=file_get_contents("database.txt");

$con=mysqli_connect($host,$username,$password,$database);

// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$q1 = "UPDATE company SET ".$_POST['updatekey']." = '" .$_POST['updatevalue']. "' WHERE company_id = '".$_POST['companyid']."'";

//echo $q1;

$update = mysqli_query($con, $q1);

$newresult = mysqli_query($con,"SELECT * FROM company");

while($row = mysqli_fetch_array($newresult,MYSQLI_ASSOC)) {

	$rows[]=$row;

}

echo json_encode($rows);

mysqli_close($con);

?>