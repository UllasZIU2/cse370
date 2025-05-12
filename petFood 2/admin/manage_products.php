<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

include 'db_connect.php';
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Products</h1>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='product'>
                    <img src='" . $row['image_url'] . "' alt='" . $row['name'] . "' />
                    <h3>" . $row['name'] . "</h3>
                    <p>" . $row['description'] . "</p>
                    <p>Price: $" . $row['price'] . "</p>
                    <a href='edit_product.php?id=" . $row['id'] . "'>Edit</a>
                    <a href='delete_product.php?id=" . $row['id'] . "'>Delete</a>
                </div>";
        }
    } else {
        echo "No products found.";
    }

    $conn->close();
    ?>
</body>
</html>
