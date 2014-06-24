<?php

error_reporting(E_ERROR | E_PARSE);

// Create connection
$con=mysqli_connect("localhost","root","","toonify");

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