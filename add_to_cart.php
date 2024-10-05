<?php
// Database connection settings
$host = 'localhost';
$dbname = 'productdb';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare an SQL statement for inserting data into the 'cart' table
    $stmt = $pdo->prepare("INSERT INTO cart (product_name, quantity, price) VALUES (:product_name, :quantity, :price)");

    // Check if cartItems are set in the POST request
    if (isset($_POST['cartItems']) && is_array($_POST['cartItems'])) {
        // Debug output to check the contents of $_POST['cartItems']
        echo '<pre>';
        print_r($_POST['cartItems']);
        echo '</pre>';

        foreach ($_POST['cartItems'] as $itemJson) {
            $item = json_decode($itemJson, true);

            // Ensure that 'product_name', 'quantity', and 'price' exist in the item
            if (is_array($item) && isset($item['name'], $item['quantity'], $item['price'])) {
                // Bind parameters and execute the statement
                $stmt->bindParam(':product_name', $item['name']);
                $stmt->bindParam(':quantity', $item['quantity']);
                $stmt->bindParam(':price', $item['price']);
                $stmt->execute();
            } else {
                // Handle the case where the item does not have the expected keys
                echo "Error: Invalid item data.";
                exit;
            }
        }

        // Redirect to the consumer-dashboard.html page after successful insertion
        header("Location: consumer-dashboard.html");
        exit(); // Ensure that no further code is executed after the redirect

    } else {
        echo "No items to add to the cart.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
