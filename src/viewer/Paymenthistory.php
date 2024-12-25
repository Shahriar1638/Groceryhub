<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groceryhub</title>
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
        <section class="px-[15rem] justify-center flex mt-20">
            <div class="overflow-x-auto w-[60rem]">
                <table class='table'>
                    <thead>
                        <tr>
                            <th>TransactionID</th>
                            <th>Products</th>
                            <th>Paid Ammount</th>
                            <th>Payment date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        require_once('DBconnect.php');
                        $useremail = $_COOKIE['email']; 
                        $query = "SELECT * FROM payment WHERE email = '$useremail' ORDER BY payment_date DESC";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0){
                            while ($row = mysqli_fetch_assoc($result)){
                                $transactionid = $row['transactionID'];
                                $products = $row['list_of_items'];
                                $paidammount = $row['paid_amount'];
                                $paymentdate = $row['payment_date'];
                            ?>
                            <tr>
                            <td><?php echo $transactionid; ?></td>
                            <td>
                                <button class="btn" onclick="document.getElementById('modal_<?php echo $transactionid; ?>').showModal()">
                                    <?php echo substr($products, 0, 50) . (strlen($products) > 60 ? '...' : ''); ?>
                                </button>
                                <dialog id="modal_<?php echo $transactionid; ?>" class="modal">
                                    <div class="modal-box">
                                        <h3 class="text-lg font-bold"><?php echo $products; ?></h3>
                                    </div>
                                </dialog>
                            </td>
                            <td><?php echo $paidammount; ?></td>
                            <td><?php echo $paymentdate; ?></td>
                        </tr>
                        <?php
                            }} else {
                                echo "No payment history found";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>