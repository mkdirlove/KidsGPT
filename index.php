<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatGPT Interface</title>
    <style>
       html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}

:root {
    --color-white: #fff;
    --color-main: #2c2d30;
    --color-main-fade: #2c2d3000;
    --color-secondary: #171717;
    --color-secondary-fade: #17171700;
    --color-button-hover: #242629;
    --color-button-hover-fade: #24262900;
    --color-user-icon: #8e0000;
    --color-groupings: #9ca6b5;
    --color-gpt-icon: #000000;
    --color-black: #1e1e1f;
    --color-user-menu-hover: #383b42;
    --color-text: #f5f9ff;
    --color-gpt3: #5fc319;
    --color-gpt4: #f22626;
    --color-secondary-p: #c9ccd1;
    --color-logo: #848484;
    --color-model-name: #ffffff;
    --color-assistant-bg: #3f4042;
    --color-assistant-text: #e1e6ed;
    --color-disclaimer: #d0d2e1;
    --color-border1: #484a4e;
    --color-user-menu-border: #34373a;
    --color-user-menu-selected-border: #4a5562;
    --color-border2: #292d32;
    --color-user-message-border: #2f353d;
}

body {
    background: var(--color-main);
    display: flex;
    font-size: 1em;
    font-family: system-ui, sans-serif;
}

#sidebar {
    position: relative;
    left: 0;
    background: var(--color-secondary);
    width: 260px;
    padding: 8px;
    box-sizing: border-box;
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    transition: all 0.2s ease-in-out;
    height: 100%;
}

.float-top {
    display: flex;
    flex-direction: column;
    height: calc( 100% - 50px );
}

#sidebar.hidden {
    left: -260px;
    margin-right: -260px;
}

#sidebar.hidden .hide-sidebar {
    left: 53px;
    transform: rotate(180deg);
    padding: 15px 13px 11px 13px;
}

button {
    display: block;
    background: inherit;
    border: 1px solid var(--color-border1);
    border-radius: 5px;
    color: var(--color-white);
    padding: 13px;
    box-sizing: border-box;
    text-align: left;
    cursor: pointer;
}

button:hover {
    background: var(--color-button-hover);
}

.sidebar-controls {
    display: flex;
    gap: 10px;
    margin-bottom: 8px;
}

.sidebar-controls button {
    padding: 12px 13px 12px 13px;
}

.hide-sidebar {
    position: relative;
    left: 0;
    top: 0;
    transition: all 0.2s ease-in-out;
    transform: rotate(0deg);
    background: var(--color-black);
}

.new-chat i {
    margin-right: 13px;
}

.new-chat {
    flex: 1;
}

.conversations {
    width: calc( 100% + 8px );
    overflow-y: scroll;
}

