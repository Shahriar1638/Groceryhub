<div class="my-20">
          <?php
          require_once('DBconnect.php');
          $useremail = $_COOKIE['email'];
          $query = "SELECT * FROM customers WHERE email = '$useremail'";
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $points = $row['points'];
            if ($points >= 100) {
              $discount = 0.10;
              $finalPrice = $totalCost - ($totalCost * $discount);
            } else {
              $discount = 0;
              $finalPrice = $totalCost;
            }}
          ?>
          <div>
            <h1 class="text-2xl font-semibold">Total Cost: $<?php echo $totalCost; ?></h1>
            <h1 class="text-2xl font-semibold">Discount: $<?php echo ($totalCost * $discount); ?></h1>
            <h1 class="text-2xl font-semibold">Total payment: $<?php echo $finalPrice; ?></h1>
          </div>
        </div>