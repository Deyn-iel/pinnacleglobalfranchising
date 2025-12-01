<!-- Floating Chat Button -->
<div id="chat-button">💬</div>

<!-- Chatbox Window -->
<div id="chatbox">
    <div id="chat-header">
        <span>Message Pinnacle</span>
        <button id="close-chat">×</button>
    </div>

    <div id="chat-messages"></div>
    <div id="typing-indicator" style="display:none;">
    <div class="typing">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</div>


    <div id="chat-input">
        <input type="text" id="chat-text" placeholder="Type a message...">
        <button id="send-btn">➤</button>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const chatButton = document.getElementById("chat-button");
    const chatBox = document.getElementById("chatbox");
    const closeChat = document.getElementById("close-chat");
    const sendBtn = document.getElementById("send-btn");
    const chatText = document.getElementById("chat-text");
    const chatMessages = document.getElementById("chat-messages");
    const typingIndicator = document.getElementById("typing-indicator");

    // OPEN CHATBOX
    chatButton.addEventListener("click", () => {
        chatBox.style.display = "flex";
    });

    // CLOSE CHATBOX
    closeChat.addEventListener("click", () => {
        chatBox.style.display = "none";
    });

    // SEND MESSAGE
    sendBtn.addEventListener("click", sendMessage);

    // ENTER KEY TO SEND
    chatText.addEventListener("keypress", function (e) {
        if (e.key === "Enter") sendMessage();
    });

    function sendMessage() {
        let message = chatText.value.trim();
        if (message === "") return;

        // USER MESSAGE
        addMessage(message, "user");

        chatText.value = "";

        // SHOW TYPING ANIMATION
        typingIndicator.style.display = "block";

        // BOT REPLY AFTER 2 SECONDS
        setTimeout(() => {
            typingIndicator.style.display = "none";
            addMessage("Thanks for messaging Pinnacle! How can we help you?", "bot");
        }, 2000);
    }

    function addMessage(text, type) {
        const msg = document.createElement("div");
        msg.classList.add("message", type);
        msg.innerText = text;
        chatMessages.appendChild(msg);

        // AUTO-SCROLL
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

});
</script>

