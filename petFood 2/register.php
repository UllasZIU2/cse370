<?php
include 'includes/db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    // Check if the username already exists
    $check_query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        // Username or Email already exists
        echo "Username or Email already exists. Please try another.";
    } else {
        // Hash password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into the database
        $insert_query = "INSERT INTO users (email, username, password, phone) VALUES ('$email', '$username', '$hashed_password', '$phone')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Registration successful!";
            header("Location: login.html");  // Redirect to login page after successful registration
            exit(); // Ensure no further code is executed
        } else {
            echo "Error: " . $conn->error;
        }
    }
    $conn->close(); // Close the database connection
}
?>
