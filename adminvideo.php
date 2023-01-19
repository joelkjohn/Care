<?php

include 'navbar.php';
?>


	<div class="row">
	<div class="my-5 mx-5 d-flex justify-content-start">
                
				<a class="btn btn-outline-dark btn-lg" href="adminui.php">BACK</a>
			</div>
	    <h1 class="text-center py-5">ADD A VIDEO</h1>
	    <div class="col-md-6 offset-md-3">
	        <form action="addvideo.php" method="post">
				<div class="form-group">

                    <div class="my-3 form-group">
                        <label> Title</label>
                        <input type="vtitle" name="vtitle" class="form-control" required>
				    </div>

                    <div class="my-3 form-group">
                        <label> Link</label>
                        <input type="vlink" name="vlink" class="form-control" required>
				    </div>
                    




					<label>Genre:</label>
					<select name="genre[]" size=3 multiple="multiple" class="form-control" required>
						<?php

							$query1 = mysqli_query($con, "SELECT * FROM videos;");
							while($row = mysqli_fetch_array($query1)){
								echo '<option value='. $row['Videotypeid'] .'>'.$row['genre'].'</option>';
								
							}
							

						?>
					</select>


					<div class= text-center><br>
						<button type="submit" class="btn btn-success">ADD</button>
                	</div>

				</div>
		 	 	</div>

