<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

include 'db_connect.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $delete_sql = "DELETE FROM products WHERE id = $product_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Product deleted successfully!";
        header('Location: manage_products.php');
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
