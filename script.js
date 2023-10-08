document.addEventListener("DOMContentLoaded", function() {
    const chatLog = document.getElementById("chat-log");
    const messageInput = document.getElementById("message-input");
    const sendButton = document.getElementById("send-button");

    sendButton.addEventListener("click", function() {
        const userMessage = messageInput.value;
        if (userMessage.trim() === "") {
            return;
        }

        const userDiv = document.createElement("div");
        userDiv.className = "user-message";
        userDiv.innerText = "You: " + userMessage;
        chatLog.appendChild(userDiv);

        // Call the API with user input
        fetch("api.php")
            .then(response => response.json())
            .then(data => {
                const botDiv = document.createElement("div");
                botDiv.className = "bot-message";
                botDiv.innerText = "Bot: " + data.answer.content; // Assuming the API response is in the format: { "answer": { "content": "Bot response here" } }
                chatLog.appendChild(botDiv);
                chatLog.scrollTop = chatLog.scrollHeight; // Scroll to the bottom of the chat log
            })
            .catch(error => {
                console.error(error);
                const errorDiv = document.createElement("div");
                errorDiv.className = "error-message";
                errorDiv.innerText = "Error occurred while fetching response.";
                chatLog.appendChild(errorDiv);
                chatLog.scrollTop = chatLog.scrollHeight;
            });

        messageInput.value = "";
    });
});
