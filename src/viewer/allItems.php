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
            <!-- Search bar -->
            <form method="post" class="my-10 flex items-center">
              <input class="px-6 py-2 rounded-md border border-solid" type="text" name="searchTerm" placeholder="Search for items..." required>
              <button type="submit" class="rounded-r-md px-4 py-2 bg-[#D2222D] text-white font-semibold" name="search">Search</button>
              <button type="reset" class="ml-8" onclick="window.location.href='allItems.php';">Clear</button>
            </form>
            <div class="flex items-start justify-start mb-10 mr-6">
            <?php
              require_once('DBconnect.php');
              $customeremail = $_COOKIE['email'];
              // Handle search query
              $searchResults = [];
              if (isset($_POST['search'])) {
                  $searchTerm = $conn->real_escape_string($_POST['searchTerm']);
                  $query = "SELECT * FROM products WHERE name LIKE '%$searchTerm%'";
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
                      } else if ($productAmmount[0] == 'wg') {
                          $ammountType= 'Grams';
                      } else if ($productAmmount[0] == 'p') {
                          $ammountType= 'Pieces';
                      } else if ($productAmmount[0] == 'l') {
                          $ammountType= 'Litres';
                      } else if ($productAmmount[0] == 'ml') {
                          $ammountType= 'Millilitres';
                      }
             ?>
             <!-- search card design -->
                  <div class='w-[30rem] h-60 rounded-lg relative' style='background-image: linear-gradient(to top,rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2)),url(<?php echo $productImage?>); background-size: cover; background-repeat: no-repeat;'>
                      <div class='absolute top-4 right-6'>
                          <div class="dropdown dropdown-end">
                              <?php if ($_COOKIE['role'] != 'seller'): ?>
                              <div tabindex="0" role="button" class="m-1"><i class='fa-solid fa-cart-plus text-4xl text-white hover:text-[#FFBF00] hover pointer'></i></div>
                              <?php endif; ?>
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
                      <div class="absolute bottom-4 right-6">
                        <i onclick="document.getElementById('my_modal_1').setAttribute('open', 'true')" class="fa-solid fa-triangle-exclamation text-[#D2222D] text-3xl cursor-pointer"></i>
                        <dialog id="my_modal_1" class="modal">
                          <div class="modal-box">
                            <h3 class="text-lg font-bold"><?php echo $customeremail; ?></h3>
                            <textarea class="p-4 mt-4 -mb-4 w-full border border-solid border-gray-400 rounded-md" id="messageTextArea" name="message"></textarea>
                            <div class="modal-action">
                              <form method="dialog" class="flex items-center">
                                <button class="btn mr-6" onclick="document.getElementById('my_modal_1').removeAttribute('open')">close</button>
                                <button class="btn bg-green-400" onclick="handleReportSubmit('<?php echo $customeremail; ?>',)">Submit</button>
                              </form>
                            </div>
                          </div>
                        </dialog>
                      </div>
                    </div> 
                    <form class="hidden" id="reportform" method="post" action="../controler/handleReportSubmit.php">
                      <input type="text" name="email">
                      <input type="text" name="message">
                    </form>
                    <script>
                      function handleReportSubmit(email) {
                        const msg = document.getElementById('messageTextArea').value;
                        document.getElementById('reportform').elements['email'].value = email;
                        document.getElementById('reportform').elements['message'].value = msg;
                        document.getElementById('reportform').submit();
                        document.getElementById('my_modal_1').removeAttribute('open')
                      }
                    </script>
                  </div> 
            <?php 
            }} else {
                echo "Oops.....No products found.";
            }} ?>
            </div>
            <!-- search bar end -->

            <!-- All items -->
            <?php
            require('DBconnect.php');
            $customeremail = $_COOKIE['email'];
            $categoriesQuery = "SELECT DISTINCT category FROM products WHERE status = 'published'";
            $categoriesResult = mysqli_query($conn, $categoriesQuery);

            if (mysqli_num_rows($categoriesResult) > 0) {
                while ($categoryRow = mysqli_fetch_assoc($categoriesResult)) {
                    $category = $categoryRow['category'];
                    echo "<h2 class='text-4xl font-bold my-6'>$category</h2>";
                    echo "<div class='grid grid-cols-3 gap-6'>";
                    
                    $query = "SELECT * FROM products WHERE status = 'published' AND category = '$category'";
                    $result = mysqli_query($conn, $query);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $selleremail = $row['selleremail'];
                            $productName = $row['name'];
                            $productPrice = $row['price'];
                            $productImage = $row['imgurl'];
                            $productcategory = $row['category'];
                            $productid = $row['productId'];
                            $productAmmount = explode(",", $row['ammount']);
                            $productRating = (int)$row['rating'];
                            if ($productAmmount[0] == 'wp') {
                                $ammountType = 'Pounds';
                            } else if ($productAmmount[0] == 'wk') {
                                $ammountType = 'Kg';
                            } else if ($productAmmount[0] == 'wg') {
                                $ammountType = 'Grams';
                            } else if ($productAmmount[0] == 'p') {
                                $ammountType = 'Pieces';
                            } else if ($productAmmount[0] == 'l') {
                                $ammountType = 'Litres';
                            } else if ($productAmmount[0] == 'ml') {
                                $ammountType = 'Millilitres';
                            }
            ?>
                            <!-- CARD -->
                            <div class='w-full h-72 rounded-lg relative' style='background-image: linear-gradient(to top,rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.2)),url(<?php echo $productImage ?>); background-size: cover; background-repeat: no-repeat;'>
                                <div class='flex items-center absolute top-4 right-6'>
                                    <!-- Wishlist button -->
                                    <?php if ($_COOKIE['role'] != 'seller'): ?>
                                    <div class="mr-4">
                                        <?php
                                        $sql = "SELECT * FROM wishlist WHERE productId = '$productid' AND customer_email = '$customeremail'";
                                        $wishlistResult = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($wishlistResult) > 0) {
                                        ?>
                                            <i class="fa-solid fa-heart text-4xl text-[#2aff2a] cursor-pointer"></i>
                                        <?php
                                        } else {
                                        ?>
                                            <i onclick="handleWishlist('<?php echo $productid ?>', '<?php echo $customeremail ?>')" class="fa-solid fa-heart text-4xl text-white hover:text-[#FFBF00] cursor-pointer"></i>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <!-- add to cart button -->
                                    <div class="dropdown dropdown-end">
                                        <div tabindex="0" role="button" class="m-1"><i class='fa-solid fa-cart-plus text-4xl text-white hover:text-[#FFBF00] hover pointer'></i></div>
                                        <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                            <li onclick="handleForm('<?php echo $productName ?>', '<?php echo $productPrice ?>','<?php echo $customeremail ?>','<?php echo $productid ?>','<?php echo $productAmmount[1] ?>','<?php echo $selleremail ?>')">
                                                <a><?php echo $productAmmount[1] . ' ' . $ammountType ?></a>
                                            </li>
                                            <li onclick="handleForm('<?php echo $productName ?>', '<?php echo $productPrice ?>','<?php echo $customeremail ?>','<?php echo $productid ?>','<?php echo $productAmmount[2] ?>','<?php echo $selleremail ?>')"><a><?php echo $productAmmount[2] . ' ' . $ammountType ?></a></li>
                                            <li onclick="handleForm('<?php echo $productName ?>', '<?php echo $productPrice ?>','<?php echo $customeremail ?>','<?php echo $productid ?>','<?php echo $productAmmount[3] ?>','<?php echo $selleremail ?>')"><a><?php echo $productAmmount[3] . ' ' . $ammountType ?></a></li>
                                        </ul>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <!-- card body design -->
                                <div class='flex flex-col justify-start absolute bottom-4 left-6'>
                                    <h1 class='text-3xl font-bold text-white'><?php echo $productName ?></h1>
                                    <div class='flex flex-row items-center mb-2'>
                                        <p class='text-white mr-4 flex items-center gap-2'><img class='w-4 h-4' src='../ICON/categories.png'><?php echo $productcategory ?></p>
                                        <p class='text-white flex items-center gap-2'><i class='fa-solid fa-dollar-sign'></i><?php echo $productPrice ?></p>
                                    </div>
                                    <!-- rating button -->
                                    <div onclick="document.getElementById('rating_modal_<?php echo $productid; ?>').showModal()" class='flex items-center cursor-pointer'>
                                        <?php for ($i = 1; $i <= 5; $i++) : ?> <?php if ($i <= $productRating) : ?>
                                            <i class="fa-solid fa-star text-yellow-500"></i>
                                        <?php else : ?>
                                            <i class="fa-solid fa-star text-gray-400"></i>
                                        <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>

                                    <!-- rating pop up panel -->
                                    <?php if ($_COOKIE['role'] != 'seller'): ?>
                                    <dialog id="rating_modal_<?php echo $productid; ?>" class="modal">
                                        <div class="modal-box">
                                            <h3 class="text-lg font-bold">Rate Product</h3>
                                            <form action="../controler/handleSubmitRating.php" method="post">
                                                <input type="hidden" name="productId" value="<?php echo $productid; ?>">
                                                <input type="hidden" name="customerEmail" value="<?php echo $customeremail; ?>">
                                                <div class="flex items-center">
                                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                                        <input class="mr-1" type="radio" id="star<?php echo $i; ?>-<?php echo $productid; ?>" name="rating" value="<?php echo $i; ?>" <?php if ($i == $productRating) echo 'checked'; ?>>
                                                    <?php endfor; ?>
                                                </div>
                                                <div class="modal-action">
                                                    <button type="submit" class="btn bg-green-400">Submit Rating</button> <button type="button" class="btn" onclick="document.getElementById('rating_modal_<?php echo $productid; ?>').close()">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </dialog>
                                    <?php endif; ?>
                                </div>
                                <!-- report form -->
                                <div class="absolute bottom-4 right-6">
                                    <i onclick="document.getElementById('my_modal_1').setAttribute('open', 'true')" class="fa-solid fa-triangle-exclamation text-[#D2222D] text-3xl cursor-pointer"></i>
                                    <dialog id="my_modal_1" class="modal">
                                        <div class="modal-box">
                                            <h3 class="text-lg font-bold"><?php echo $customeremail; ?></h3>
                                            <textarea class="p-4 mt-4 -mb-4 w-full border border-solid border-gray-400 rounded-md" id="messageTextArea" name="message"></textarea>
                                            <div class="modal-action">
                                                <form method="dialog" class="flex items-center">
                                                    <button class="btn mr-6" onclick="document.getElementById('my_modal_1').removeAttribute('open')">close</button>
                                                    <button class="btn bg-green-400" onclick="handleReportSubmit('<?php echo $customeremail; ?>','<?php echo $selleremail; ?>')">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </dialog>
                                </div>
                            </div>
                            <form class="hidden" id="reportform" method="post" action="../controler/handleReportSubmit.php">
                                <input type="text" name="email">
                                <input type="text" name="message">
                                <input type="text" name="selleremail">
                            </form>
                            <script>
                                function handleReportSubmit(email, selleremail) {
                                    const msg = document.getElementById('messageTextArea').value;
                                    document.getElementById('reportform').elements['email'].value = email;
                                    document.getElementById('reportform').elements['message'].value = msg;
                                    document.getElementById('reportform').elements['selleremail'].value = selleremail;
                                    document.getElementById('reportform').submit();
                                    document.getElementById('my_modal_1').removeAttribute('open')
                                }
                            </script>
            <?php
                        }
                    } else {
                        echo "Oops.....No products found in this category.";
                    }
                    echo "</div>";
                }
            } else {
                echo "Oops.....No categories found.";
            }
            ?>
            <div class="hidden">
                <form action="../controler/handleAddToCart.php" method="post" id="addForm">
                    <input type="text" name="productname">
                    <input type="number" name="productprice">
                    <input type="text" name="customeremail">
                    <input type="text" name="productid">
                    <input type="number" name="productamount">
                    <input type="text" name="selleremail">
                </form>
            </div>
            <script>
                function handleWishlist(productid, customeremail) {
                    const form = document.createElement('form');
                    form.method = 'post';
                    form.action = 'handleWishlist.php';
                    form.style.display = 'none';

                    const inputProductId = document.createElement('input');
                    inputProductId.type = 'hidden';
                    inputProductId.name = 'productid';
                    inputProductId.value = productid;
                    form.appendChild(inputProductId);

                    const inputCustomerEmail = document.createElement('input');
                    inputCustomerEmail.type = 'hidden';
                    inputCustomerEmail.name = 'customeremail';
                    inputCustomerEmail.value = customeremail;
                    form.appendChild(inputCustomerEmail);

                    document.body.appendChild(form);
                    form.submit();
                }
            </script>
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
        </section>
    </main>
</body>
</html>