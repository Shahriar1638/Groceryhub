<?php
require_once('DBconnect.php');
if (isset($_POST['action']) && isset($_POST['email']) && isset($_POST['user'])){
    $action = $_POST['action'];
    $email = $_POST['email'];
    $user = $_POST['user'];
    if ($action == 'ban'){
        $query = "UPDATE users SET ban_status = '0' WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result){
            if ($user == 'customer'){
                header('Location: ../viewer/customerList.php');
            } else if ($user == 'seller'){
                header('Location: ../viewer/sellerList.php');
            }
        }
    } else if ($action == 'unban'){
        $query = "UPDATE users SET ban_status = '1' WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if ($result){
            header('Location: ../viewer/sellerList.php');
        }
    }
}
?>