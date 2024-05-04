<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oru";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to retrieve user info based on user ID
function getUserInfo($user_id) {
    global $conn;
    
    // Prepare and execute SQL query to fetch user info
    $stmt = $conn->prepare("SELECT file, name FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch user info
    $user_info = $result->fetch_assoc();

    // Close statement
    $stmt->close();

    // Return user info
    return $user_info;
}

// Function to retrieve messages between two users
function getMessages($user1_id, $user2_id) {
    global $conn;
    
    // Prepare and execute SQL query to fetch messages
    $stmt = $conn->prepare("SELECT SenderID, MessageContent FROM messages WHERE (SenderID = ? AND ReceiverID = ?) OR (SenderID = ? AND ReceiverID = ?) ORDER BY timestamp ASC");
    
    if (!$stmt) {
        die("Error in SQL query: " . $conn->error);
    }
    
    $stmt->bind_param("iiii", $user1_id, $user2_id, $user2_id, $user1_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch messages
    $messages = array();
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }

    // Close statement
    $stmt->close();

    // Return messages
    return $messages;
}
?>
