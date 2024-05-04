<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <title>Your Webpage</title>
    <style>
        /* Custom CSS for specific screen widths */
        @media (max-width: 320px) {
            .header-container,
            .footer-container,
            body {
                width: 520px;
            }
        }
        @media (min-width: 321px) and (max-width: 375px) {
            .header-container,
            .footer-container,
            body {
                width: 375px;
            }
        }
        @media (min-width: 376px) and (max-width: 425px) {
            .header-container,
            .footer-container,
            body {
                width: 425px;
            }
        }
        @media (max-width: 509px) {
            .header-container,
            .footer-container,
            body {
                width: 520px;
            }
        }
        @media (max-width: 320px) {
            .txt {
                font-size: larger;
            }
        }

        /* Hide dropdown content by default */
        .dropdown-content {
            display: none;
        }
        /* Show dropdown content when the dropdown is active */
        .dropdown-active .dropdown-content {
            display: block;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="p-4 border-b bg-blue-500 flex items-center justify-between header-container fixed top-0 w-full z-50">
        <!-- Web Logo -->
        <img src="assets/img/oru best and third logo.png" alt="Web Logo" class="w-16 h-16 pic" />

        <!-- Search Bar -->
        <form action="search.php" method="GET">
    <div class="relative flex items-center ml-4 header-container">
        <input type="text" placeholder="Search..." name="search" class="py-1 px-4 pr-10 border rounded-full focus:outline-none focus:border-blue-500 w-80 Search" id="searchInput" />
        <button type="submit" class="absolute right-1 px-3 py-1 bg-blue-500 text-white rounded-full hover:bg-blue-700 focus:outline-none">
            Search
        </button>
    </div>
</form>


        <!-- User Image and Account Text -->
        <?php
        // Database configuration
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "oru";

        // Create connection
        $conn = new mysqli($servername, $username, "", $database);

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

            echo "<a href='accounts.php'>";
            echo "<div class='flex items-center header-container'>";
            echo "<img src='$image_url' alt='User Image' class='w-8 h-8 rounded-full' />";
            echo "<p class='ml-2'>$name</p>";
            echo "</div>";
            echo "</a>";
        } else {
            echo "<p class='ml-2'>Account</p>";
        }

        // Close connection
        $conn->close();
        ?>

        <!-- Cart Icon -->
        <!-- <span class="ml-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 3c0-1.105.895-2 2-2h8a2 2 0 012 2h2a2 2 0 012 2v1M3 5l1.972 13.139a2 2 0 001.976 1.86h12.056a2 2 0 001.976-1.86L21 5M10 8v6m0-6V8m5 0v6m0-6V8"></path>
            </svg>
        </span> -->
    </header>

    <!-- Main Content Goes Here -->

  <!-- Footer -->
<footer class="bg-red-500 p-4 border-t border-gray-300 flex justify-center items-center footer-container fixed mt-20 w-full z-50">
    <nav class="flex space-x-4 header-container">
        <a href="Index.php" class="text-gray-600 txt">Home</a>
        <a href="list-page.html" class="text-gray-600 mx-4 txt">Sell</a>
        <a href="chatpage.php" class="text-gray-600 mx-4 txt">Chats</a>
        <!-- <div class="dropdown">
            <a href="#" class="text-gray-600 mx-1 txt dropdown-toggle">Categories</a>
            <div class="dropdown-content bg-white p-2 absolute border border-black rounded-md w-36 hidden">
            <a href="products.php?category=Electronics" class="nav-link">Electronics</a><br>
                <a href="products.php?category=Electronics" class="nav-link">Home/Kitchen </a><br>
                <a href="products.php?category=Electronics" class="nav-link">Beauty/PersonalCare </a><br>
                <a href="products.php?category=Electronics" class="nav-link">ClothingProducts </a><br>
                <a href="products.php?category=Electronics" class="nav-link">Buildingmaterials</a><br>
                <a href="products.php?category=Electronics" class="nav-link">Books</a>
            </div>
        </div> -->
        <div class="dropdown">
            <a href="#" class="text-gray-600 mx-1 txt dropdown-toggle">Settings</a>
            <div class="dropdown-content bg-white p-1 absolute border border-black rounded-md w-36 hidden">
                <a href="about.html" class="block py-1 px-2 text-gray-600 hover:bg-gray-200">about</a>
                <a href="terms.html" class="block py-1 px-2 text-gray-600 hover:bg-gray-200">terms</a>
                <a href="logout.php" onclick="return confirmLogout();" class="block py-1 px-2 text-gray-600 hover:bg-gray-200">Logout</a>
            </div>
        </div>
        <!-- <a href="notification.php" class="text-gray-600 mx-4 txt">Notifications</a> -->
    </nav>
</footer><br><br><br>

    <!-- User and Product Information -->
   
<div class="max-w-6xl mx-auto">
    <h1 class="text-3xl font-semibold mb-8">Listed Products</h1>

    <div class="grid grid-cols-3 gap-6">
        <?php
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

        // Fetch product information along with user details
        $sql = "SELECT t.product_image, t.product_name, t.location, t.product_price, t.product_description, u.file, u.name 
                FROM traders t 
                INNER JOIN users u ON t.id = u.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user_image = $row["file"];
                $username = $row["name"];
                $product_image = $row["product_image"];
                $product_name = $row["product_name"];
                $location = $row["location"];
                $product_price = $row["product_price"];
                $product_description = $row["product_description"];

                echo "<div class='bg-white rounded-lg p-4 shadow-md'>";
                echo "<div class='flex items-center mb-2'>";
                echo "<img src='$user_image' class='w-8 h-8 rounded-full mr-2' alt='User Image'>";
                echo "<h2 class='text-lg font-semibold'>$username</h2>";
                echo "</div>";
                echo "<img src='$product_image' class='w-full mb-4 rounded-lg' alt='Product Image'>";
                echo "<h3 class='text-base font-semibold mb-1'>$product_name</h3>";
                echo "<p class='text-gray-600 mb-1'>$location</p>";
                echo "<p class='text-green-600 font-semibold mb-1'>$product_price</p>";
                echo "<p class='text-gray-700 mb-2'>$product_description</p>";
                echo "<a href='messaging.php' class='bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full inline-block'>Message Seller</a>";
                echo "</div>";
            }
        } else {
            echo "<p class='text-gray-600'>No products found.</p>";
        }

        // Close connection
        $conn->close();
        ?>
    </div>

</div>
    <!-- Script for dropdowns -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                // Toggle the 'dropdown-active' class on the parent nav item
                this.parentNode.classList.toggle('dropdown-active');
            });
        });
    });
</script>
<!-- script for logout -->
<script>
        function confirmLogout() {
            // Display a confirmation popup
            if (confirm("Are you sure you want to logout?")) {
                // If user confirms, redirect to logout page
                window.location.href = "logout.php"; // Replace "logout.php" with your logout URL
            } else {
                // If user cancels, do nothing
                return false;
            }
        }
    </script>
</body>
</html>
