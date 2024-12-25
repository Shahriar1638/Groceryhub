<?php 
require_once('DBconnect.php');
if (isset($_POST['productid']) && isset($_POST['customeremail'])){
    $productid = $_POST['productid'];
    $customeremail = $_POST['customeremail'];
    $sql = "DELETE FROM carts WHERE customeremail = '$customeremail' AND productId = '$productid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../viewer/Cart.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>