<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-500 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center h-16 items-center">
            <!-- Nav Links -->
            <h1 class="nav-link mr-4" id="chats-link">Chats</h1>
            <!-- Animation Line -->
            <div class="line" id="animation-line"></div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Chat Content -->
        <?php
// Start the session
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "oru";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user account information from the database
$sql = "SELECT name, file FROM users ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $image_url = $row["file"];

    echo "<a href='messaging.php' class='block w-full'>";
    echo "<div class='absolute top-13 left-0 w-full bg-white shadow-md rounded-lg overflow-hidden cursor-pointer'>";
    echo "<div class='p-1 flex items-center'>";
    echo "<img src='$image_url' alt='User Image' class='w-12 h-12 rounded-full mr-4' />";
    echo "<div>";
    echo "<h1 class='text-xl font-bold'>$name</h1>";
    echo "<p class='text-gray-700'>Last text sent goes here...</p>";
    echo "<p class='text-gray-500'>10:30 AM</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</a>";
} else {
    echo "<p class='ml-2'>Account</p>";
}

// Close connection
$conn->close();
?>

    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatsLink = document.getElementById('chats-link');
            const animationLine = document.getElementById('animation-line');

            // Set initial position of the animation line
            animationLine.style.width = `${chatsLink.offsetWidth}px`;
            animationLine.style.transform = `translateX(${chatsLink.offsetLeft}px)`;

            // Function to handle animation on nav link click
            function handleNavClick(link) {
                const offsetLeft = link.offsetLeft;
                const offsetWidth = link.offsetWidth;
                animationLine.style.width = `${offsetWidth}px`;
                animationLine.style.transform = `translateX(${offsetLeft}px)`;
            }

            // Event listener for chats link
            chatsLink.addEventListener('click', function (e) {
                e.preventDefault();
                handleNavClick(this);
            });
        });
    </script>
</body>

</html>
