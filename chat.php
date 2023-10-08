<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>KidsGPT</title>

</head>

<body>

    <div class="container">
        <div class="header">
            <h3>ChatgPT 3.5 Turbo</h3>
        </div>

        <div class="info">
            <a href="#" target="_blank">
                ChatGPT for Kids :)
            </a>
        </div>

        <div class="chat-container">
            <div id="chat-log"></div>
        </div>

        <div class="input-container">
            <input type="text" id="user-input"
            placeholder="Send a message.">
            <button id="send-button">
                <i class="fa-solid fa-share" id="button-icon"></i>
            </button>
        </div>

    </div>

    <script src="index.js"></script>
</body>

</html>