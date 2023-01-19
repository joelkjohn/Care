<?php


include 'navbar.php';
$id = $_GET['id'];
$jID = $_SESSION['currentJournal'];

$entryTitle = mysqli_real_escape_string($con, $_REQUEST['jtitle']);
$jcontent = mysqli_real_escape_string($con, $_REQUEST['jinput']);



$reg =	"UPDATE entries
		SET entryTitle='$entryTitle', jcontent='$jcontent' WHERE Journalid = '$jID';";


$insert = mysqli_query($con, $reg);
if ( $insert) {
	echo "Details Updated!";
	header('location:type.php?id='.$jID);
} else {
	echo mysqli_error($con);
};
?>