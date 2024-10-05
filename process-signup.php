<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farm_market"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];
$location = $_POST['location'];
$phone = $_POST['phone'];
$security_question = $_POST['security-question'];
$security_answer = $_POST['security-answer'];
$role = $_POST['role']; // Get the selected role

// Validate form data
$errors = [];

if (empty($username)) {
    $errors[] = "Username is required";
}

if (empty($password)) {
    $errors[] = "Password is required";
}

if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match";
}

if (empty($location)) {
    $errors[] = "Location is required";
}

if (empty($phone)) {
    $errors[] = "Phone number is required";
}

if (empty($security_question)) {
    $errors[] = "Security question is required";
}

if (empty($security_answer)) {
    $errors[] = "Security answer is required";
}

if (empty($role)) {
    $errors[] = "Role selection is required";
}

// If there are no errors, proceed to save the user
if (empty($errors)) {
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, password, location, phone, security_question, security_answer, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $username, $hashed_password, $location, $phone, $security_question, $security_answer, $role);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to different dashboards based on the role
        if ($role === 'farmer') {
            header("Location: farmer-dashboard.html");
        } elseif ($role === 'consumer') {
            header("Location: consumer-dashboard.html");
        }
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Display errors
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
}

// Close the database connection
$conn->close();
?>
