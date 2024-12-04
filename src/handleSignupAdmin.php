<?php 
require('DBconnect.php');
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
    $role = 'admin';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO users (role, username, email, password) VALUES ('$role', '$username', '$email', '$password')";
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