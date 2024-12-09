<?php 
require('DBconnect.php');
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['gender']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['profileurl'])) {
    $role = 'admin';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $profileurl = $_POST['profileurl'];
    $sql = "INSERT INTO users (role, username, email, password, phone_number, gender, profileurl, address) VALUES ('$role', '$username', '$email', '$password', '$phone', '$gender', '$profileurl', '$address')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $salary = 0;

        // checking the last row to generate new adminID
        $tempsql = "SELECT * FROM admins ORDER BY adminID DESC LIMIT 1";
        $tempresult = mysqli_query($conn, $tempsql);
        $row = mysqli_fetch_assoc($tempresult);
        $lastAdminID = $row['adminID']; // largest Id in the table
        $prefix = substr($lastAdminID, 0, 3); 
        $number = substr($lastAdminID, 3);
        $number = (int)$number + 1;
        $newsuffix = "00" . $number;
        $newID = $prefix . $newsuffix;

        // continue with inserting new admin
        $query = "INSERT INTO admins (adminID, email, salary) VALUES ('$newID','$email', '$salary')";
        $result = mysqli_query($conn, $query);
        if (mysqli_affected_rows($conn)) {
            header("Location: publishedItems.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>