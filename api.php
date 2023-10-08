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
            echo "Bot: " . $response;
        }
    } else {
        echo "Bot: Invalid input.";
    }
} else {
    echo "Bot: Invalid request method.";
}
?>
