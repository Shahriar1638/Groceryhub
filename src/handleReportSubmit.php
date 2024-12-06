<?php
require_once('DBconnect.php');
if (isset($_POST['email']) && isset($_POST['message'])){
    $email = $_POST['email'];
    $message = $_POST['message'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    if ($result){
        $row = mysqli_fetch_assoc($result);
        $name = $row['username'];
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return;
    }
    echo $name;
    $sql = "INSERT INTO reports (reporter_name, reporter_email, message) VALUES ('$name', '$email', '$message')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: allItems.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>