.conversations,
.conversations li {
    list-style: none;
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.conversations li {
    position: relative;
}

.conversations li .fa {
    margin-right: 7px;
}

.conversations li > button {
    width: 100%;
    border: none;
    font-size: 0.9em;
    white-space: nowrap;
    overflow: hidden;
}

.conversations li.active > button {
    background: var(--color-main);
}

.edit-buttons {
    display: none;
    position: absolute;
    right: 8px;
    top: 0;
}

.conversations li:hover .edit-buttons {
    display: flex;
}

.fade {
    position: absolute;
    right: 0;
    top: 0;
    background: var(--color-user-icon);
    width: 40px;
    height: 100%;
    border-radius: 5px;
    background: transparent;
    background: linear-gradient(90deg, var(--color-secondary-fade) 0%, var(--color-secondary) 50%);
}

.conversations li.active .fade {
    background: linear-gradient(90deg, var(--color-main-fade) 0%, var(--color-main) 50%);
}

.conversations li:hover .fade {
    width: 80px;
    background: linear-gradient(90deg, var(--color-button-hover-fade) 0%, var(--color-button-hover) 30%);
}

.edit-buttons button {
    border: none;
    padding: 0;
    margin: 13px 1px 13px 1px;
    opacity: 0.7;
}

.edit-buttons button:hover {
    background: none;
    opacity: 1;
}

.conversations li.grouping {
    color: var(--color-groupings);
    font-size: 0.7em;
    font-weight: bold;
    padding-left: 13px;
    margin-top: 12px;
    margin-bottom: 12px;
}

i.user-icon {
    padding: 6px;
    color: var(--color-white);
    background: var(--color-user-icon);
    display: inline-block;
    text-align: center;
    width: 15px;
    border-radius: 3px;
    margin-right: 6px;
    font-style: normal;
    width: 18px;
    height: 18px;
    font-size: 15px;
    text-transform: uppercase;
    font-family: system-ui, sans-serif;
}

.gpt.user-icon  {
    background: var(--color-gpt-icon);
}

.user-menu {
    position: relative;
    border-top: 1px solid var(--color-border1);
}

.user-menu button {
    width: 100%;
    border: none;
}

.user-menu .dots {
    position: relative;
    top: 11px;
    float: right;
    opacity: 0.7;
}

.user-menu > ul,
.user-menu li {
    list-style: none;
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.user-menu > ul {
    display: none;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0;
    transform: translateY(-100%);
    background: var(--color-black);
    border-radius: 10px;
    width: 100%;
    transition: all 0.2s ease-in-out;
}

.user-menu > ul.show-animate {
    display: block;
}

.user-menu > ul.show {
    opacity: 1;
    margin-top: -8px;
}

.user-menu li button {
    border-radius: 0;
}

.user-menu li button:hover {
    background: var(--color-user-menu-hover);
}

.user-menu li:first-child button {
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.user-menu li:last-child button {
    border-top: 1px solid var(--color-user-menu-border);
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}

::-webkit-scrollbar {
    width: 9px;
}

::-webkit-scrollbar-track {
    background-color: transparent;
}

::-webkit-scrollbar-thumb {
    background-color: transparent;
}

:hover::-webkit-scrollbar-thumb {
    background-color: var(--color-text);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background-color: var(--color-text);
    border-radius: 5px;
}

main {
    width: 100%;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: space-between;
    padding: 0 0 30px 0;
    box-sizing: border-box;
}

main .view {
    display: none;
    flex-direction: column;
}

main .view.show {
    display: flex;
}

.model-selector {
    position: relative;
    border-radius: 11px;
    background: var(--color-secondary);
    display: flex;
    padding: 4px;
    gap: 4px;
    margin: 24px auto;
    z-index: 2;
}

.model-selector > button {
    border-radius: 9px;
    text-align: center;
    width: 150px;
    border: none;
    font-weight: bold;
    opacity: 0.5;
}

.model-selector > button:hover {
    background: none;
    opacity: 1;
}

.model-selector > button.selected {
    border: 1px solid var(--color-user-menu-selected-border);
    background: var(--color-user-menu-hover);
    opacity: 1;
}

.model-selector button .fa {
    margin-right: 5px;
}

.gpt-3 .fa {
    color: var(--color-gpt3);
}

.gpt-4 .fa {
    color: var(--color-gpt4);
}

.model-info {
    display: none;
    position: absolute;
    bottom: 5px;
    left: 0;
    transform: translateY(100%);
    padding: 15px;
    cursor: default;
}

.model-info-box {
    padding: 20px 20px 10px 20px;
    border-radius: 15px;
    background: var(--color-secondary);
    color: var(--color-white);
    text-align: left;
}

.model-selector > button:hover .model-info {
    display: block;
}

.model-selector p {
    font-size: 1.1em;
    margin: 0 0 15px 0;
}

p.secondary {
    font-size: 1em;
    color: var(--color-secondary-p);
}

.logo {
    position: relative;
    z-index: 1;
    color: var(--color-logo);
    font-weight: bold;
    text-align: center;
    font-size: 2.3em;
}

.view.conversation-view {
    overflow-y: auto;
}

.model-name {
    background: var(--color-main);
    text-align: center;
    color: var(--color-model-name);
    padding: 23px;
    border-bottom: 1px solid var(--color-border2);
    font-size: 0.85em;
}

.message {
    display: flex;
    gap: 20px;
    padding: 25px 60px 15px 60px;
    border-bottom: 1px solid var(--color-border2);
    font-size: 0.95em;
    position: relative;
}

.message .content {
    padding-top: 5px;
    width: 100%;
}

.user.message {
    color: var(--color-text);
}

.assistant.message {
    background: var(--color-assistant-bg);
    color: var(--color-assistant-text);
}

#message-form {
    margin: 0 auto;
    width: 100%;
    box-sizing: border-box;
    max-width: 850px;
    text-align: center;
    padding: 0px 45px 0 45px;
    box-shadow: var(--color-main) 0 0 50px;
}

.message-wrapper {
    position: relative;
}

#message::placeholder {
    color: var(--color-groupings);
}

#message {
    background: var(--color-user-menu-hover);
    border-radius: 13px;
    width: 100%;
    box-sizing: border-box;
    border: 1px solid var(--color-user-message-border);
    resize: none;
    padding: 17px 85px 17px 15px;
    font-family: inherit;
    font-size: 1em;
    color: var(--color-white);
    box-shadow: rgba(0,0,0,0.2) 0 0 45px;
    outline: none;
}

