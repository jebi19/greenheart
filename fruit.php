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

// Query to select only products with category 'Fruits'
$sql = "SELECT id, productName, quantity, price,image_path FROM products WHERE category = 'Fruits'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products - Fruits</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('leaf.jpg') no-repeat center center fixed;
            background-size: cover;
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

        .box {
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.452);
            background-color: whitesmoke;
            border-radius: 20px;
            color: black;
            text-align: center;
            width: 100%;
            max-width: 900px;
            margin-top: 100px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
            background-color: #f4f4f4;
            color: #333;
        }

        th, td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
    font-weight: bold; /* Makes the text bold */
    font-size: 16px; /* Adjust the size as needed */
}

th {
    background-color: #55cb43;
    color: white;
    font-size: 18px; /* Slightly larger size for headers */
}


        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .quantity-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-container button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .quantity-container button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .quantity-container input {
            width: 60px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin: 0 10px;
            font-size: 16px;
        }

        .add-to-cart {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }

        .add-to-cart:hover {
            background-color: #218838;
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
        .menu-icon {
            font-size: 28px;
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
        /* Style for product image container */
.product-image-container {
    position: relative;
    width: 200px;
    height: 200px; 
    justify-contents:center;
    overflow: hidden;
}

.product-image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensures image covers the container */
}

/* Style for the text overlay */
.product-image-container .product-name {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(0, 0, 0, 0.7); /* Transparent black background */
    color: white;
    text-align: center;
    padding: 5px;
    font-size: 14px; /* Adjust font size as needed */
}
.add-to-cart {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Center Add to Cart column in the table */
table td:last-child {
    text-align: center;
}
@import url(https://fonts.googleapis.com/css?family=Khula:700);
.console-container {
            font-family: Khula;
            font-size: 4em;
            text-align: center;
            height:5px;
            width: 600px;
            display: block;
            color: white;
            margin-top: 100px; /* Space between the header and text animation */
            z-index: 1; /* Ensure the text is above the background circles */
        }
.console-underscore {
   display:inline-block;
  position:relative;
  top:-0.14em;
  left:10px;
}
    </style></head>
<body>

    <!-- Header Section -->
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
    
    <div class='console-container'><span id='text'></span><div class='console-underscore' id='console'>&#95;</div></div>

    <div class="box">
        <h2>Products List</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th> <!-- New column for images -->
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Add to Cart</th>
                </tr>
            </thead>
            <tbody id="productList">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>";  // Start of the combined column
                        echo "<div class='product-image-container'>";
                        echo "<img src='" . $row["image_path"] . "' alt='" . $row["productName"] . "'>";
                        echo "<div class='product-name'>" . $row["productName"] . "</div>";
                        echo "</div>";
                        echo "</td>";  // End of the combined column                        
                        echo "<td>" . $row["quantity"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td>";
                        echo "<div class='quantity-container'>";
                        echo "<button onclick='decrementQuantity(".$row["id"].")'>-</button>";
                        echo "<input type='number' id='quantity-".$row["id"]."' value='0' min='0' max='".$row["quantity"]."' readonly>";
                        echo "<button onclick='incrementQuantity(".$row["id"].")'>+</button>";
                        echo "<div>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No products found.</td></tr>";  // Adjust colspan to match the number of columns
                }
                $conn->close();
                ?>
            </tbody>
        </table>

        <button class="add-to-cart" onclick="proceedToCart()">Proceed to Cart</button>
</div>


    <script>
        function decrementQuantity(productId) {
            const quantityInput = document.getElementById(quantity-${productId});
            if (quantityInput.value > 0) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }

        function incrementQuantity(productId) {
            const quantityInput = document.getElementById(quantity-${productId});
            if (parseInt(quantityInput.value) < parseInt(quantityInput.max)) {
                quantityInput.value = parseInt(quantityInput.value) + 1;
            }
        }

        function proceedToCart() {
            const selectedProducts = [];
            
            const rows = document.querySelectorAll('#productList tr');
            
            rows.forEach(row => {
                const productName = row.cells[0].textContent;
                const quantity = row.querySelector('input[type="number"]').value;
                const price = row.cells[2].textContent;
                
                if (quantity > 0) {
                    selectedProducts.push({
                        name: productName,
                        quantity: quantity,
                        price: parseFloat(price)
                    });
                }
            });

            if (selectedProducts.length > 0) {
                const cartItems = encodeURIComponent(JSON.stringify(selectedProducts));
                window.location.href = cart.php?cartItems=${cartItems};
            } else {
                alert('Please select at least one product.');
            }
        }
    </script>
    <script>
        function toggleMenu() {
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
        consoleText(['Top Picks.', 'FRUITS.', 'Made with Love❤.'], 'text',['black','maroon','white']);

function consoleText(words, id, colors) {
  if (colors === undefined) colors = ['#fff'];
  var visible = true;
  var con = document.getElementById('console');
  var letterCount = 1;
  var x = 1;
  var waiting = false;
  var target = document.getElementById(id)
  target.setAttribute('style', 'color:' + colors[0])
  window.setInterval(function() {

    if (letterCount === 0 && waiting === false) {
      waiting = true;
      target.innerHTML = words[0].substring(0, letterCount)
      window.setTimeout(function() {
        var usedColor = colors.shift();
        colors.push(usedColor);
        var usedWord = words.shift();
        words.push(usedWord);
        x = 1;
        target.setAttribute('style', 'color:' + colors[0])
        letterCount += x;
        waiting = false;
      }, 1000)
    } else if (letterCount === words[0].length + 1 && waiting === false) {
      waiting = true;
      window.setTimeout(function() {
        x = -1;
        letterCount += x;
        waiting = false;
      }, 1000)
    } else if (waiting === false) {
      target.innerHTML = words[0].substring(0, letterCount)
      letterCount += x;
    }
  }, 120)
  window.setInterval(function() {
    if (visible === true) {
      con.className = 'console-underscore hidden'
      visible = false;

    } else {
      con.className = 'console-underscore'

      visible = true;
    }
  }, 400)
}
    </script>
</body>
</html>