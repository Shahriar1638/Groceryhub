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
        </div>
      </section>
    </main>
</body>
</html>