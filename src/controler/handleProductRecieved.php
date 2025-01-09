<?php 
require_once('DBconnect.php');
$transactionid = $_POST['transactionid'];
$query = "UPDATE payment SET progression = 'received' WHERE transactionID = '$transactionid'";
$result = mysqli_query($conn, $query);
if ($result){
    $query = "SELECT * FROM payment WHERE transactionID = '$transactionid'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_assoc($result);
    $points = $rows['point_consumed'];
    $useremail = $_COOKIE['email'];
    $query = "UPDATE customers SET points = points+'$newPoints' WHERE email = '$useremail'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('Location: ../viewer/Paymenthistory.php');
    }

} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>
