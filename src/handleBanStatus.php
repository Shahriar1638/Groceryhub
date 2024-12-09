<?php
require_once('DBconnect.php');
if (isset($_POST['action']) && isset($_POST['email'])){
    $action = $_POST['action'];
    $email = $_POST['email'];
    if ($action == 'ban'){
        $query = "UPDATE users SET ban_status = '0' WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result){
            header('Location: sellerList.php');
        }
    } else if ($action == 'unban'){
        $query = "UPDATE users SET ban_status = '1' WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result){
            header('Location: sellerList.php');
        }
    }
    
}
?>