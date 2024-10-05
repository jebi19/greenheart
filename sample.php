<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Include Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #55cb43;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .header {
            background: whitesmoke;
            padding: 10px;
            color: black;
            display: flex;
            align-items: center;
            width: 100%;
            position: absolute;
            top: 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            justify-content: space-between; 
        }

        .header img {
            height: 60px;
            margin-right: 20px;
            margin-left: 10px;
            animation: beat 1s infinite ;
        }
        @keyframes beat {
             0%, 100% {
                 transform: scale(1); /* Normal size */
             }
            50% {
              transform: scale(1.1); /* Slightly larger */
             }
        }

        

        .header .icons {
            display: flex;
            gap: 20px; /* Increased space between the icons */
            margin-left: auto; /* Pushes the icons to the right side */
        }

        .header .icons a {
            text-decoration: none;
            color: black;
            font-size: 24px; /* Icon size */
        }
        .header .icons a:hover{
            color: #55cb43;
            transform: scale(1.1);
        }


        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* Four columns for four boxes */
            gap: 20px;
            padding: 20px;
            margin-top: 80px; /* Pushes the container below the header */
            place-items: center; /* Centers items within the container */
        }

        .box {
            width: 300px; 
            height: 300px; 
            background-color: #55cb43;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: black;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            border: 2px groove springgreen;
            color: white;
            position: relative;
        }

        .box:hover {
            transform: scale(1.02);
            box-shadow: inset 5px 5px 10px #131f0ebd;
        }

        /* Text overlay */
        .box span {
            position: absolute;
            bottom: 0;
            width:270px;
            border-radius: 5px;
            padding: 15px;
            background: rgba(0, 0, 0, 0.7);
            font-size: 1.2rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sell-products {
            background-image: url('sellproducts.jpg'); /* Replace with actual image paths */
        }

        .view-orders {
            background-image: url('vieworders.jpg'); /* Replace with actual image paths */
        }

        .sell-to {
            background-image: url('sellto.jpg'); /* Replace with actual image paths */
        }

        .view-products {
            background-image: url('viewproducts.jpg'); /* Replace with actual image paths */
        }

        /* Media Query for smaller screens (e.g., tablets and phones) */
        @media (max-width: 1024px) {
            .container {
                grid-template-columns: 1fr 1fr; /* Two columns for medium screens */
            }
        }

        /* Media Query for very small screens (e.g., phones) */
        @media (max-width: 600px) {
            .container {
                grid-template-columns: 1fr; /* One column for small screens */
            }

            .box {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="logo.jpg" alt="Logo">
        <div class="icons">
            <a href="home.html" title="Home"><i class="fas fa-home"></i></a>
            <a href="role.html" title="Role"><i class="fas fa-user"></i></a>
        </div>
    </div>

    <div class="container">
        <a href="sell_product.html" class="box sell-products"><span>Sell Products</span></a>
        <a href="view_orders.html" class="box view-orders"><span>View Orders</span></a>
        <a href="sell_to.html" class="box sell-to"><span>Sell To</span></a>
        <a href="view_products.php" class="box view-products"><span>View Products</span></a>


    </div>

</body>
</html>

