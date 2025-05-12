<?php
session_start(); // Start a session to track the user

include 'includes/db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the username exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, start a session for the user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['logged_in'] = true;

            // Redirect the user to the homepage or dashboard
            header('Location: index.html');
            exit(); // Ensure no further code is executed after redirection
        } else {
            // Invalid password
            echo "Invalid password. Please try again.";
        }
    } else {
        // No user found with the given username
        echo "No user found with that username. Please try again.";
    }

    $conn->close(); // Close the database connection
}
?>
