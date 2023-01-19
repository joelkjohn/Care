<?php

include 'dbconnection.php';

$id = $_GET['id'];

$del = mysqli_query($con,"DELETE FROM SPECIFICVIDEOS WHERE Videoid = '$id'"); 

if($del)
{
	header("location:video.php");
    exit;	
}
else
{
    echo "Error deleting record";
}
?>