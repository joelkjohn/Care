<?php 

    include 'navbar.php';

    $userMsg = (array_key_exists('userMessage', $_POST)) ? $_POST['userMessage'] : " ";
    array_push($_SESSION['me'], $userMsg);
    $msg = str_replace(' ', '_',$userMsg);

    $responseLink = "http://127.0.0.1:5000/?message=".$msg;

    $curl_handle=curl_init();
    curl_setopt($curl_handle,CURLOPT_URL,$responseLink);
    curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
    curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
    $botResponse = curl_exec($curl_handle);
    curl_close($curl_handle);
    if (empty($botResponse)){
        // print "Nothing returned from url";
    }
    else{
        array_push($_SESSION['sarah'], $botResponse);
    }
    
?>

<div id="chat" class="chat-image p-5" style="min-height: 100vh;">
      <div style = "text-align:center" id="chattext" class="mt-5 chat-text">
      <h1>Sarah</h1>
        <p>Begin with a HI.</p>
      </div>



    <div class="container pt-3 mt-5">
        <div class="container px-3 pb-2 w-50" style="height: 75vh; overflow-y:scroll; background-color: #aba082;border-style: outset;">
        <?php
            if(sizeof($_SESSION['me']) > 1){
            for ($i = 1; $i < sizeof($_SESSION['me']); $i++){
                echo '
                    <div class="row d-flex justify-content-end">
                        <div class="border rounded col-5 px-4 pt-2">
                            <p>You: '.$_SESSION['me'][$i].'</p>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="border rounded col-5 px-4 pt-2">
                            <p>Sarah: '.$_SESSION['sarah'][$i].'</p>
                        </div>
                    </div>';
            }}
        ?>
        </div>
        <div class="container mt-3 px-1 w-50">
            <form class="d-flex mt-2" method="post" action="">
                <input class="form-control form-control-lg" type="text" placeholder="Write a message" name="userMessage">
                <button type="submit" class="mx-3 btn btn-primary"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php';?>