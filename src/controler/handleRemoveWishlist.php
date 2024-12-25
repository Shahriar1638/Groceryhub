<?php

require_once('DBconnect.php');
if (isset($_POST['customeremail']) && isset($_POST['productid'])){
    $customeremail = $_POST['customeremail'];
    $productid = $_POST['productid'];
    $query = "DELETE FROM wishlist WHERE productId = '$productid' AND customer_email = '$customeremail'";
    if (mysqli_query($conn, $query)){
        header("Location: ../viewer/profile.php");
    } else {
        echo "Failed to add product to wishlist";
    }
} else {
    echo "Failed to add product to wishlist";
}

?>