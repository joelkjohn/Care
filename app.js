class Chatbox{
    constructor(){
        this.args={
        openButton: document.querySelector('.chatbox__button'),
        chatBox: document.querySelector('.chatbox__support'),
        sendButton: document.querySelector('.chatbox__button')
        }

        this.state = false;
        this.responses = [];
    }   

    display() {
        const {chatBox, sendButton} = this.args;

        sendButton.addEventListener('click', () => this.onSendButton(chatBox))

        const node = chatBox.querySelector('input');
        node.addEventListener("keyup", ({key}) =>{
            if(key === "Enter"){
                this.onSendButton(chatBox)
            }
        })
    }


    // toggleState(chatbox) {
    //     this.state = !this.state;

    // }

    onSendButton(chatBox) {
        var textField = chatBox.querySelector('input');
        let text1 = textField.value
        if (text1 === "") {
            return;
        }


        let msg1 = {name:"User", responses:text1}
        this.responses.push(msg1);


        fetch($SCRIPT_ROOT + '/predict', {
            method: 'POST',
            body: JSON.stringify({responses:text1}),
            node: 'cors',
            headers: {
                'Content-Type' : 'application/json'
            },


        })

        .then(r => r.json())
        .then(r => {

            let msg2 = {name: "Sarah", responses: r.answer};
            this.responses.push(msg2);
            this.updateChatText(chatBox)
            textField.value=''

        }).catch((error) =>{
            console.error('Error:', error);
            this.updateChatText(chatBox)
            textField.value=''

        });


    }

    updateChatText(chatBox){
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

        const chatmessage = chatBox.querySelector('messages');
        chatmessage.innerHTML = html;
    }
 

}

const chatbox = new Chatbox();
chatbox.display();



    
