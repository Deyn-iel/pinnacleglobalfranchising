document.addEventListener("DOMContentLoaded", function () {

    const chatButton = document.getElementById("chat-button");
    const chatBox = document.getElementById("chatbox");
    const closeChat = document.getElementById("close-chat");
    const clearChat = document.getElementById("clear-chat");

    const sendBtn = document.getElementById("send-btn");
    const chatText = document.getElementById("chat-text");
    const chatMessages = document.getElementById("chat-messages");
    const typingIndicator = document.getElementById("typing-indicator");

    let isWaitingForBot = false;

    /* ===============================
       HELPERS
    =============================== */

    function updateSendButtonState() {
        sendBtn.disabled = isWaitingForBot || chatText.value.trim() === "";
    }

    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function addMessage(text, type) {
        const msg = document.createElement("div");
        msg.classList.add("message", type);
        msg.innerText = text;
        chatMessages.appendChild(msg);
        scrollToBottom();
    }

    /* ===============================
       OPEN / CLOSE CHAT
    =============================== */

    chatButton.addEventListener("click", () => {
        chatBox.style.display = chatBox.style.display === "flex" ? "none" : "flex";
        chatText.focus();
    });

    closeChat.addEventListener("click", () => {
        chatBox.style.display = "none";
    });

    /* ===============================
       CLEAR CHAT (KEEP GREETING)
    =============================== */

    clearChat.addEventListener("click", () => {
        const messages = chatMessages.querySelectorAll(".message");

        messages.forEach(msg => {
            if (!msg.id || !msg.id.includes("chat-greeting")) {
                msg.remove();
            }
        });

        typingIndicator.style.display = "none";
        isWaitingForBot = false;
        updateSendButtonState();
    });

    /* ===============================
       INPUT EVENTS
    =============================== */

    chatText.addEventListener("input", () => {
        updateSendButtonState();
    });

    chatText.addEventListener("keypress", (e) => {
        if (e.key === "Enter" && !isWaitingForBot) {
            e.preventDefault();
            sendMessage();
        }
    });

    sendBtn.addEventListener("click", sendMessage);

    /* ===============================
       SEND MESSAGE
    =============================== */

    function sendMessage() {
        const message = chatText.value.trim();
        if (message === "" || isWaitingForBot) return;

        addMessage(message, "user");
        chatText.value = "";

        isWaitingForBot = true;
        updateSendButtonState();

        // Show typing indicator
        typingIndicator.style.display = "block";
        chatMessages.appendChild(typingIndicator);
        scrollToBottom();

        // Simulate bot thinking
        setTimeout(() => {
            typingIndicator.style.display = "none";

            typeBotMessage(
                "Thanks for messaging Pinnacle! How can we help you today? Thanks for messaging Pinnacle! How can we help you today?Thanks for messaging Pinnacle! How can we help you today? Thanks for messaging Pinnacle! How can we help you today? Thanks for messaging Pinnacle! How can we help you today? Thanks for messaging Pinnacle! How can we help you today? Thanks for messaging Pinnacle! How can we help you today?"
            );
        }, 1200);
    }

    /* ===============================
       BOT TYPEWRITER EFFECT
    =============================== */

    function typeBotMessage(fullText) {
        const botMsg = document.createElement("div");
        botMsg.classList.add("message", "bot");
        chatMessages.appendChild(botMsg);

        let index = 0;
        isWaitingForBot = true;
        updateSendButtonState();

        function typeLetter() {
            if (index < fullText.length) {
                botMsg.innerHTML += fullText[index];
                index++;
                scrollToBottom();
                setTimeout(typeLetter, 8);
            } else {
                isWaitingForBot = false;
                updateSendButtonState();
                chatText.focus();
            }
        }

        typeLetter();
    }

    /* ===============================
       INITIAL STATE
    =============================== */
    updateSendButtonState();

});
