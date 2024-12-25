<?php
require_once('DBconnect.php');
if (isset($_POST['rating'])) {
    $newrating = $_POST['rating'];
    $productid = $_POST['productId'];
    $query = "SELECT * FROM products WHERE productId = '$productid'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $rating = $row['rating'];
        $numOfPeople = $row['numOfPeople'];
        if ($numOfPeople == 0) {
            $numOfPeople = 1;
            $avgRating = $newrating;
            $query = "UPDATE products SET rating = '$avgRating', numOfPeople = '$numOfPeople' WHERE productId = '$productid'";
        } else {
            $numOfPeople++;
            $avgRating = ( ($rating * ($numOfPeople-1)) + $newrating )/ $numOfPeople;
            $query = "UPDATE products SET rating = '$avgRating', numOfPeople = '$numOfPeople' WHERE productId = '$productid'";
        }
        
        mysqli_query($conn, $query);
        header('Location: ../viewer/allItems.php');
    } else {
        echo "Error";
    }
}
?>