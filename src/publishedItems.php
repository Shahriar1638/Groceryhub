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
      <nav class="h-24 px-40 flex justify-between items-center">
        <div class="flex items-center">
          <img class="h-16 w-16" src="../ICON/logo.png" alt="">
          <h1 class="text-3xl font-bold ml-3">FreshBasket</h1>
        </div>  
        <?php
            if(isset($_COOKIE['userID'])) {
                $username = $_COOKIE['username'];
            } else {
                echo "No username cookie set";
            }
            ?>
        <div>
          <h1 class="text-2xl font-semibold uppercase">Welcome to admin dashboard, <?php echo $username ?></h1>
        </div>
      </nav>
    </header>
    <main>
      <section class="pl-40 pt-4 h-screen">
        <div class="grid grid-cols-6">
          <div class="mt-16">
            <div class="flex flex-col items-start">
              <div class="flex items-center hover:text-redSecondary mb-6 text-redSecondary">
                <i class="fa-regular fa-clipboard mr-2 text-lg"></i>
                <a href="publishedItems.php" class="text-lg font-semibold uppercase">Published Items</a>
              </div>
              <div class="flex items-center hover:text-redSecondary mb-6">
                <i class="fa-solid fa-hourglass-end mr-2"></i>
                <a href='pendingItems.php' class="text-lg font-semibold uppercase">Pending Items</a>
              </div>
              <div class="flex items-center hover:text-redSecondary">
                <i class="fa-regular fa-address-card mr-2"></i>
                <a href='adminRegister.php' class="text-lg font-semibold uppercase">Register a admin</a>
              </div>
            </div>
          </div>
          <!-- suchitra start -->
          <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12">
            <div>
              <h1 class="text-4xl font-bold uppercase text-center mb-8">Current published products</h1>
            </div>
            <div class='overflow-x-auto'>
              <table class='table'>
                  <thead>
                      <tr>
                          <th class="uppercase">Product Name</th>
                          <th class="uppercase">Product Price</th>
                          <th class="uppercase">sellername</th>
                          <th class="uppercase">total sold</th>
                      </tr>
                  </thead>
                  <tbody>
                  <?php 
                    require('DBconnect.php');
                    $query = "SELECT * FROM products where status = 'published'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0){
                        while ($row = mysqli_fetch_assoc($result)){
                            $productname = $row['name'];
                            $productprice = $row['price'];
                            $productseller = $row['selleremail'];
                            $productSellCount = $row['cartcount'];
                            ?>
                              <tr>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $productprice ?></td>
                                <td><?php echo $productseller ?></td>
                                <td><?php echo $productSellCount ?></td>
                              </tr>
                    <?php
                          }
                    }?>
                  </tbody>
              </table>
            </div>
          </div>
          <!-- suchitra end -->
        </div>
      </section>
    </main>
</body>
</html>