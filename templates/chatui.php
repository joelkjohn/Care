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
</head>

<?php
    session_start();
?>
<body>
<nav id="navigation" class="navbar navbar-dark navbar-expand-md px-5 fixed-top">
    <img src="unnamed.png" style="width: 30px;">
    
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navLinks" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navLinks">
        <ul class="navbar-nav">
                            <li class="nav-item ">
                                <a class="nav-link" href="http://127.0.0.1:5000/">CHATBOT</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="http://localhost/fyp%20new/journal.php">JOURNAL</a>
                            </li>
            <li class="nav-item ">
                <a class="nav-link" href="http://localhost/fyp%20new/video.php">VIDEOS</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="http://localhost/fyp%20new/quotes.php">QUOTES</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-user"></i>
                    Your Account
                </a>
                <ul class="dropdown-menu nav-item" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="http://localhost/fyp%20new/logout.php">Logout</a></li>
                    <li><a class="dropdown-item" href="http://localhost/fyp%20new/viewacc.php">View Account Details</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="chatbox container mt-5 pt-3">
    <div class="chatbox">
        <div class="chatbox__support">
            <div class="chatbox__header">
                Chat support!
            </div>
            <div class="chatbox__messages">
                <div>
                    <div class="messages__item messages__item--visitor">
                        Hi!
                    </div>
                    <div class="messages__item messages__item--operator">
                        What is it?
                    </div>
                    .<div class="messages__item messages__item--typing">
                        <span class="messages__dot"></span>
                        <span class="messages__dot"></span>
                        <span class="messages__dot"></span>
                    </div>
                </div>
            </div>
            <div class="chatbox__footer">
                <input type="text" placeholder="Write a message">
            </div>
        </div>
        <div class="chatbox__button">
            <button>Send</button>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>

    class Chatbox{
        constructor(){
            this.args={
                openButton: document.querySelector('.chatbox__button'),
                chatBox: document.querySelector('.chatbox__support'),
                sendButton: document.querySelector('.chatbox__button')
            }

            this.state = false;
            this.messages = [];
        }   

        display() {
            const {openButton, chatBox, sendButton} = this.args;
            
            sendButton.addEventListener('click', () => this.onSendButton(chatBox))

            const node = chatBox.querySelector('input');
            node.addEventListener("keyup", ({key}) =>{
                if(key === "Enter"){
                    this.onSendButton(chatBox)
                }
            })
        }

        onSendButton(chatBox) {
            var textField = chatBox.querySelector('input');
            let text1 = textField.value
            if (text1 === "") {
                return;
            }

            let msg1 = {name:"You", message:text1}
            this.messages.push(msg1);

            fetch('http://127.0.0.1:5000/predict', {
                method: 'POST',
                body: JSON.stringify({message:text1}),
                node: 'cors',
                headers: {
                    'Content-Type' : 'application/json'
                },
            })
            .then(r => r.json())
            .then(r => {

                let msg2 = {name: "Sarah", message: r.answer};
                console.log(msg2)
                this.messages.push(msg2);
                this.updateChatText(chatbox)
                textField.value=''

            }).catch((error) =>{
                console.error('Error:', error);
                this.updateChatText(chatbox)
                textField.value=''

            });
        }

        updateChatText(chatbox){
            var html ='';
            this.responses.slice().reverse().forEach(function(item, index){
                if(item.name == "Sarah")
                {
                    html += '<div class = "messages__item messages__item--visitor">' + item.message + '</div>'

                }

                else

                {
                    html += '<div class = "messages__item messages__item--operator">' + item.message + '</div>'

                }

            });

            const chatmessage = chatbox.querySelector('.chatbox__messages');
            chatmessage.innerHTML = html;
        }
    

    }

    const chatbox = new Chatbox();
    chatbox.display();



    




    

</script>
</html>