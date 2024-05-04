<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or display an error message
    // header("Location: login.php");
    // exit();
}

// Connect to the oru
$mysqli = new mysqli("localhost", "root", "", "oru");

// Fetch messages for the current user
$user = $_SESSION['user'];
$query = "SELECT * FROM messages WHERE sender = $user OR receiver = $user ORDER BY timestamp DESC";
$result = $mysqli->query($query);

// Display the chat history
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Display each message
        echo "<div><strong>{$row['sender']}</strong>: {$row['message']}</div>";
    }
} else {
    echo "No messages";
}

$mysqli->close();
?>
