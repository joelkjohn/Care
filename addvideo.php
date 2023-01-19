<?php 
  include 'navbar.php';
  $userId = $_SESSION['Userid'];
  $vtitle = mysqli_real_escape_string($con, $_REQUEST['vtitle']);
  $vlink = mysqli_real_escape_string($con, $_REQUEST['vlink']);

  $tbLen = 0;
  $sql1 = mysqli_query($con, "SELECT Videoid FROM SPECIFICVIDEOS;");
  while($row1 = mysqli_fetch_array($sql1)){
    $tbLen = $row1['Videoid'];
  }

  $tbLen = (int)$tbLen +1;

  $query = "INSERT INTO SPECIFICVIDEOS(Videoid, vtitle, vlink) VALUES ('$tbLen', '$vtitle', '$vlink');";

  $sql = mysqli_query($con, $query);


  $genre = $_POST['genre'];
  foreach ($genre as $g) {
    $reg = "INSERT INTO VIDEOMAPPING (Videotypeid, Videoid)
        VALUES($g, $tbLen);";
    $insert = mysqli_query($con, $reg);
    if ($insert) {
        echo 'DONE';
    } else {
        echo mysqli_error($con);
    }
}
	$_SESSION['vfilter'] = NULL;
  header('location:video.php');
?>