<?php
require_once('DBconnect.php');
if (isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productAmount']) && isset($_POST['sellerEmail']) && isset($_POST['productCategory']) && isset($_POST['productImage'])){
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productAmount = $_POST['productAmount'];
    $sellerEmail = $_POST['sellerEmail'];
    $productCategory = $_POST['productCategory'];
    $productImage = $_POST['productImage'];
    $sellcount = 0;
    $publishdate = date("Y-m-d");
    $status = "pending";
    $query = "INSERT INTO products (name, imgurl, price, ammount, publishdate, selleremail, sellcount, category, status) VALUES ('$productName', '$productImage', '$productPrice', '$productAmount', '$publishdate', '$sellerEmail', '$sellcount', '$productCategory', '$status')";
    $result = mysqli_query($conn, $query);
    if ($result){
        header("Location: addProducts.php");
    } else {
        echo "failed";
    }
} 
?>