<?php
// Start the session
session_start();

// Database connection details
$servername = "localhost"; // Replace with your server name if different
$username = "root";        // Replace with your database username
$password = "";            // Replace with your database password
$dbname = "productdb";     // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetching all cart items from the 'cart' table
$query = "SELECT * FROM cart";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Error fetching cart items: ' . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    die('No items in the cart.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Add your CSS here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            flex-direction: column;
            align-items: center;
            display: flex;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #55cb43;
            color: white;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }

        button {
            padding: 10px 20px;
            background-color: #55cb43;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a037;
        }
        .header {
            width: 100%;
            padding: 10px;
            display: flex;
            align-items: center;
            background-color: rgba(253, 253, 253, 0.856);
            margin-bottom: 40px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
            color: rgb(29, 29, 29);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 10;
            justify-content: space-between;
        }

        .header img {
            height: 60px;
            margin-right: 20px;
            animation: beat 1s infinite;
        }

        @keyframes beat {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .header .icons {
            display: flex;
            gap: 15px; /* Space between the icons */
        }

        .header .icons a {
            text-decoration: none;
            color: white;
            font-size: 24px; /* Icon size */
        }

        .header .icons a:hover {
            color: #55cb43;
        }

        @media (max-width: 900px) {
            .header {
                flex-direction: column;
                align-items: center;
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
            background: rgba(255, 255, 255, 0.479);
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

        .menu-icon {
            font-size: 28px;
            margin-right: 20px;
            color: #333;
            cursor: pointer;
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 50px;
            right: 0;
            background-color: rgba(253, 253, 253, 0.95);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
            width: 180px;
            z-index: 1000;
        }
        .dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
            font-size: 18px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .dropdown-menu a:hover {
            background-color: #55cb43;
            color: #fff;
        }

        .dropdown-menu a i {
            margin-right: 10px;
            font-size: 18px;
        }
        .box {
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.452);
            background-color: whitesmoke;
            border-radius: 20px;
            color: black;
            text-align: center;
            width: 100%;
            max-width: 900px;
            margin-right: 90px;
            margin-top: 100px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="home.html">
        <img src="logo.png" alt="Logo">
        </a>
        <div class="menu-container">
            <i class="fas fa-bars menu-icon" onclick="toggleMenu()"></i>
            <div class="dropdown-menu" id="dropdownMenu">
                <a href="consumer-dashboard.html"><i class="fas fa-chart-line"></i>&nbsp;Dashboard</a>
                <a href="signin.html"><i class="fas fa-sign-out-alt"></i>&nbsp; Logout</a>
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
    <div class="box">
    <h2>Your Cart</h2>
    <table border="1">
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        <?php
        $grand_total = 0;
        while($row = mysqli_fetch_assoc($result)) {
            $total_price = $row['quantity'] * $row['price'];
            $grand_total += $total_price;
            echo "<tr>
                    <td>{$row['product_name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['price']}</td>
                    <td>$total_price</td>
                  </tr>";
        }
        ?>
        <tr>
            <td colspan="3"><strong>Grand Total</strong></td>
            <td><strong><?php echo $grand_total; ?></strong></td>
        </tr>
    </table>

   <!-- Buy Now Button -->
<form action="order_details.html" method="get">
    <button type="submit">Buy Now</button>
</form>
</div>
<script>  function toggleMenu() {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
}
// Close dropdown when clicking outside
window.onclick = function(event) {
    if (!event.target.matches('.menu-icon')) {
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (dropdownMenu.style.display === 'block') {
            dropdownMenu.style.display = 'none';
        }
    }
}
</script></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>