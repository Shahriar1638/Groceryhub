<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groceryhub</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <!-- design plugs -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                            <th>Progress</th>
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
                                $progress = $row['progression'];
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
                            <td class="flex items-center flex-row w-56">
                                <?php 
                                if ($progress == "received" || $progress == "cancelled"){
                                    ?><span class="uppercase"><?php echo $progress; ?></span>
                                    <?php
                                } else {
                                ?><button class="uppercase mr-2" onclick="handleStatus('<?php echo $transactionid ?>')">In progress</button><button onclick="handleOrderCancel('<?php echo $transactionid ?>')" class="uppercase">cancel</button><?php
                                }
                                ?>
                            </td>
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
        <form action="../controler/handleProductRecieved.php" method="post" id="statusForm">
            <input type="hidden" name="transactionid">
        </form>
        <form action="../controler/handleOrderCancel.php" method="post" id="cancelorderform">
            <input type="hidden" name="transactionid">
        </form>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function handleStatus(transactionid){
                Swal.fire({
                    title: 'Did you recieved all the products?',
                    text: "Check all the products before confirming!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, remove it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('statusForm').elements['transactionid'].value = transactionid;
                        document.getElementById('statusForm').submit();
                    }
                });
            }

            function handleOrderCancel(transactionid){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cancelorderform').elements['transactionid'].value = transactionid;
                        document.getElementById('cancelorderform').submit();
                    }
                });
            }
        </script>
    </main>
</body>
</html>