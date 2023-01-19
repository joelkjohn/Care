<?php

include 'navbar.php';
?>


	<div class="row">
	<div class="my-5 mx-5 d-flex justify-content-start">
                
				<a class="btn btn-outline-dark btn-lg" href="adminui.php">BACK</a>
			</div>
	    <h1 class="text-center py-5">ADD A QUOTE</h1>
	    <div class="col-md-6 offset-md-3">
	        <form action="addquote.php" method="post">
				<div class="form-group">

                    <div class="my-3 form-group">
                        <label> Title</label>
                        <input type="qtitle" name="qtitle" class="form-control" required>
				    </div>

                    <div class="my-3 form-group">
                        <label> Link</label>
                        <input type="qlink" name="qlink" class="form-control" required>
				    </div>
                    




					<label>Theme:</label>
					<select name="theme[]" size=3 multiple="multiple" class="form-control" required>
						<?php

							$query1 = mysqli_query($con, "SELECT * FROM quotes;");
							while($row = mysqli_fetch_array($query1)){
								echo '<option value='. $row['Quotetypeid'] .'>'.$row['theme'].'</option>';
								
							}
							

						?>
					</select>


					<div class= text-center><br>
						<button type="submit" class="btn btn-success">ADD</button>
                	</div>

				</div>
		 	 	</div>