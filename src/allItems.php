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
<body>
    <header>
      <?php include 'navbar1.php'; ?>
    </header>
    <main>
        <section class="px-[15rem]">
            <h1 class="text-center text-7xl font-extrabold my-10">
                Explore all the products
            </h1>
            <!-- Mehraaj  -->
            <div class="grid grid-cols-3 gap-6">         
              <?php
                require('DBconnect.php');
                $customeremail = $_COOKIE['email'];
                $query = "SELECT * FROM products WHERE status = 'published'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $selleremail = $row['selleremail'];
                    $productName = $row['name'];
                    $productPrice = $row['price'];
                    $productImage = $row['imgurl'];
                    $productcategory = $row['category'];
                    $productid = $row['productId'];
                    $productAmmount = explode(",",$row['ammount']);
                    if($productAmmount[0] == 'wp') {
                      $ammountType= 'Pounds';
                    } else if ($productAmmount[0] == 'wk') {
                      $ammountType= 'Kg';
                    } else if ($productAmmount[0] == 'p') {
                      $ammountType= 'Pieces';
                    }
                ?>
                <div class='w-full h-60 rounded-lg relative' style='background-image: linear-gradient(to top,rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2)),url(<?php echo $productImage?>); background-size: cover; background-repeat: no-repeat;'>
                  <div class='absolute top-4 right-6'>
                    <div class="dropdown dropdown-end">
                      <div tabindex="0" role="button" class="m-1"><i class='fa-solid fa-cart-plus text-4xl text-white hover:text-[#FFBF00] hover pointer'></i></div>
                      <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li onclick="handleForm('<?php echo $productName ?>', '<?php echo $productPrice ?>','<?php echo $customeremail ?>','<?php echo $productid ?>','<?php echo $productAmmount[1] ?>','<?php echo $selleremail ?>')">
                          <a><?php echo $productAmmount[1] . ' ' . $ammountType?></a>
                        </li>
                        <li onclick="handleForm('<?php echo $productName ?>', '<?php echo $productPrice ?>','<?php echo $customeremail ?>','<?php echo $productid ?>','<?php echo $productAmmount[2] ?>','<?php echo $selleremail ?>')"><a><?php echo $productAmmount[2] . ' ' . $ammountType?></a></li>
                        <li onclick="handleForm('<?php echo $productName ?>', '<?php echo $productPrice ?>','<?php echo $customeremail ?>','<?php echo $productid ?>','<?php echo $productAmmount[3] ?>','<?php echo $selleremail ?>')"><a><?php echo $productAmmount[3] . ' ' . $ammountType?></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class='flex flex-col justify-start absolute bottom-4 left-6'>
                    <h1 class='text-3xl font-bold text-white'><?php echo $productName?></h1>
                    <div class='flex flex-row items-center'>
                      <p class='text-white mr-4 flex items-center gap-2'><img class='w-4 h-4' src='../ICON/categories.png'><?php echo $productcategory ?></p>
                      <p class='text-white flex items-center gap-2'><i class='fa-solid fa-dollar-sign'></i><?php echo $productPrice ?></p>
                    </div>
                  </div>
                </div> 
                <?php    
                  }
                } else {
                  echo "Oops.....No products found.";
                }
                ?>
                <div class="hidden">
                  <form action="handleAddToCart.php" method="post" id="addForm">
                    <input type="text" name="productname">
                    <input type="number" name="productprice">
                    <input type="text" name="customeremail">
                    <input type="text" name="productid">
                    <input type="number" name="productamount">
                    <input type="text" name="selleremail">
                  </form>
                </div>
                <script>
                  function handleForm(productName, productPrice, customeremail, productid, productAmmount, selleremail) {
                    document.getElementById('addForm').elements['productname'].value = productName;
                    document.getElementById('addForm').elements['productprice'].value = productPrice;
                    document.getElementById('addForm').elements['customeremail'].value = customeremail;
                    document.getElementById('addForm').elements['productid'].value = productid;
                    document.getElementById('addForm').elements['productamount'].value = productAmmount;
                    document.getElementById('addForm').elements['selleremail'].value = selleremail;
                    document.getElementById('addForm').submit();
                  }
                </script>

            <!-- mehraaj end -->
            </div>
        </section>
    </main>
</body>
</html>