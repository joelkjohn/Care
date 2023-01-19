
<?php 
	include 'dbconnection.php'; 
	include_once 'header.php';
?>


<body>
		<div id="about" class="hero-image">
			<div id="aboutext" class="hero-text">
				<h4>CARE</h4>
		
			
		</div>
		<div class="container  px-5" style= "color:white;margin-top:5%;">
		<div class="d-flex justify-content-start">
                
				<a class="btn btn-outline-dark btn-success" href="login.php">BACK</a>
			</div>
			<h2 class = text-center>Create An Account</h2>
			<form style="width:30%;margin-left:auto;margin-right:auto;" action="newusereval.php" method="post">
				<div class="my-3 form-group">
					<label>Username</label>
					<input type="username" name="username" class="form-control" required>
				</div>
				<div class="my-3 form-group">
					<label>Password:</label>
					<input type="password" name="userpassword" class="form-control" required>
				</div>

                <div class= text-center><br>
				<button type="submit" class="btn btn-secondary">Register</button>
                </div>
			</form>
		</div>
	</body>

</html>