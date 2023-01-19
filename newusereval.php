<?php

include 'dbconnection.php';
include 'header.php';

$Username = mysqli_real_escape_string($con, $_REQUEST['username']);
$Userpassword = mysqli_real_escape_string($con, $_REQUEST['userpassword']);


$sql = "SELECT * FROM Users
		WHERE username = '$Username'";

$result = mysqli_num_rows(mysqli_query($con, $sql));

if($result == 1) {
	echo "An account with this username already exists!";
} else {

	$reg = "INSERT INTO Users (username, userpassword) 
			VALUES ('$Username','$Userpassword');";

	$insert = mysqli_query($con, $reg);
	
	if ($insert) {
		header('location:login.php');
	} else {
		echo mysqli_error($con);
	};
};
?>