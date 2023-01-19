<?php

include 'dbconnection.php';

$id = $_GET['id'];

$del = mysqli_query($con,"DELETE FROM SPECIFICQUOTES WHERE Quoteid = '$id'"); 

if($del)
{
	header("location:quotes.php");
    exit;	
}
else
{
    echo "Error deleting record";
}
?>