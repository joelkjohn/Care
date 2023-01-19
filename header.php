<html>
	
	<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FYP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/fc02d9dcbb.js" crossorigin="anonymous"></script>

    <script language="JavaScript" type="text/javascript">
        function checkDelete(){
            return confirm('Are you sure?');
        }
    </script>

        <style>
            .chat-image {
                background-image: url("images/chatbackground.webp");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
                border-bottom: #0f0f0f;
            }

            .chat-text{
                text-align: center;
                color:white;
            }

        </style>

    </head>

<?php
    session_start();
?>