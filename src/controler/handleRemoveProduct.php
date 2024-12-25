<?php
require('DBconnect.php');
if (isset($_POST['productid'])) {
    $product_id = $_POST['productid'];
    $query = "DELETE FROM products WHERE productId = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        echo "Product removed successfully.";
        header("Location: ../viewer/pendingProduct.php");
    } else {
        echo "Error removing product: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Product ID not provided.";
}
$conn->close();
?>