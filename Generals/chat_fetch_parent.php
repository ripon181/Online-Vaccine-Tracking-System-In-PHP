<?php
// chat_fetch_parent.php - Fetch and display parent chat messages with parent's name

// Include your database connection here
$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');

// Get the last displayed message identifier from the query parameter
$lastMessageId = isset($_GET['lastMessageId']) ? intval($_GET['lastMessageId']) : 0;

// Fetch and display new chat messages from the database
$sql = "SELECT cm.id, cm.message, cm.sender_type, cm.timestamp, gu.Name AS parent_name FROM chat_messages cm
        LEFT JOIN general_user gu ON cm.sender_id = gu.id
        WHERE cm.id > $lastMessageId";

$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $messageSender = ($row['sender_type'] === 'parent') ? $row['parent_name'] : 'Hospital';
        echo '<p data-message-id="' . $row['id'] . '"><strong>' . $messageSender . ': </strong>' . $row['message'] . '</p>';
    }
}
?>
