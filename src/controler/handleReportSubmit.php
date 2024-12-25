<?php
require_once('DBconnect.php');
if (isset($_POST['email']) && isset($_POST['message'])){
    $email = $_POST['email'];
    $message = $_POST['message'];
    $selleremail = $_POST['selleremail'];
    $replymessage = "";
    $status = "0";
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result){
        $row = mysqli_fetch_assoc($result);
        $name = $row['username'];
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return;
    }
    $time = date("Y-m-d H:i:s");
    $sql = "INSERT INTO reports (reporter_name, reporter_email, message, time, replymessage, status, selleremail) VALUES ('$name', '$email', '$message', '$time', '$replymessage', '$status', '$selleremail')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../viewer/allItems.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>