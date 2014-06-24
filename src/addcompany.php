<?php

error_reporting(E_ERROR | E_PARSE);

$con=mysqli_connect("localhost","root","","toonify");

//$_POST[companyid] = "c0003";
//$_POST[companyname] = "Microsoft";
//$_POST[startip] = "172.16.30.21";
//$_POST[endip] = "172.16.30.211";

// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//insert the data into the table
$sql="INSERT INTO company (company_id,company_name,ip_add_start_range,ip_add_end_range)
VALUES
('$_POST[companyid]','$_POST[companyname]','$_POST[startip]','$_POST[endip]')";

if (!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
}
//echo "user added";

//select all the data from the table
$result = mysqli_query($con,"SELECT * FROM company");

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

	$rows[]=$row;


}

echo json_encode($rows);

mysqli_close($con);

?>