<?php
// chat_fetch.php - Fetch and display chat messages

// Include your database connection here
$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');
session_start(); 
// Get the last displayed message identifier from the query parameter
$lastMessageId = isset($_GET['lastMessageId']) ? intval($_GET['lastMessageId']) : 0;

// Fetch chat messages from the database, including the sender's name
if ($lastMessageId > 0) {
    $sql = "SELECT cm.*, gu.Name AS sender_name FROM chat_messages cm
            LEFT JOIN general_user gu ON cm.sender_id = gu.id
            WHERE cm.id > $lastMessageId";
} else {
    $sql = "SELECT cm.*, gu.Name AS sender_name FROM chat_messages cm
            LEFT JOIN general_user gu ON cm.sender_id = gu.id";
}

$result = mysqli_query($conn, $sql);
$messages = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }
}

// Return messages as JSON data
header('Content-Type: application/json');
echo json_encode(['messages' => $messages]);
?>
