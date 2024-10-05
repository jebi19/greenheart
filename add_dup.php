<?php
// Assuming you have established a connection to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "productdb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve cart items from POST request
$cartItems = $_POST['cartItems'] ?? [];

if (count($cartItems) > 0) {
    foreach ($cartItems as $item) {
        $itemData = json_decode($item, true);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO cart (product_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isid", $itemData['id'], $itemData['name'], $itemData['quantity'], $itemData['price']);

        // Execute the query
        $stmt->execute();
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();

// Redirect to consumer-dashboard.html
header("Location: consumer-dashboard.html");
exit();
?>
