<?php
// openai_proxy.php
header('Content-Type: application/json');

// === CONFIG ===
// Put your OpenAI API key here OR set via environment variable for safety.
// $OPENAI_API_KEY = 'sk-...'; // avoid hardcoding in production
$OPENAI_API_KEY = getenv('OPENAI_API_KEY') ?: 'REPLACE_WITH_YOUR_KEY';

// Optional DB config if you want to store chat history (MySQL/XAMPP)
$USE_DB = false;
$db = null;
if ($USE_DB) {
    $dbHost = '127.0.0.1';
    $dbName = 'hostel';
    $dbUser = 'root';
    $dbPass = '';
    try {
        $db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass);
    } catch (Exception $e) {
        // continue without DB
        $db = null;
    }
}

// read incoming JSON
$input = json_decode(file_get_contents('php://input'), true);
if (!$input || !isset($input['message'])) {
    echo json_encode(['error'=>'invalid_request']);
    exit;
}

$userMessage = trim($input['message']);

// Build conversation messages: you can expand to persist user session history.
// For simple stateless request, send system prompt + user message.
$messages = [
    ["role" => "system", "content" => "You are HostelBot, a helpful assistant for a student hostel. Answer concisely and provide links/instructions if needed."],
    ["role" => "user", "content" => $userMessage]
];

// Prepare request payload
$postData = [
    "model" => "gpt-3.5-turbo",
    "messages" => $messages,
    "max_tokens" => 400,
    "temperature" => 0.2,
];

// cURL to OpenAI
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $OPENAI_API_KEY"
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
$response = curl_exec($ch);
$err = curl_error($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($err) {
    echo json_encode(['error'=>"curl_error", 'message'=>$err]);
    exit;
}

$resp = json_decode($response, true);
if (!$resp) {
    echo json_encode(['error'=>'invalid_api_response', 'raw'=>$response]);
    exit;
}

// extract assistant reply
$reply = null;
if (isset($resp['choices'][0]['message']['content'])) {
    $reply = $resp['choices'][0]['message']['content'];
} else {
    $reply = "Sorry, I couldn't get an answer.";
}

// optional: save to DB
if ($USE_DB && $db) {
    try {
        $stmt = $db->prepare("INSERT INTO chat_history (user_message, bot_reply, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$userMessage, $reply]);
    } catch (Exception $e) {
        // ignore DB errors
    }
}

echo json_encode(['reply' => trim($reply), 'meta' => ['status'=>$httpcode]]);
