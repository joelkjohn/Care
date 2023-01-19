<?php 
  include 'navbar.php';

  $userId = $_SESSION['Userid'];

  $query = "SELECT * from Journal
            WHERE Userid = '$userId';";

  $sql = mysqli_query($con, $query);

?>

    <div id="journal" class="journal-image p-5" style="min-height: 100vh;">
      <div id="journaltext" class="mt-5 journal-text">
        <h1>YOUR JOURNAL</h1>
        <p>For you to keep track of your journey in life.</p>
      </div>
      <div class="row d-flex justify-content-evenly mt-5 py-5 mx-5 px-5 ">
      <div class="col-md-3 col-xs-12 my-4 mx-2">
          <a href="newjournal.php" class="btn btn-lg btn-secondary gbox">
            <p style="margin-top: 20%;">+</p>
          </a>
        </div> 
        <?php
        while($row = mysqli_fetch_array($sql)){
          echo '
          <div class="col-md-3 col-xs-12 my-4 mx-2">
          <a href="type.php?id='.$row['Journalid'].'" class="btn btn-lg btn-secondary gbox">
            <p style="margin-top: 20%;">'.$row['jtitle'].'</p>
          </a>
        </div>';}
        ?>
      </div>
    </div>

<?php
include 'footer.php';
?>