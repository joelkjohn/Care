<?php 

    include 'navbar.php';
    $id = $_GET['id'];

    $query = "SELECT Vdate, username, VComment, VCommentid from VCOMMENTS
                JOIN USERS on USERS.Userid=VCOMMENTS.Userid
            WHERE Videoid = '$id'
            ORDER BY Vdate DESC;";

    $sql = mysqli_query($con, $query);

    $sql1 = mysqli_query($con, "SELECT * FROM SPECIFICVIDEOS WHERE Videoid = '$id';");
?>
    <div id="video" class="video-image p-5" style="min-height: 100vh;">
        <div style ="color:white" id="videotext" class="mt-5 video-text">

<div class="container mt-5 pt-1">
        <?php
        while($row2 = mysqli_fetch_array($sql1)){
            echo '
            <h2>'.$row2['vtitle'].'</h2>
    <div class="d-flex justify-content-center mt-5">
        <iframe width="400" height="300" '.$row2['vlink'].'</iframe></div>';}
    ?>
    
    <?php echo '<form style="width:30%;margin-left:auto;margin-right:auto;" class="d-flex" action="addvcomment.php?id='.$id.'" method="post">'; ?>
		<div class="my-3 form-group">
			<label>Comment</label>
			<input type="comment" name="comment" class="form-control" required>
		</div>

        <div class="text-right mx-5 mt-4">
			<button type="submit" class="mt-3 btn btn-success">Post</button>
        </div>
    </form>
        <?php
        while($row = mysqli_fetch_array($sql)){
            echo '
    <div class="container" style="width:40%;margin-left:auto;margin-right:auto; border-style: outset; border-width: 5px; border-color:white; background: #aba082;">
        <div class="row">
            <div class="col-9"><h4>'.$row['username'].'</h4></div>
            <div class="col-3"><p>'.$row['Vdate'].'</p></div>
            <p class="px-4 pt-4 pb-2">'.$row['VComment'].'</p>
        </div>

    </div>';}?>
</div>

<?php include 'footer.php'; ?>