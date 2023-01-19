<?php


include 'navbar.php';

$id = $_SESSION['Userid'];
$query = mysqli_query($con, "SELECT * FROM Users WHERE Userid = '$id'");
$row = mysqli_fetch_array($query);

$queryl = mysqli_query($con, "SELECT * FROM Users WHERE Userid = '$id'");
$rowl = mysqli_fetch_array($queryl);

?>

<div >
	<div class="container my-5">
        
		<div class="my-5 mx-5 d-flex justify-content-start">
                
				<a class="my-5 btn btn-outline-dark btn-lg" href="main.php">BACK</a>
			</div>
	    <h1 class="text-center">Your Profile</h1>
	    <div class="col-md-6 offset-md-3">
	        <?php echo'<form action="accupdate.php?id='.$id.'" method="post">'; ?>

                <div class="form-group">
					<label>Username:</label>
					<input type="text" name="username" class="form-control" value="<?php echo $row['username'];?>" required>
				</div>

				<div class="form-group">
					<label>Password:</label>
					<input type="text" name="userpassword" class="form-control" value="<?php echo $row['userpassword'];?>" required>
				</div>

	            <div class="my-3">
	                <button type="submit" class="btn btn-success btn-lg">Update!</button>
	            </div>
	        </form>
	    </div>
	</div>
<?php
include 'footer.php';
?>