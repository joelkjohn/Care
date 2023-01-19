<?php

include 'navbar.php';
?>



<div id="journal" class="journal-image p-5" style="min-height: 100vh;">
      <div id="journaltext" class="mt-5 journal-text">
        <h1>Admin Home</h1>
        <p>Upload or Remove</p>
      </div>
      <div class="row d-flex justify-content-center mt-5 pb-5 mb-5">
        <div class="col-lg-3 col-xs-12 mt-5 mb-5">
          <a href="adminvideo.php" class="btn btn-lg btn-secondary gbox">
            <p style="margin-top: 15%; font-size: 80%;">Add Video</p>
          </a>
        </div>
        <div class="col-lg-3 col-xs-12 mt-5 mb-5">
          <a href="adminquote.php" class="btn btn-lg btn-secondary gbox">
            <p style="margin-top: 15%; font-size: 80%;">Add Quotes</p>
          </a>
        </div>
      </div>
</div>

<?php include 'footer.php'; ?>






