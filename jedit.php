<?php 
  include 'navbar.php';
  $id = $_GET['id'];
  $userId = $_SESSION['Userid'];

  $query = "SELECT * from Entries WHERE entryId = '$id';";
            

$sql = mysqli_query($con, $query);
$row = mysqli_fetch_array($sql);


?>        
 <div id="journal" class="journal-image p-5" style="min-height: 100vh;">
      <div id="journaltext" class="mt-5 journal-text">
 
<div class="container mt-5">
    <div class="row justify-content-end mt-5 pt-5">
        <?php echo'<form action="updatentry.php?id='.$id.'" method="post">';?>
                <div class="container">
                    <div class="ow justify-content-end">
                        <div class="col-2">
                            <label for="jtitle">Title:</label>
                            <input type="text" id="jtitle" name="jtitle" class="form-control" value="<?php echo $row['entryTitle'];?>"><br><br>
                        </div>
                    </div>
                    
                    <textarea id="jinput" name="jinput" class="form-control" rows="4" cols="200"><?php echo $row['jcontent'];?></textarea><br>

                    <button id= "save" type="submit" class="btn btn-lg btn-success">Submit</button>
                </div>
            
            </form>
        
    </div>
</div>
</div>

<?php
include 'footer.php';
?>