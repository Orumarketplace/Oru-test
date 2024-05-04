<?php
// Assuming you have retrieved product information from a form or other source
$product_image = $_POST['product_image']; // Assuming you have already processed the image upload
$product_name = $_POST['product_name'];
$product_type = $_POST['product_type'];
$location = $_POST['location'];
$product_price = $_POST['product_price'];
$product_description = $_POST['product_description'];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Please use a secure password
$dbname = "oru";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to insert product information into the Traders table
$stmt = $conn->prepare("INSERT INTO traders (product_image, product_name, product_type, location, product_price, product_description) VALUES (?, ?, ?, ?, ?, ?)");

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssssds", $product_image, $product_name, $product_type, $location, $product_price, $product_description);

// Execute the statement
if ($stmt->execute()) {
    // Close product statement and connection
    $stmt->close();
    $conn->close();
    // Redirect to index.php
    header("Location: index.php");
    exit();
} else {
    echo "Error inserting product: " . $stmt->error;
    $stmt->close();
    $conn->close();
}
?>
