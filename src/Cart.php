<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshBasket</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <!-- design plugs -->
    <script src="https://kit.fontawesome.com/5f28ebb90a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              yellowPrimary: '#FFBF00',
              redSecondary: '#D2222D',
              greenSecondary: '#008F11',
            }
          }
        }
      }
    </script>
</head>
<body>
    <header>
      <?php include 'navbar1.php'; ?>
    </header>
    <main>
      <section class="px-[15rem]">
        <h1 class="text-center text-7xl font-extrabold my-10">
            Confirm your order
        </h1>
        <div class='overflow-x-auto'>
          <table class='table'>
              <thead>
                  <tr>
                      <th>Product Name</th>
                      <th>Product Price</th>
                      <th>Product Quantity</th>
                      <th></th>
                  </tr>
              </thead>
              <tbody>
              <?php 
                require_once('DBconnect.php');
                $useremail = $_COOKIE['email'];
                $query = "SELECT * FROM carts WHERE customeremail = '$useremail'";
                $result = mysqli_query($conn, $query);
                $totalCost = 0;
                if (mysqli_num_rows($result) > 0){
                    $allitems = "";
                    while ($row = mysqli_fetch_assoc($result)){
                        $productid = $row['productId'];
                        $productname = $row['productname'];
                        $productprice = $row['price'];
                        $productquantity = $row['productamount'];
                        $totalCost = round(($productprice * $productquantity) + $totalCost, 2);
                        $productprice2 = round(($productprice * $productquantity), 2);
                        // checking the product amount type
                        $sql = "SELECT * FROM products WHERE productId = '$productid'";
                        $productResult = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($productResult);
                        $productMeasurementUnits = explode(",",$row['ammount']);
                        if($productMeasurementUnits[0] == 'wp') {
                          $unit= 'Pounds';
                        } else if ($productMeasurementUnits[0] == 'wk') {
                          $unit= 'Kg';
                        } else if ($productMeasurementUnits[0] == 'p') {
                          $unit= 'Pieces';
                        }
                        $allitems .= $productname . ' ( '.$productquantity.' '.$unit.' ) '.$productprice2.'$ ,';
                        ?>
                          <tr>
                            <td><?php echo $productname; ?></td>
                            <td><?php echo $productprice2; ?>$</td>
                            <td class="uppercase"><?php echo $productquantity .' '. $unit; ?></td>
                            <td onclick="handleRemoveFromCart('<?php echo $useremail; ?>','<?php echo $productid; ?>')"><i class='fa-solid fa-trash hover:text-red-500 cursor-pointer'></i></td>
                          </tr>
                  <?php
                        }
                  }?>
                </tbody>
          </table>
        </div>

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

        <!-- Payment card -->

        <div class="mb-20 border-2 border-solid border-black rounded-xl">
          <div class="px-12 py-6">
            <h1 class="text-3xl text-center font-semibold textcenter mb-8">Payment Method</h1>
            <div class="flex flex-row justify-between items-center mb-10">
              <div>
                <h1 class="text-2xl font-semibold mb-8"><?php echo $useremail; ?></h1>
                <input class="rounded-md px-4 py-2 border border-solid border-gray-400" type="date" placeholder="Set Expiry" name="expiry" required min="<?php echo date('Y-m-d'); ?>">
              </div>
              <div>
                <?php
                  $today = date("d-m-y");
                ?>
                <div class="text-2xl font-semibold rounded-lg px-4 py-2 border border-solid border-black">Date: <?php echo $today; ?></div>
              </div>
              <div>
                <h1 class="text-2xl font-semibold mb-8">Total Cost:<i class='fa-solid fa-dollar-sign'></i><?php echo $finalPrice; ?></h1>
                <input class="rounded-md px-4 py-2 border border-solid border-gray-400" type="number" name="cvc" placeholder="set cvc" required>
              </div>
            </div>
            <div class="flex items-center flex-row">
              <input class="rounded-md px-4 py-2 border border-solid border-gray-400 w-full mr-6" type="number" name="cardnumber" placeholder="Card Number" required>
              <?php 
              if ($totalCost == $finalPrice) {
                ?>
                <button onclick="handlePayment('<?php echo $useremail; ?>','<?php echo $finalPrice; ?>', 123, '2025-10-21')" class="text-white font-bold uppercase text-lg px-6 py-2 rounded-lg bg-redSecondary">pay now</button>
              <?php
              } else {
                ?>
                <button onclick="handlePaymentWithPoints('<?php echo $useremail; ?>','<?php echo $finalPrice; ?>',document.getElementsByName('cvc')[0].value, document.getElementsByName('expiry')[0].value))" class="text-white font-bold uppercase text-lg px-6 py-2 rounded-lg bg-redSecondary">pay now</button>
              <?php
              }
             ?>
            </div>
            <div>
              <h1>tempo: <?php echo $allitems ?></h1>
            </div>
          </div>
        </div>
        <div class="hidden">
            <form action="handleRemoveCart.php" method="post" id="removecart">
                <input type="text" name="customeremail">
                <input type="text" name="productid">
            </form>
        </div>
        <div class="hidden">
            <form action="handlePayment.php" method="post" id="paymentform">
                <input type="text" name="customeremail">
                <input type="text" name="totalcost">
                <input type="text" name="cvc">
                <input type="text" name="expiry">
                <input type="text" name="allitems" value="<?php echo $allitems; ?>">
            </form>
        </div>
        <div class="hidden">
            <form action="handlePaymentWithPoints.php" method="post" id="paymentform2">
                <input type="text" name="customeremail">
                <input type="text" name="totalcost">
                <input type="text" name="cvc">
                <input type="text" name="expiry">
                <input type="text" name="allitems" value="<?php echo $allitems; ?>">
            </form>
        </div>
        <script>
            function handlePayment(useremail, totalcost, cvc, expiry) {
                console.log(useremail, totalcost, cvc, expiry);
                document.getElementById('paymentform').elements['customeremail'].value = useremail;
                document.getElementById('paymentform').elements['totalcost'].value = totalcost;
                document.getElementById('paymentform').elements['cvc'].value = cvc;
                document.getElementById('paymentform').elements['expiry'].value = expiry;
                document.getElementById('paymentform').submit();
            };
            function handlePaymentWithPoints(useremail, totalcost, cvc, expiry) {
                console.log(useremail, totalcost, cvc, expiry);
                document.getElementById('paymentform2').elements['customeremail'].value = useremail;
                document.getElementById('paymentform2').elements['totalcost'].value = totalcost;
                document.getElementById('paymentform').elements['cvc'].value = cvc;
                document.getElementById('paymentform').elements['expiry'].value = expiry;
                document.getElementById('paymentform2').submit();
            };
            function handleRemoveFromCart(useremail, productid) {
                document.getElementById('removecart').elements['productid'].value = productid;
                document.getElementById('removecart').elements['customeremail'].value = useremail;
                document.getElementById('removecart').submit();
            };
        </script>
        </section>
    </main>
</body>
</html>