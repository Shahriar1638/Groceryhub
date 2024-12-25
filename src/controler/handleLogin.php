<?php
require_once('DBconnect.php');
if(isset($_POST['email']) && isset($_POST['password'])){
    $e = $_POST['email'];
    $p = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email = '$e' AND password = '$p'";
    $result = mysqli_query($conn, $sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];
        $username = $row['username']; 
        $email = $row['email'];

        // -----------
        if ($role == 'seller'){
            $sql = "SELECT * FROM sellers WHERE email = '$e'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $revenue = $row['revenue'];
            setcookie('loyaltyPoints', '', time() + (86400 * 30), "/");
            setcookie('revenue', '', time() + (86400 * 30), "/");
            setcookie('revenue', $revenue, time() + (86400 * 30), "/");
        }
        else if ($role == 'admin'){
            $sql = "SELECT * FROM admins WHERE email = '$e'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        }
        else if ($role == 'customer'){
            $sql = "SELECT * FROM customers WHERE email = '$e'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $loyaltyPoints = $row['points'];
            setcookie('revenue', '', time() + (86400 * 30), "/");
            setcookie('loyaltyPoints', '', time() + (86400 * 30), "/");
            setcookie('loyaltyPoints', $loyaltyPoints, time() + (86400 * 30), "/");
        }
        $userID = $row[$role.'ID'];

        // -----------
        setcookie('userID', '', time() + (86400 * 30), "/");
        setcookie('userID', $userID, time() + (86400 * 30), "/");
        setcookie('username', '', time() + (86400 * 30), "/");
        setcookie('username', $username, time() + (86400 * 30), "/");
        setcookie('email', '', time() + (86400 * 30), "/");
        setcookie('email', $email, time() + (86400 * 30), "/");
        setcookie('role', '', time() + (86400 * 30), "/");
        setcookie('role', $role, time() + (86400 * 30), "/");
        
        // -----------
        
        if ($role == 'seller' || $role == 'customer'){
            header("Location: ../viewer/Homepage.php");
        }
        else if ($role == 'admin'){
            header("Location: ../viewer/publishedItems.php");
        }
        // else if ($role == 'customer'){
        //     header("Location: ../viewer/customerHome.php");
        // }
    }
    else{
        header("Location: ../viewer/login.php");
    }
}
?>
