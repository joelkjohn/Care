<?php

	include 'dbconnection.php'; 
	include_once 'header.php';

include 'dbconnection.php';

$Username = mysqli_real_escape_string($con, $_REQUEST['username']);
$Userpassword = mysqli_real_escape_string($con, $_REQUEST['userpassword']);

$sql = "SELECT * FROM Users 
		WHERE username = '$Username' && userpassword = '$Userpassword'";

$result = mysqli_num_rows(mysqli_query($con, $sql));

if($result == 1) {
	$query = mysqli_query($con, "SELECT * FROM Users WHERE username = '$Username'");
	$row = mysqli_fetch_array($query);
	$_SESSION['Userid'] = $row['Userid'];
	$_SESSION['user'] = 'User';
	$_SESSION['vfilter'] = NULL;
	$_SESSION['qfilter'] = NULL;
	$_SESSION['chatLi'] = [];
	$_SESSION['me'] = [];
	$_SESSION['sarah'] = [];
	if ($_SESSION['Userid'] == 1) {
		header('location:adminui.php');
	} else {
		header('location:main.php');
	}

} else {
	echo "<h3>Invalid Login Information</h3>";
    echo '<a style= "text-align:center"href="login.php" class="btn btn-lg btn-success">re-enter login details</a>';
}
?>