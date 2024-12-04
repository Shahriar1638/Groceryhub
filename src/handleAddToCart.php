<!-- Mehraaj -->
<?php 
require('DBconnect.php');
if (isset($_POST['productname']) && isset($_POST['productprice']) && isset($_POST['customeremail']) && isset($_POST['productid']) && isset($_POST['productamount']) && isset($_POST['selleremail'])){
    $customeremail = $_POST['customeremail'];
    $productid = $_POST['productid'];
    $productName = $_POST['productname'];
    $productPrice = $_POST['productprice'];
    $productamount = $_POST['productamount'];
    $selleremail = $_POST['selleremail'];
    $sql = "SELECT COUNT(*) AS count FROM carts WHERE customeremail = '$customeremail' AND productid = '$productid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];
        // we check if product already exist or not so that we can update quantity
        if ($count == 1) {
            $sql = "UPDATE carts SET productamount = productamount + $productamount WHERE customeremail = '$customeremail' AND productid = '$productid'";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: allItems.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        // Else we add them to the cart
        } else {
            $sql = "INSERT INTO carts (customeremail, productid, productname, price, productamount, selleremail) VALUES ('$customeremail', '$productid', '$productName', '$productPrice', '$productamount', '$selleremail')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: allItems.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>