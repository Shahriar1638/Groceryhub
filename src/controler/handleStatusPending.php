<?php
require('DBconnect.php');
if(isset($_POST['productid']) && isset($_POST['productstatus']) && isset($_POST['action'])){
    $productid = $_POST['productid'];
    $productstatus = $_POST['productstatus'];
    $action = $_POST['action'];
    $query = "UPDATE products SET status = '$action' WHERE productId = '$productid'";
    $result = mysqli_query($conn, $query);
    if($result){

        // get seller email
        $query = "select selleremail from products where productId = '$productid'";
        $result = mysqli_query($conn, $query);
        if($result){
            $row = mysqli_fetch_assoc($result);

            //set seller email to a varaible
            $selleremail = $row['selleremail'];
            if ($action == 'approve'){
                $query = "UPDATE sellers set numOfApproved = numOfApproved + 1 where email = '$selleremail'";
                $result = mysqli_query($conn, $query);
                if($result){
                    header("Location: ../viewer/pendingItems.php");
                }else{
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }}else{
                $query = "UPDATE sellers set numOfReject = numOfReject + 1 where email = '$selleremail'";
                $result = mysqli_query($conn, $query);
                if($result){
                    header("Location: ../viewer/pendingItems.php");
                }else{
                    echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }}
    }else{
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    }else{
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }}
?>