<?php
require_once('DBconnect.php');
session_start();

if (isset($_POST['username']) && isset($_POST['phone']) && isset($_POST['gender']) && isset($_POST['address']) && isset($_POST['profileurl']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $profileurl = $_POST['profileurl'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET phone_number = ?, gender = ?, address = ?, profileurl = ?, role = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $phone, $gender, $address, $profileurl, $role, $username);
    $stmt->execute();
    header("Location: profile.php");
}

?>