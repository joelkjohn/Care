<?php 
  include 'navbar.php';
  $userId = $_SESSION['Userid'];
  
  $Quoteid = $_GET['id'];
  $QComment = mysqli_real_escape_string($con, $_REQUEST['comment']);

  $query = "INSERT INTO QCOMMENTS(QComment, Userid, Quoteid) VALUES ('$QComment', '$userId', '$Quoteid');";
  $sql = mysqli_query($con, $query);

  header('location:qcommpage.php?id='.$Quoteid);
?>