<?php

// $_POST[userid]="d0001";
// $_POST[password]="ivan123";

error_reporting(E_ERROR | E_PARSE);

$host=file_get_contents("host.txt");
$username=file_get_contents("username.txt");
$password=file_get_contents("password.txt");
$database=file_get_contents("database.txt");

$con=mysqli_connect($host,$username,$password,$database);

// Check connection
if (mysqli_connect_errno ()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error ();
}

 $user_id1=$_POST[userid];
 $password1=$_POST[password];
 $requestip=$_SERVER[REMOTE_ADDR];

//$user_id1 = "d0002";
//$password1 = "mk123";
//$requestip = "192.168.24.54";

// echo $user_id1;
// echo $password1;

// CHECKING LOGIN FOR ADMIN

$verifyadmin = "SELECT * FROM admin_table where admin_id = '" . $user_id1 . "'";

$adminresult = mysqli_query ( $con, $verifyadmin );

while ( $newadmin = mysqli_fetch_assoc ( $adminresult ) ) {
	$user_id2 = $newadmin ['admin_id'];
	$password2 = $newadmin ['password'];
	$role2 = $newadmin ['role'];
	$user_name2 = $newadmin ['admin_name'];
	break;
}

if (strcmp ( $user_id2, $user_id1 ) == 0) {
	
	if (strcmp ( $password2, $password1 ) == 0) {
		
		session_start ();
		
		$_SESSION ['role'] = $role2;
		$_SESSION ['id'] = $user_id2;
		$_SESSION ['name'] = $user_name2;
		
		echo "Welcome, " . $_SESSION ['name'] . "!";

		exit ();
	} else {
		echo "Incorrect Password";
	}
}

// CHECKING USER IF ADMIN LOGIN FAILS

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

if (strcmp ( $user_id2, $user_id1 ) == 0) {
	
	if (strcmp ( $password2, $password1 ) == 0) {
		
		$startaddrquery = "SELECT ip_add_start_range FROM company where company_id = '" . $company_id2 . "'";
		
		while ( $new = mysqli_fetch_array ( mysqli_query ( $con, $startaddrquery ) ) ) {
			$startaddr = $new ['ip_add_start_range'];
			break;
		}
		
		$endaddrquery = "SELECT ip_add_end_range FROM company where company_id = '" . $company_id2 . "'";
		
		while ( $new = mysqli_fetch_array ( mysqli_query ( $con, $endaddrquery ) ) ) {
			$endaddr = $new ['ip_add_end_range'];
			break;
		}
		
		$ipcmp1 = strcmp ( $requestip, $startaddr );
		
		$ipcmp2 = strcmp ( $endaddr, $requestip );
		
		if ($ipcmp1 >= 0 && $ipcmp2 >= 0) {
			session_start (); // add session_destroy() in logout page.
			
			$_SESSION ['role'] = $role2;
			$_SESSION ['id'] = $user_id2;
			$_SESSION ['name'] = $user_name2;
			$_SESSION ['company'] = $company_id2;
			
			echo "Welcome, " . $_SESSION ['name'] . "!";

			//session_destroy ();
		} 

		else {
			echo "Invalid IP Address.";
			// echo '<br>';
		}
	} else {
		echo "Incorrect Password";
	}
} 

else {
	echo "User does not exist";
}
mysqli_close ( $con );

?>