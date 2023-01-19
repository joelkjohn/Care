<?php 
  include 'navbar.php';

  $userId = $_SESSION['Userid'];

  $sql1 = mysqli_query($con, "SELECT * FROM Videos;");

  $_SESSION['vfilter'];

  if (!empty($_SESSION['vfilter'])) {
    $sql2 = mysqli_query($con, $_SESSION['vfilter']);
  } else {
    $sql2 = mysqli_query($con, "SELECT DISTINCT Videoid, vlink, vtitle FROM SPECIFICVIDEOS;");
  }


?>

    <div id="video" class="video-image p-5" style="min-height: 100vh;">
        <div style ="color:white" id="videotext" class="mt-5 video-text">
            <h1>VIDEOS FOR YOU</h1>
            <p>Something inspirational.</p>
        </div>
        <div class="container">
            <form action="filtervideo.php" method="post">
                <div class="row">
                    <div style ="color:white;" class="col-2">
                        <h4>Categories:</h4>
                    </div>
                    <div class="col-2">
                        <select name="genre[]" size=3 multiple="multiple" class="form-control" required>
                            <?php
                                while($row1 = mysqli_fetch_array($sql1)){
                                    echo '<option value='. $row1['Videotypeid'] .'>'.$row1['genre'].'</option>';
                                    
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-3 pt-3">
                        <button type="submit">Filter</button>
                    </div>
                </div>
            
            </form>
        </div>
        
        <h3  style= "color:white" class = "mt-3 rec">Recommended for you</h3>
        <div class="row d-flex justify-content-evenly mb-5" style="overflow-y: scroll; height: 55vh; width:100%;">
            <?php
                while($row2 = mysqli_fetch_array($sql2)){
                    echo '<div class="col-md-3 col-xs-12 my-4 mx-2">';
                    echo '<a href="vcommpage.php?id='.$row2['Videoid'].'">';
                    echo '<p>'.$row2['vtitle'].'</p>';
                    if (session_status() == PHP_SESSION_ACTIVE){
                        if ($_SESSION['Userid'] == 1) {
                            echo'
                                <div class="row">
                                    <div class="col-3 mb-3">
                                        <a href="deletevideo.php?id='.$row2['Videoid'].'" class="btn btn-lg btn-danger">DELETE </a>
                                    </div>
                                </div>';
                        }
                    }
                    echo '<iframe width="400" height="300" '.$row2['vlink'].'</a></div>';
                }
            ?>
        </div>
    </div>

<?php
include 'footer.php';
?>