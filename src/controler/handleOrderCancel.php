<?php 
require_once('DBconnect.php');
$transactionid = $_POST['transactionid'];
$query = "UPDATE payment SET progression = 'cancelled' WHERE transactionID = '$transactionid'";
$result = mysqli_query($conn, $query);
if ($result){
    $query = "SELECT * FROM payment WHERE transactionID = '$transactionid'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_assoc($result);
    $newPoints = $rows['point_consumed'];
    $useremail = $_COOKIE['email'];
    $query = "UPDATE customers SET points = points+'$newPoints' WHERE email = '$useremail'";
    $result = mysqli_query($conn, $query);

    $query = "SELECT * FROM customers WHERE email = '$useremail'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $loyaltyPoints = $row['points'];

    setcookie('loyaltyPoints', '', time() - 3600, "/");
    setcookie('loyaltyPoints', $loyaltyPoints, time() + (86400 * 30), "/");

    if ($result) {
        header('Location: ../viewer/Paymenthistory.php');
    }

} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>
