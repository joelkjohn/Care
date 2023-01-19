<?php

include 'dbconnection.php';
$_SESSION['currentJournal'];

$id = $_GET['id'];

$del = mysqli_query($con,"DELETE FROM Journal WHERE Journalid = '$id'"); 

if($del)
{
	header("location:journal.php?id=".$_SESSION['currentJournal']);
    exit;	
}
else
{
    echo "Error deleting record";
}
?>