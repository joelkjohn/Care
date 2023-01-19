<?php

    include 'navbar.php';
    $userInput = mysqli_real_escape_string($con, $_REQUEST['chat']);
    $output = shell_exec('python test.py '. $userInput);
    $_SESSION['chatLi'] = $output;

    echo '<p>'.$_SESSION['chatLi'].'</p>';

    if(empty($_SESSION['chatLi'])){
        echo 'empty';
    }

    // header('location:chatbotui.php');
    
    
?>