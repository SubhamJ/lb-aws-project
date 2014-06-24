<?php

require 'aws.phar';

error_reporting(E_ERROR | E_PARSE);

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

use Aws\S3\S3Client;
use Aws\Common\Aws;
use Aws\Common\Enum\Region;
use Aws\Common\Facade;



if ($_FILES ["file"] ["error"] > 0) {
	echo "Error: " . $_FILES ["file"] ["error"] . "<br>";
} else {
	echo "Upload: " . $_FILES ["file"] ["name"] . "<br>";
	echo "Type: " . $_FILES ["file"] ["type"] . "<br>";
	echo "Size: " . ($_FILES ["file"] ["size"] / 1024) . " kB<br>";
	//echo "Stored in: " . $_FILES ["file"] ["tmp_name"];
}

$s3 = \Aws\S3\S3Client::factory(array(
		'key'    => '',
		'secret' => '',
		'region' => Region::US_WEST_2
)); 

$bucket = "toonify";
$keyname = $_FILES ["file"] ["name"];
$filepath = $_FILES ["file"] ["tmp_name"];

// Upload a file.

try {
$result = $s3 -> putObject( array (
		'Bucket' => $bucket,
		'Key' =>   $_SESSION ['company']. "/" .$keyname,
		'SourceFile' => $_FILES ["file"] ["tmp_name"],
		'ACL' => 'public-read',
 		'ContentType' => $_FILES ["file"] ["type"],
		'StorageClass' => 'REDUCED_REDUNDANCY'
) );

$url=$result ['ObjectURL'];

} catch (Exception $e){
	echo $e->getMessage()."\n";
}

echo $result ['ObjectURL'];

$sql="INSERT INTO content_details (detail_id,video_id,asset_info,asset_url)
VALUES
('$_POST[detailid]','$_POST[videoid]','$_POST[assetinfo]','$url')";

if (!mysqli_query($con,$sql))
{
	die('Error: ' . mysqli_error($con));
}

mysqli_close($con);

?> 