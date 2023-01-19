<?php


include 'navbar.php';
$id = $_SESSION['Userid'];

$username = mysqli_real_escape_string($con, $_REQUEST['username']);
$userpassword = mysqli_real_escape_string($con, $_REQUEST['userpassword']);



$reg =	"UPDATE users
		SET username='$username', userpassword='$userpassword' WHERE Userid = '$id';";


$insert = mysqli_query($con, $reg);
if ( $insert) {
	echo "Details Updated!";
	header('location:main.php');
} else {
	echo mysqli_error($con);
};
?>