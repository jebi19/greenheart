<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm_market";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare statement to fetch password and role from the database
    $stmt = $conn->prepare("SELECT password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($stored_password, $role);
        $stmt->fetch();

        if (password_verify($password, $stored_password)) {
            // Redirect based on the user's role
            if ($role == 'farmer') {
                header("Location: farmer-dashboard.html");
            } elseif ($role == 'consumer') {
                header("Location: consumer-dashboard.html");
            } else {
                echo "Invalid role.";
            }
            exit(); // Ensure no further code is executed after redirection
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Incorrect username.";
    }

    $stmt->close();
}

$conn->close();
?>
