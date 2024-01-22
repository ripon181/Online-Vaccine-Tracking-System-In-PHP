<?php
$conn = mysqli_connect('localhost', 'root', '', 'vaccinated_db');
// Get the hospital name and ID for the logged-in hospital user
session_start(); 
if (isset($_SESSION['GenLuserdata'])) {
    $loggedInHospitalUsername = $_SESSION['GenLuserdata'];

    // Query the database to get the hospital ID and name based on the hospital username
    $getHospitalInfoQuery = "SELECT id, hospitalName FROM hospital WHERE hospitalUsername = '$loggedInHospitalUsername'";
    $result = mysqli_query($conn, $getHospitalInfoQuery);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $loggedInHospitalId = $row['id'];
        $loggedInHospitalName = $row['hospitalName'];
    }
}

// Handle message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['message']) && isset($_POST['senderType']) && isset($_POST['senderId'])) {
        $message = $_POST['message'];
        $senderType = $_POST['senderType'];
        $senderId = $_POST['senderId'];

        // Insert the message into the database
        $insertMessageQuery = "INSERT INTO chat_messages (message, sender_type, sender_id) VALUES ('$message', '$senderType', '$senderId')";
        $insertResult = mysqli_query($conn, $insertMessageQuery);

        if ($insertResult) {
            // Message inserted successfully
            // You can add any additional handling here if needed
        } else {
            // Failed to insert message, handle the error as needed
        }
    }
}

// Fetch chat messages from the database
$sql = "SELECT cm.*, gu.Name AS sender_name FROM chat_messages cm
        LEFT JOIN general_user gu ON cm.sender_id = gu.id";
$result = mysqli_query($conn, $sql);
$messages = [];

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat with Parents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style type="text/css">
    body{
        background-image: url("../dist/img/bg.png");
    }
    div#chat-box {
        background: #00e5ff59;
        color: #fff;
        padding: 12px;
        border-radius: 5px;
    }
</style>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="mb-4" style="color:#fff;">Chat with Parents</h2>
            <div id="chat-box" style="height: 300px; border: 1px solid #ccc; overflow-y: scroll;">
                <!-- Chat messages will be displayed here -->
                <?php foreach ($messages as $message) : ?>
                    <?php
                    $messageClass = ($message['sender_type'] === 'hospital') ? 'hospital-message' : 'parent-message';
                    $alignClass = ($message['sender_type'] === 'hospital') ? 'text-right' : 'text-left';
                    $sender = ($message['sender_type'] === 'hospital') ? $loggedInHospitalName : $message['sender_name'];
                    ?>
                    <p class="<?php echo $messageClass . ' ' . $alignClass; ?>" data-message-id="<?php echo $message['id']; ?>">
                        <strong><?php echo $sender . ': '; ?></strong><?php echo $message['message']; ?>
                    </p>
                <?php endforeach; ?>
            </div>
            <form id="chat-form" class="input-group mt-3" method="POST">
                <input type="text" name="message" id="message-input" class="form-control" placeholder="Type your message...">
                <input type="hidden" name="senderType" value="hospital">
                <input type="hidden" name="senderId" id="sender-id" value="<?php echo $loggedInHospitalId; ?>">
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<style type="text/css">
    .hospital-message {
        text-align: right;
        color: #fff;
        background-color: #a600ff96;
        padding: 5px;
        border-radius: 10px;
        margin-bottom: 10px;
    }
   
    .parent-message {
        text-align: left;
        color: #fff;
        background-color: #fff054a8;
        padding: 5px;
        border-radius: 10px;
        margin-bottom: 10px;
    }
</style>

<script>
    var lastMessageId = 0;

    // Function to send a message to the server and update chat box
    function sendMessage(event) {
        event.preventDefault();
        var messageInput = document.getElementById('message-input').value;
        var senderIdInput = document.getElementById('sender-id').value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Message sent successfully, fetch and display all messages
                    fetchAndDisplayAllMessages();
                    // Clear input field after sending
                    document.getElementById('message-input').value = '';
                } else {
                    // Failed to send message, handle the error as needed
                }
            }
        };
        xhr.open('POST', 'chat.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('message=' + encodeURIComponent(messageInput) + '&senderType=hospital&senderId=' + senderIdInput);
    }

    // Attach the function to form submission event
    document.getElementById('chat-form').addEventListener('submit', sendMessage);

   // Function to display messages in the chat box
function displayMessages(messages) {
    var chatBox = document.getElementById('chat-box');
    
    // Clear the chat box before adding new messages
    chatBox.innerHTML = '';

    messages.forEach(function(message) {
        var messageClass = (message.sender_type === 'hospital') ? 'hospital-message' : 'parent-message';
        var alignClass = (message.sender_type === 'hospital') ? 'text-right' : 'text-left';
        var sender = (message.sender_type === 'hospital') ? '<?php echo $loggedInHospitalName; ?>' : message.sender_name;
        var messageHtml = '<p class="' + messageClass + ' ' + alignClass + '" data-message-id="' + message.id + '"><strong>' + sender + ': </strong>' + message.message + '</p>';
        
        // Append the new message to the chat box
        chatBox.innerHTML += messageHtml;
    });

    // Scroll to the bottom to show the latest messages
    chatBox.scrollTop = chatBox.scrollHeight;

    // Update the lastMessageId variable with the highest message identifier
    if (messages.length > 0) {
        lastMessageId = messages[messages.length - 1].id;
    }
}

// Function to fetch and display all messages
function fetchAndDisplayAllMessages() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Update the chat box with all messages
                var response = JSON.parse(xhr.responseText);
                displayMessages(response.messages);
            } else {
                // Error fetching messages, handle the error as needed
            }
        }
    };
    xhr.open('GET', 'chat_fetch.php', true);
    xhr.send();
}

// Fetch and display all messages on page load
window.onload = function () {
    fetchAndDisplayAllMessages();
};
</script>
</body>
</html>
