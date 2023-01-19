<?php 
  include 'navbar.php';
  $id = $_GET['id'];
  $userId = $_SESSION['Userid'];
  $_SESSION['currentJournal'] = $id;

  $query = "SELECT * from Entries
            WHERE Journalid = '$id'
            ORDER BY entryId DESC;";

  $sql = mysqli_query($con, $query);
?>
    <div id="journal" class="journal-image p-5" style="min-height: 100vh;">
      <div id="journaltext" class="mt-5 journal-text">
      
      
<div class = "type">
    <h1 style ="font-size:20pt">Type Away!</h1>
    <div class="row justify-content-end">
        <div class="col-4">
		    <?php echo '<a class="btn btn-lg btn-danger" onclick="return checkDelete()" href= deljournal.php?id='.$id.'>Delete</a>';?>
        </div>
        <?php echo '<form action="newentry.php?id='.$id.'" method="post">'; ?>
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <label for="jtitle">Title:</label>
                        <input placeholder= "Enter a title!" type="text" id="jtitle" name="jtitle" class="form-control"><br><br>
                    </div>
                </div>
                
                <textarea  placeholder="Enter your journal here!" id="jinput" name="jinput" class="form-control" rows="4" cols="200"></textarea><br>

                <button id= "save" type="submit" class="btn btn-lg btn-success">Submit</button>
            </div>
         
        </form>
    </div>
    <div class="container">
    <?php
        while($row = mysqli_fetch_array($sql)){
          echo '
        <div style = "background:#aba082;border-style: outset;" class="row border">
            <div class="col-4 justify-content-end">
                <a class="btn btn-lg btn-success" href="jedit.php?id='.$row['entryId'].'"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                <a class="btn btn-lg btn-danger" onclick="return checkDelete()" href="jdel.php?id='.$row['entryId'].'"><i class="fa-solid fa-trash"></i> Delete</a>
            </div>
            <h1 class="h1">'.$row['entryTitle'].'</h1>
            <p>'.$row['jcontent'].'</p>
        </div>';}
        ?>
    </div>
</div>

<?php
include 'footer.php';
?>