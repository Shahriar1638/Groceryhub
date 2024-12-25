<?php
require_once('DBconnect.php');
if (isset($_POST['action']) && isset($_POST['reportId'])){
    $action = $_POST['action'];
    $reportId = $_POST['reportId'];
    $query = "UPDATE reports SET status = '$action' WHERE report_id = '$reportId'";
    $result = mysqli_query($conn, $query);
    if ($result){
        header('Location: ../viewer/reportList.php');
    }
} 
?>