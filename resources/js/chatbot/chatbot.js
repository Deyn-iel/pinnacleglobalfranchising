document.addEventListener("DOMContentLoaded", function () {

    const chatButton = document.getElementById("chat-button");
    const chatBox = document.getElementById("chatbox");
    const closeChat = document.getElementById("close-chat");
    const clearChat = document.getElementById("clear-chat");
    const sendBtn = document.getElementById("send-btn");
    const chatText = document.getElementById("chat-text");
    const chatMessages = document.getElementById("chat-messages");
    const typingIndicator = document.getElementById("typing-indicator");

    let isWaitingForBot = false; // Block send button only

    // OPEN CHATBOX
    chatButton.addEventListener("click", () => {
        chatBox.style.display = chatBox.style.display === "flex" ? "none" : "flex";
    });

    // CLOSE CHATBOX
    closeChat.addEventListener("click", () => {
        chatBox.style.display = "none";
    });

    // CLEAR CHAT EXCEPT GREETING
    clearChat.addEventListener("click", () => {
        const messages = chatMessages.querySelectorAll(".message");

        messages.forEach(msg => {
            if (!msg.id.includes("chat-greeting")) msg.remove();
        });

        typingIndicator.style.display = "none";
        sendBtn.disabled = false;
        isWaitingForBot = false;
    });

    // SEND MESSAGE CLICK
    sendBtn.addEventListener("click", sendMessage);

    // ENTER KEY (BLOCKED DURING BOT REPLY)
    chatText.addEventListener("keypress", function (e) {
        if (e.key === "Enter" && !isWaitingForBot) {
            sendMessage();
        }
    });

    function sendMessage() {
        let message = chatText.value.trim();
        if (message === "") return;

        if (isWaitingForBot) return;

        addMessage(message, "user");
        chatText.value = "";

        // BLOCK ONLY SEND BUTTON
        isWaitingForBot = true;
        sendBtn.disabled = true;

        // Show typing bubble
        typingIndicator.style.display = "block";
        chatMessages.appendChild(typingIndicator);
        scrollToBottom();

        setTimeout(() => {
            typingIndicator.style.display = "none";
            typeBotMessage("Thanks for messaging Pinnacle! How can we help you? Our team will get back to you shortly. Have a great day!");
        }, 1200);
    }

    /* BOT TYPEWRITER EFFECT */
    function typeBotMessage(fullText) {
        const botMsg = document.createElement("div");
        botMsg.classList.add("message", "bot");
        botMsg.innerHTML = "";
        chatMessages.appendChild(botMsg);

        let index = 0;

        function typeLetter() {
            if (index < fullText.length) {
                botMsg.innerHTML += fullText[index];
                index++;
                scrollToBottom();
                setTimeout(typeLetter, 15);
            } else {
                // UNBLOCK SEND BUTTON
                isWaitingForBot = false;
                sendBtn.disabled = false;
                chatText.focus();
            }
        }

        typeLetter();
    }

    function addMessage(text, type) {
        const msg = document.createElement("div");
        msg.classList.add("message", type);
        msg.innerText = text;
        chatMessages.appendChild(msg);
        scrollToBottom();
    }

    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

});
