<?php

error_reporting(E_ERROR | E_PARSE);

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

$video_id1=$_POST[videoid];

//echo $video_id1;

$selectdetails = "SELECT * FROM content_details where video_id = '".$video_id1."'";

//echo $selectdetails;

$result = mysqli_query($con, $selectdetails);


while ($new = mysqli_fetch_assoc($result)){

	$news[]=$new;

}

echo json_encode($news);

?>