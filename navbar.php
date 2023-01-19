<?php
	include 'dbconnection.php'; 
	include_once 'header.php';

?>
<body>
    

<nav id="navigation" class="navbar navbar-dark navbar-expand-md px-5 fixed-top">
    <img src="images/unnamed.png" style="width: 30px;">
    <?php 
        if(session_status() == PHP_SESSION_ACTIVE){
            if ($_SESSION['Userid'] != 1){
                echo'
                <a href="main.php" class="navbar-brand mx-2">CARE</a>
                ';
            }
            
            else {
                echo'
                <a href="adminui.php" class="navbar-brand mx-2">CARE</a>
                ';
            }
            

        }
    
    ?>
    
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navLinks">
        <ul class="navbar-nav">
            <?php
                if (session_status() == PHP_SESSION_ACTIVE){
                    if ($_SESSION['Userid'] != 1) {
                        echo'
                            <li class="nav-item ">
                                <a class="nav-link" href="chatui.php">CHATBOT</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="journal.php">JOURNAL</a>
                            </li>
                        ';
                    }
                }
            
            
            ?>
            <li class="nav-item ">
                <a class="nav-link" href="video.php">VIDEOS</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="quotes.php">QUOTES</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i>
                    Your Account
                </a>
                <ul class="dropdown-menu nav-item" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    <?php echo'<li><a class="dropdown-item" href="viewacc.php?id='.$_SESSION['Userid'].'">View Account Details</a></li>'; ?>
                </ul>
            </li>


            
       


        </ul>
    </div>


</nav>


