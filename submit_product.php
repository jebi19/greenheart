<?php
$servername = "localhost";  // Change this to your server name
$username = "root";  // Change this to your MySQL username
$password = "";  // Change this to your MySQL password
$dbname = "productdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$productName = $_POST['productName'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];
$category = $_POST['category'];
$sell_to = $_POST['sell_to'];

// Check for duplicates
$sql_check = "SELECT * FROM products WHERE productName = ? AND quantity = ? AND price = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("sid", $productName, $quantity, $price);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo json_encode(['status' => 'exists']);
} else {
    // Insert data
    $sql = "INSERT INTO products (productName, quantity, price, category, sell_to) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidss", $productName, $quantity, $price, $category, $sell_to);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $conn->error]);
    }
}

// Close connection
$conn->close();
?>
