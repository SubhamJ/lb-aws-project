<?php

error_reporting(E_ERROR | E_PARSE);

$host=file_get_contents("host.txt");
$username=file_get_contents("username.txt");
$password=file_get_contents("password.txt");
$database=file_get_contents("database.txt");

$con=mysqli_connect($host,$username,$password,$database);

$company_id = $_POST['companyid'];

$videos = mysqli_query($con, "SELECT video_id FROM content WHERE company_id = '".$company_id."'");

while($oldvideos = mysqli_fetch_assoc($videos)) {

	$thisvideo = $oldvideos ['video_id'];

	$contents = mysqli_query($con, "SELECT detail_id from content_details where video_id ='" . $thisvideo . "'"); 
	
	while($olddetails = mysqli_fetch_array($contents,MYSQLI_ASSOC)) {
	
		$thisdetail = $olddetails ['detail_id'];
	
		$deletedetail = mysqli_query($con, "DELETE from content_details where detail_id ='" . $thisdetail . "'"); 
	
	}
	
	$deletevideo = mysqli_query($con, "DELETE from content where video_id ='" . $thisvideo . "'"); 
	 
}

$ourusers = mysqli_query($con, "SELECT user_id from users where company_id ='" . $company_id . "'");

while($oldusers = mysqli_fetch_array($ourusers,MYSQLI_ASSOC)) {

	$thisuser = $oldusers ['user_id'];

	$deleteuser = mysqli_query($con, "DELETE from users where user_id ='" . $thisuser . "'");

}

//delete company
$deletecompany = mysqli_query($con, "DELETE from company where company_id ='" . $company_id . "'");

//select all the data from the table
$result = mysqli_query($con,"SELECT * FROM company");

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {

	$rows[]=$row;

}

echo json_encode($rows);

mysqli_close($con);

?>