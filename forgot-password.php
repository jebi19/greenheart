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
    $username = $_POST['reset-username'];
    $security_question = $_POST['security-question'];
    $security_answer = trim(strtolower($_POST['security-answer'])); // Normalize input
    $new_password = $_POST['reset-password'];

    if (empty($username) || empty($security_question) || empty($security_answer) || empty($new_password)) {
        echo "All fields are required.";
    } else {
        $stmt = $conn->prepare("SELECT security_answer FROM users WHERE username = ? AND security_question = ?");
        $stmt->bind_param("ss", $username, $security_question);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($stored_answer);
            $stmt->fetch();

            if (trim(strtolower($stored_answer)) === $security_answer) { // Case-insensitive comparison
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                $update_stmt->bind_param("ss", $hashed_password, $username);

                if ($update_stmt->execute()) {
                    // Redirect to sign-in page after successful password reset
                    header("Location: signin.html");
                    exit(); // Ensure no further code is executed after redirection
                } else {
                    echo "Error updating password.";
                }

                $update_stmt->close();
            } else {
                echo "Incorrect security answer.";
            }
        } else {
            echo "Incorrect username or security question.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
