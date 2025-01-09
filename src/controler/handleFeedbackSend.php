<?php
require_once('DBconnect.php');
if (isset($_POST['email']) && isset($_POST['feedback'])){
    $feedbackmessage = $_POST['feedback'];
    $email = $_POST['email'];
    $time = date('Y-m-d H:i:s');
    $sql = "INSERT INTO feedbacks (email, message, time) VALUES ('$email', '$feedbackmessage', '$time')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("Location: ../viewer/Homepage.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>