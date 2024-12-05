<?php
require_once('DBconnect.php');
if (isset($_POST['totalcost']) && isset($_POST['customeremail']) && isset($_POST['cvc']) && isset($_POST['expiry']) && isset($_POST['allitems'])) {
    $totalcost = $_POST['totalcost'];

    //  cal culating points for customer
    $conversionRate = 10; // 1 point per 10$ shopping
    $points = floor($totalcost / $conversionRate);
    $customeremail = $_POST['customeremail'];
    $query = "SELECT * FROM carts WHERE customeremail = '$customeremail'";
    $result = mysqli_query($conn, $query);

    $allitems = $_POST['allitems'];
    $cvc = $_POST['cvc'];
    $expiry = $_POST['expiry'];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productId = $row['productId'];

            // claculating revenue for sellers 
            $selleremail = $row['selleremail'];
            $productamount = $row['productamount'];
            $price = $row['price'];
            $sellerRevenue = $productamount * $price;
            $updateSellerRevenue = "UPDATE sellers SET revenue = revenue + $sellerRevenue WHERE email = '$selleremail'";
            $sellerRevenueResult = mysqli_query($conn, $updateSellerRevenue);
            if (!$sellerRevenueResult) {
                echo "Error updating seller revenue for seller with email: $selleremail. Error: " . mysqli_error($conn);
            }

            // increamenting sell count for products
            $productId = $row['productId'];
            $updateCartCount = "UPDATE products SET cartcount = cartcount + 1 WHERE productId = '$productId'";
            $cartCountResult = mysqli_query($conn, $updateCartCount);
            if (!$cartCountResult) {
                echo "Error updating sell count for product with ID: $productId. Error: " . mysqli_error($conn);
            }
        }
        //save records in payment table
        $transitionID = bin2hex(random_bytes(10));
        $query = "INSERT INTO Payment (transactionID, email, paid_amount, list_of_items, payment_date, expiry, cvc) VALUES ('$transitionID', '$customeremail', '$totalcost', '$allitems', NOW(), '$expiry', '$cvc')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "Payment Successful";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error fetching product IDs from cart. Error: " . mysqli_error($conn);
    }


    // empting my cart
    $query = "DELETE FROM carts WHERE customeremail = '$customeremail'";
    $result = mysqli_query($conn, $query);
    if ($result){

        // adding points for customer
        $query = "UPDATE customers SET points = points + $points WHERE email = '$customeremail'";
        $result = mysqli_query($conn, $query);
        if ($result){
            $query = "SELECT * FROM customers WHERE email = '$customeremail'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $loyaltyPoints = $row['points'];
            setcookie('loyaltyPoints', '', time() - 3600, "/");
            setcookie('loyaltyPoints', $loyaltyPoints, time() + (86400 * 30), "/");
            header("Location: customerHome.php");
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>