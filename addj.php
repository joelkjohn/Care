<?php 
  include 'navbar.php';
  $userId = $_SESSION['Userid'];
  $jtitle = mysqli_real_escape_string($con, $_REQUEST['jtitle']);

  $query = "INSERT INTO JOURNAL(jtitle, Userid, jdate) VALUES ('$jtitle', '$userId', CURRENT_TIMESTAMP);";

  $sql = mysqli_query($con, $query);
  header('location:journal.php');
?>