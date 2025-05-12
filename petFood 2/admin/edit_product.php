<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: login.php');
    exit;
}

include 'db_connect.php';
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'];

    $update_sql = "UPDATE products SET name='$name', description='$description', price='$price', image_url='$image_url' WHERE id=$product_id";
    if ($conn->query($update_sql) === TRUE) {
        echo "Product updated successfully!";
        header('Location: manage_products.php');  // Redirect after update
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Product</h1>
    <form method="POST" action="edit_product.php?id=<?php echo $product['id']; ?>">
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
        <textarea name="description" required><?php echo $product['description']; ?></textarea>
        <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
        <input type="text" name="image_url" value="<?php echo $product['image_url']; ?>" required>
        <button type="submit" name="submit">Update Product</button>
    </form>
</body>
</html>
