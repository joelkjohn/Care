<?php 
  include 'navbar.php';
  $userId = $_SESSION['Userid'];
  $qtitle = mysqli_real_escape_string($con, $_REQUEST['qtitle']);
  $qlink = mysqli_real_escape_string($con, $_REQUEST['qlink']);
  $theme = $_POST['theme'];

  $tbLen = 0;
  $sql1 = mysqli_query($con, "SELECT Quoteid FROM SPECIFICQUOTES;");
  while($row1 = mysqli_fetch_array($sql1)){
    $tbLen = $row1['Quoteid'];
  }
  $tbLen = (int)$tbLen +1;

  $query = "INSERT INTO SPECIFICQUOTES(Quoteid, qtitle, qlink) VALUES ('$tbLen', '$qtitle', '$qlink');";
  $sql = mysqli_query($con, $query);
  foreach ($theme as $g) {
    $reg = "INSERT INTO QUOTEMAPPING (Quotetypeid, Quoteid)
        VALUES($g, $tbLen);";
    $insert = mysqli_query($con, $reg);
    if ($insert) {
        echo 'DONE';
    } else {
        echo mysqli_error($con);
    }
}
  $_SESSION['qfilter'] = NULL;
  header('location:quotes.php');
?>