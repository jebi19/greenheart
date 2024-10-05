<?php
// Database connection details
$servername = "localhost";
$username = "root";  // Replace with your database username
$password = "";      // Replace with your database password
$dbname = "productdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to select products where 'sell_to' is 'Individual'
$sql = "SELECT id, productName, quantity, price, sell_to FROM products WHERE sell_to = 'Individual'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Individual Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
            * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            color: #fff;
        }

        /* Header Styles */
        .header {
            width: 100%;
            padding: 10px;
            display: flex;
            align-items: center;
            background-color: rgba(248, 246, 246, 0.856);
            margin-bottom: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            color: rgb(10, 10, 10);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            justify-content: space-between; /* Aligns items on each side */
        }

        .header img {
            height: 60px;
            margin-right: 20px;
            animation: beat 1s infinite;
        }

        @keyframes beat {
            0%, 100% {
                transform: scale(1); /* Normal size */
            }
            50% {
                transform: scale(1.1); /* Slightly larger */
            }
        }

        .header a {
            text-decoration: none;
            color: black;
        }

        .menu-container {
            display: flex;
            align-items: center;
        }

        .translate-menu {
    margin-right: 20px; /* Space between translate and menu icon */
    position: relative;
    top: 10px; /* Adjust this value to move it lower */
}

        .menu-icon {
            font-size: 24px;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 40px;
            right: 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 11;
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            text-decoration: none;
            color: black;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
        }

        .dropdown-menu a i {
            margin-right: 10px;
        }

        .dropdown-menu a:hover {
            background-color: #55cb43;
            color: white;
        }

        /* Box Styling */
        .box {
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.452);
            background-color: whitesmoke;
            border-radius: 20px;
            color: black;
            text-align: center;
            width: 100%;
            max-width: 900px;
            margin-top: 150px;
            overflow-x: auto;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: #f4f4f4;
            color: #333;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #55cb43;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .header {
                flex-direction: column;
                align-items: center;
            }

            .box {
                width: 90%;
            }
        }
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to left, #73ee3e, #55cb43);
            overflow: hidden;
            z-index: -1;
        }

        /* Circles for Animation */
        .circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .circles li {
            position: absolute;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.253);
            animation: animate 25s linear infinite;
            bottom: -150px;
        }

        /* Circle Positions and Sizes */
        .circles li:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }

        .circles li:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }

        .circles li:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }

        .circles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }

        .circles li:nth-child(5) {
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
        }

        .circles li:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }

        .circles li:nth-child(7) {
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
        }

        .circles li:nth-child(8) {
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }

        .circles li:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
        }

        .circles li:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
        }

        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }
        #google_translate_element {
    position: relative;
    z-index: 999;
    padding: 5px;
    border-radius: 4px;
}

    </style>
</head>
<body>

    <header class="header">
        <a href="home.html">
            <img src="logo.png" alt="Logo">
        </a>
        <div class="menu-container">
            <div id="google_translate_element" class="translate-menu"></div>
            <i class="fas fa-bars menu-icon" onclick="toggleMenu()"></i>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="farmer-dashboard.html"><i class="fas fa-house"></i>&nbsp;Home Page</a>
                <a href="signin.html"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
            </div>
        </div>
    </header>    
    <div class="background">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <!-- Main Content -->
    <div class="box">
        <h2>Individual Products List</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Product Name</th><th>Quantity(Kg)</th><th>Price(Rs)</th><th>Sell To</th></tr>";
            
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["productName"]. "</td><td>" . $row["quantity"]. "</td><td>" . $row["price"]. "</td><td>" . $row["sell_to"]. "</td></tr>";
            }
            
            echo "</table>";
        } else {
            echo "<p>No products found.</p>";
        }
        
        $conn->close();
        ?>
    </div>

    <script>
        function toggleMenu() {
        var dropdownMenu = document.getElementById('dropdownMenu'); // Matching the correct ID
        dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
    }

    // Close dropdown when clicking outside
    window.onclick = function (event) {
        if (!event.target.matches('.menu-icon')) {
            var dropdownMenu = document.getElementById('dropdownMenu');
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            }
        }
    }
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'google_translate_element'
            );
        }
     </script>
     
     <script type="text/javascript"
            src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
     </script>    

</body>
</html>