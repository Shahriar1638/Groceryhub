<?php 
require('DBconnect.php');
if (isset($_POST['role']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
    $role = $_POST['role'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO users (role, username, email, password) VALUES ('$role', '$username', '$email', '$password')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if ($role == 'customer') {
            $points = 0;

            // checking the last row to generate new customerID
            $tempsql = "SELECT * FROM customers ORDER BY customerID DESC LIMIT 1";
            $tempresult = mysqli_query($conn, $tempsql);
            $row = mysqli_fetch_assoc($tempresult);
            $lastCustomerID = $row['customerID'];
            $prefix = substr($lastCustomerID, 0, 3); 
            $number = substr($lastCustomerID, 3);
            $number = (int)$number + 1;
            $newsuffix = "00" . $number;
            $newID = $prefix . $newsuffix;

            // continue with inserting new customer
            $sql = "INSERT INTO customers (customerID, email, points) VALUES ('$newID','$email', '$points')";
            $result = mysqli_query($conn, $sql);
            if (mysqli_affected_rows($conn)) {
                header("Location: login.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else if ($role == 'seller') {
            $revenue = 0;
            $numOfApproved = 0;
            $numOfReject = 0;

            // checking the last row to generate new sellerID
            $tempsql = "SELECT * FROM sellers ORDER BY sellerID DESC LIMIT 1";
            $tempresult = mysqli_query($conn, $tempsql);
            $row = mysqli_fetch_assoc($tempresult);
            $lastSellerID = $row['sellerID'];
            $prefix = substr($lastSellerID, 0, 3);
            $number = substr($lastSellerID, 3);
            $number = (int)$number + 1;
            $newsuffix = "00" . $number;
            $newID = $prefix . $newsuffix;

            // continue with inserting new seller
            $sql = "INSERT INTO sellers (sellerID,email, revenue, numOfApproved, numOfReject) VALUES ('$newID','$email', '$revenue', '$numOfApproved', '$numOfReject')";
            $result = mysqli_query($conn, $sql);
            if (mysqli_affected_rows($conn)) {
                header("Location: login.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        // header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>