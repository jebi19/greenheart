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
    <!-- Add your CSS here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
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
    </style>
</head>
<body>
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

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
