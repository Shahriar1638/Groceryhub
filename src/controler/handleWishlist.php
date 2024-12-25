<?php 
require_once('DBconnect.php');
if (isset($_POST['customeremail']) && isset($_POST['productid'])){
    $customeremail = $_POST['customeremail'];
    $productid = $_POST['productid'];
    $query = "INSERT INTO wishlist (productId, customer_email) VALUES ( '$productid', '$customeremail')";
    if (mysqli_query($conn, $query)){
        header("Location: ../viewer/allItems.php");
    } else {
        echo "Failed to add product to wishlist";
    }
} else {
    echo "Failed to add product to wishlist";
}

?>