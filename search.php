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

// Assuming you have already established a database connection

// Get the user's query from the search form
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare the SQL query to search for products related to the user's query
$sql = "SELECT users.file AS user_image, users.name, traders.product_image, traders.product_name, traders.location, traders.product_price, traders.product_description
        FROM traders
        INNER JOIN users ON traders.id = users.id
        WHERE traders.product_name LIKE '%$query%'
        OR traders.product_description LIKE '%$query%'
        OR traders.location LIKE '%$query%'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if any products were found
if (mysqli_num_rows($result) > 0) {
    // Loop through the results and display the products
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mt-6">';
    echo '<div class="md:flex">';
    echo '<div class="md:flex-shrink-0">';
    // Display the user image with rounded corners and smaller dimensions
    echo '<img src="' . $row['user_image'] . '" alt="User Image" class="h-12 w-12 object-cover md:w-24 md:h-24 rounded-full">';
    echo '</div>';
    echo '<div class="md:flex-shrink-0">';
    // Display the product image
    echo '<img src="' . $row['product_image'] . '" alt="Product Image" class="h-48 w-full object-cover md:w-48">';
    echo '</div>';
    echo '<div class="p-8">';
    // Display the product name
    echo '<h2 class="text-lg font-semibold text-gray-800">' . $row['product_name'] . '</h2>';
    // Display the username
    echo '<p class="text-gray-600">Listed by: ' . $row['name'] . '</p>';
    // Display the location
    echo '<p class="text-gray-600">Location: ' . $row['location'] . '</p>';
    // Display the product price
    echo '<p class="text-green-600 font-semibold">Price: ' . $row['product_price'] . '</p>';
    // Display the product description
    echo '<p class="text-gray-700">' . $row['product_description'] . '</p>';
    // Display the "Message Seller" button
    echo '<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-4">Message Seller</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

} else {
    // No products found
    echo '<div class="text-center text-gray-500 mt-6">No products found.</div>';
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
</body>
</html>