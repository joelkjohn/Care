<?php 
  include 'navbar.php';
  $userId = $_SESSION['Userid'];

  $sql1 = mysqli_query($con, "SELECT * FROM Quotes;");

  if (!empty($_SESSION['qfilter'])) {
    $sql2 = mysqli_query($con, $_SESSION['qfilter']);
  } else {
    $sql2 = mysqli_query($con, "SELECT DISTINCT Quoteid, qtitle, qlink FROM SPECIFICQUOTES;");
  }

?>

    <div id="video" class="video-image p-5" style="min-height: 100vh;">
        <div style="color:white" id="videotext" class="mt-5 video-text">
            <h1>QUOTES</h1>
            <p>Something inspirational.</p>
        </div>
        <div class="container">
            <form action="filterquote.php" method="post">
                <div class="row">
                    <div style= "color:white" class="col-2">
                        <h4>Categories:</h4>
                    </div>
                    <div class="col-2">
                        <select name="theme[]" size=3 multiple="multiple" class="form-control" required>
                            <?php
                                while($row1 = mysqli_fetch_array($sql1)){
                                    echo '<option value='. $row1['Quotetypeid'] .'>'.$row1['theme'].'</option>';
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
        
        <h3 style= "color:white"class = "mt-3 rec">Recommended for you</h3>
        
        <div class="row d-flex justify-content-evenly mb-5" style="overflow-y: scroll; height: 55vh; width:100%;">
            <?php
                while($row2 = mysqli_fetch_array($sql2)){
                    echo '<div class="col-3 mt-5 mb-5">';
                    echo '<a href="qcommpage.php?id='.$row2['Quoteid'].'">';
                    if (session_status() == PHP_SESSION_ACTIVE){
                        if ($_SESSION['Userid'] == 1) {
                            echo'
                                <div class="row">
                                    <div class="col-3 mb-3">
                                        <a href="deletequote.php?id='.$row2['Quoteid'].'" class="btn btn-lg btn-danger">DELETE </a>
                                    </div>
                                </div>

                            ';
                        }
                    }   
                    echo'<img style="width: 100%;" src="'.$row2['qlink'].'"></a></div>';
                }
            ?>
        </div>

<?php
include 'footer.php';
?>