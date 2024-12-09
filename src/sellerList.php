<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshBasket</title>
    <!-- design plugs -->
    <script src="https://kit.fontawesome.com/5f28ebb90a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
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
<body class="bg-yellowPrimary">
    <header>
      <?php include 'navbar2.php'; ?>
    </header>
    <main>
      <section class="pl-40 pt-4 h-screen">
        <div class="grid grid-cols-6">
          <div class="mt-16">
            <?php include 'sidebar.php'; ?>
          </div>
          <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12">
            <div>
              <h1 class="text-4xl font-bold uppercase text-center mb-8">Seller List</h1>
            </div>
            <div class='overflow-x-auto mt-8'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th class="uppercase">Seller Name</th>
                            <th class="uppercase">Email</th>
                            <th class="uppercase">Phone</th>
                            <th class="uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        require_once('DBconnect.php');
                        $query = "SELECT * FROM users WHERE role = 'seller'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0){
                            while ($row = mysqli_fetch_assoc($result)){
                                $sellerName = $row['username'];
                                $sellerEmail = $row['email'];
                                $sellerPhone = $row['phone_number'];
                                $banStatus = $row['ban_status'];
                                ?>
                                <tr>
                                    <td><?php echo $sellerName ?></td>
                                    <td><?php echo $sellerEmail ?></td>
                                    <td><?php echo $sellerPhone ?></td>
                                    <td>
                                        <?php if ($banStatus == '0') { ?>
                                            <button class="px-6 py-2 rounded-md bg-green-500 uppercase text-white" onclick="handleBanStatus('<?php echo $sellerEmail ?>', 'unban')">Unban</button>
                                        <?php } else { ?>
                                            <button class="px-6 py-2 rounded-md bg-red-500 uppercase text-white" onclick="handleBanStatus('<?php echo $sellerEmail ?>', 'ban')">Ban</button>
                                        <?php } ?>
                                    </td>
                                </tr>
                        <?php
                            }
                        }?>
                    </tbody>
                </table>
            </div>
            <form class="hidden" id="HandleBan" method="post" action="handleBanStatus.php">
                <input type="text" name="email">
                <input type="text" name="action">
            </form>
            <script>
                function handleBanStatus(email, action) {
                    document.querySelector('form').elements['email'].value = email;
                    document.querySelector('form').elements['action'].value = action;
                    document.querySelector('form').submit();
                }
            </script>
            </div>
          </div>
        </div>
      </section>
    </main>
</body>
</html>