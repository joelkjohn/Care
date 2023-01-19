<?php

include 'navbar.php';
$prev = $_SESSION['currentJournal'];

$id = $_GET['id'];

$del = mysqli_query($con,"DELETE FROM entries WHERE entryId = '$id'"); 

if($del)
{
	header("location:type.php?id={$prev}");
    exit;	
}
else
{
    echo "Error deleting record";
}
?>