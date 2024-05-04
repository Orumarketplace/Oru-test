<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<?php
// Assuming $id contains the user ID
$id = 1; // Example user ID

// Step 1: Connect to the Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oru";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Step 2: Execute Queries

// Query to fetch user information
$user_query = "SELECT file, name FROM users WHERE id = $id";
$user_result = $conn->query($user_query);
if (!$user_result) {
    die("Error fetching user information: " . $conn->error);
}
if ($user_result->num_rows > 0) {
    $user_row = $user_result->fetch_assoc();
    $user_image = $user_row['file'];
    $username = $user_row['name'];
}

// Query to fetch product information associated with the user
$product_query = "SELECT product_image, product_name FROM traders WHERE user_id = $id";
$product_result = $conn->query($product_query);
if (!$product_result) {
    die("Error fetching product information: " . $conn->error);
}
?>

<div class="flex flex-col items-center mt-8">
    <!-- User Image -->
    <img src="<?php echo $user_image; ?>" alt="User Image" class="w-32 h-32 rounded-full cursor-pointer"
         onclick="alert('Do you want to change your user image?')">

    <!-- Username -->
    <h1 class="mt-4 text-2xl font-bold"><?php echo $username; ?></h1>

    <!-- Products -->
    <?php while ($product_row = $product_result->fetch_assoc()): ?>
        <div class="bg-gray-100 p-4 rounded-lg mt-4">
            <!-- Product Image -->
            <img src="<?php echo $product_row['product_image']; ?>" alt="Product Image" class="w-24 h-24">
            <!-- Product Name -->
            <p class="mt-2 text-lg font-semibold"><?php echo $product_row['product_name']; ?></p>
            <!-- Buttons -->
            <div class="mt-2 flex space-x-2">
                <!-- Update Button -->
                <button onclick="confirm('Do you want to update this product?')"
                        class="px-4 py-2 text-white bg-blue-500 rounded">Update
                </button>
                <!-- Delete Button -->
                <button onclick="confirm('Do you want to delete this product?')"
                        class="px-4 py-2 text-white bg-red-500 rounded">Delete
                </button>
            </div>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
