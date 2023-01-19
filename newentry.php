<?php
include 'dbconnection.php'; 
include_once 'header.php';

$id = $_GET['id'];

$jtitle = mysqli_real_escape_string($con, $_REQUEST['jtitle']);
$jinput = mysqli_real_escape_string($con, $_REQUEST['jinput']);

$query = "INSERT INTO Entries(Journalid, entryTitle, jcontent)
VALUES('$id', '$jtitle', '$jinput');";

$sql = mysqli_query($con, $query);
header('location:type.php?id='.$id);
?>