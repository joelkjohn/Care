<?php 
  include 'navbar.php';
?>

<div id="journal" class="journal-image p-5" style="min-height: 100vh;">
    <div id="journaltext" class="mt-5 journal-text">
        <h1>YOUR JOURNAL</h1>
        <p>For you to keep track of your journey in life.</p>
    </div>

    <div class="container text-center">
    <?php echo '<form action="addj.php?id=" method="post">'; ?>
        <div class="container">
            <div class="row">
                <div class="col-2 mt-5 col-md-6 offset-md-3 ms-5">
                    <label style= color:white;font-size:1.5rem; for="jtitle">Title:</label>
                    <input type="text" id="jtitle" name="jtitle" class="form-control"><br><br>
                </div>
            </div>
            <button class="btn btn-success btn-lg" type="submit">CREATE NEW JOURNAL</button> 
    </form>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>