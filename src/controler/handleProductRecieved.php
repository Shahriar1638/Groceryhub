<?php 
require_once('DBconnect.php');
$transactionid = $_POST['transactionid'];
$query = "UPDATE payment SET progression = 'received' WHERE transactionID = '$transactionid'";
$result = mysqli_query($conn, $query);
if ($result){
    header('Location: ../viewer/Paymenthistory.php');

} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>
