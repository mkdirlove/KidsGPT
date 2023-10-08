<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat UI</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .chat-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .chat-log {
            padding: 20px;
            height: 300px;
            overflow-y: auto;
        }

        .input-container {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #f8f9fa;
        }

        #user-input {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        #send-button {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="chat-container">
        <div class="chat-log">
            <?php
            // Validate and sanitize user input
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $user_input = isset($_GET["user_input"]) ? htmlspecialchars($_GET["user_input"]) : "";
                $user_input = urlencode($user_input); // URL encode user input

                if (!empty($user_input)) {
                    $apiUrl = "https://chat-gpt-3-5-turbo.p.rapidapi.com/{$user_input}";

                    // Perform HTTP GET request using cURL
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => $apiUrl,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "GET",
                        CURLOPT_HTTPHEADER => [
                            "X-RapidAPI-Host: chat-gpt-3-5-turbo.p.rapidapi.com",
                            "X-RapidAPI-Key: 18140c0733msh4177590f10ca716p1ba0c8jsnd344b761be19"
                        ],
                    ]);

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                        echo "Bot: cURL Error #:" . $err;
                    } else {
                        echo "Bot: " . htmlspecialchars($response);
                    }
                } else {
                    echo "Bot: Invalid input.";
                }
            } else {
                echo "ChatBot: Invalid request method.";
            }
            ?>
        </div>
        <div class="input-container">
            <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="user_input" id="user-input" placeholder="Type your message..." />
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</body>

</html>
