// db_connect.php
<?php
$servername = "localhost";
$username = "root"; // default MySQL username
$password = ""; // default MySQL password
$dbname = "pet_food_db"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
