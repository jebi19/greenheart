<?php
// Database connection settings
$host = 'localhost'; // Change to your database host
$dbname = 'productdb'; // Change to your database name
$username = 'root'; // Change to your database username
$password = ''; // Change to your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve cart items from query parameter or session (adjust as needed)
    $cartItems = json_decode($_GET['cartItems'] ?? '[]', true);

    // Initialize an empty array to hold the fetched products
    $productsInCart = [];

    // Loop through each cart item to fetch details from the database
    foreach ($cartItems as $cartItem) {
        // Ensure productId is set and valid
        if (isset($cartItem['productId']) && isset($cartItem['quantity'])) {
            $stmt = $pdo->prepare("SELECT productName, price FROM products WHERE id = :id");
            $stmt->bindParam(':id', $cartItem['productId'], PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $product['quantity'] = $cartItem['quantity'];
                $product['total'] = $product['price'] * $cartItem['quantity'];
                $productsInCart[] = $product;
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
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
    </style>
</head>
<body>

    <h2>Your Cart</h2>

    <?php if (count($productsInCart) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $grandTotal = 0;
                foreach ($productsInCart as $product):
                    $grandTotal += $product['total'];
                ?>
                <tr>
                    <td><?= htmlspecialchars($product['productName']) ?></td>
                    <td><?= htmlspecialchars($product['quantity']) ?></td>
                    <td>$<?= htmlspecialchars(number_format($product['price'], 2)) ?></td>
                    <td>$<?= htmlspecialchars(number_format($product['total'], 2)) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">
            Grand Total: $<?= htmlspecialchars(number_format($grandTotal, 2)) ?>
        </div>

    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>

</body>
</html>