.disclaimer {
    margin-top: 12px;
    color: var(--color-disclaimer);
    font-size: 0.7em;
}

#send-button {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: var(--color-gpt3);
    border-radius: 5px;
    display: inline-block;
    font-size: 1em;
    padding: 7px 9px 7px 7px;
    color: var(--color-white);
    border: none;
    margin-top: -2px;
}

button#send-button:hover {
    border: none;
    background: var(--color-gpt3);
    color: var(--color-white);
}

p {
    margin: 0 0 1.5em 0;
}

button.copy {
    border-radius: 5px;
    background: #fff;
    color: #050509;
    padding: 0;
    width: 20px;
    height: 20px;
    border: 0;
    position: absolute;
    top: 10px;
    right: 10px;
    text-align: center;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th {
    background-color: #ddd;
    font-weight: bold;
    color: #474747;
}

td, th {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

pre {
    width: 100%;
}

pre code.hljs {
    white-space: pre-wrap;
    border-radius: 10px;
    font-size: 1.1em;
    margin: 5px;
    position: relative;
}

#cursor {
    width: 5px;
    height: 20px;
    background-color: #fff;
    display: inline-block;
    animation: blink 1s infinite;
}

@keyframes blink {
    0% {
        opacity: 0;
    }
    50% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}

@media (max-width: 700px) {
    main {
        z-index: 1;
    }

    #sidebar {
        position: fixed;
        top: 0;
        left: -260px;
        margin-right: -260px;
        z-index: 2;
    }

    #sidebar.hidden {
        left: 0;
        margin-right: 0;
    }

    .hide-sidebar {
        left: 53px;
        transform: rotate(180deg);
        padding: 15px 13px 11px 13px;
    }

    #sidebar.hidden .hide-sidebar {
        left: 0;
        transition: all 0.2s ease-in-out;
        transform: rotate(0deg);
    }

    .message {
        padding-left: 20px;
        padding-right: 20px;
        gap: 15px;
    }

    #message {
        font-size: 0.9em;
    }

    .disclaimer {
        font-size: 0.5em;
    }
}

@media (max-width: 335px) {
    main {
        padding: 0 0 20px 0;
    }

    body {
        font-size: 0.8em;
    }

    #message-form {
        padding: 0px 20px 0 20px;
    }

    #message {
        padding: 13px 85px 13px 12px;
    }

    .message {
        padding: 15px 20px 7px 20px;
        gap: 8px;
    }

    #send-button {
        font-size: 0.8em;
        padding: 7px 8px 7px 7px;
        right: 11px;
    }

    .disclaimer {
        font-size: 0.6em;
        margin-top: 6px;
    }
}

@media (max-width: 260px) {
    .message {
        flex-direction: column;
    }

    .message i.user-icon {
        padding: 4px;
        width: 15px;
        height: 15px;
        font-size: 12px;
    }
}

    </style>
</head>

<body>
    <div class="container">
        <h1>Chat with GPT-3.5!</h1>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" id="user_input" name="user_input" placeholder="Enter your query">
            <br>
            <input type="submit" value="Submit">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://chat-gpt-ai-bot.p.rapidapi.com/GenerateAIWritter?prompt=" . urlencode($_POST['user_input']),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: chat-gpt-ai-bot.p.rapidapi.com",
                    "X-RapidAPI-Key: 18140c0733msh4177590f10ca716p1ba0c8jsnd344b761be19"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
            }
        }
        ?>
    </div>
    <script src="assets/script.js"><script>
    <script src="assets/ui-script.js"><script>
</body>

</html>
