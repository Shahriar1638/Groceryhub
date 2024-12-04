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
      <?php  
        include 'navbar1.php';
      ?>
    </header>
    <main>
        <section class="px-[15rem]">
            <h1 class="text-center text-5xl font-extrabold my-10">
                Fill up the form before you add a product
            </h1>
            <div class="my-24">
              <form action="handleAddProducts.php" method="POST">
                <?php 
                  if(isset($_COOKIE['email'])) {
                      $email = $_COOKIE['email'];
                  } else {
                      echo header("Location: login.php");
                  }
                ?>
                <div class="grid grid-cols-2">
                  <div class="flex items-center mr-6">
                      <h1 class="text-2xl font-semibold mr-4 w-72">Your email:</h1>
                      <input type="text" name="sellerEmail" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" value="<?php echo $email; ?>" readonly>
                  </div>
                  <div>
                    <select class="select w-full my-4 border-2 border-gray-300 px-4 font-semibold text-xl py-2" name="productCategory" required>
                      <option disabled selected>Select your product Category</option>
                      <option>Fruits and Veggies</option>
                      <option>Meat & Dairy Delights</option>
                      <option>Beverages & Snacks</option>
                      <option>Pantry Essentials</option>
                      <option>Homecare Essentials</option>
                    </select>
                  </div>
                </div>
                <div class="grid grid-cols-2">
                  <div class="flex flex-row items-center mr-6 flex-1">
                      <h1 class="text-2xl font-semibold mr-4 w-72">Product Name:</h1>
                      <input type="text" name="productName" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                  </div>
                  <div class="flex flex-row items-center flex-1">
                      <h1 class="text-2xl font-semibold mr-4 w-72">Product Price:</h1>
                      <input type="number" step="0.01" name="productPrice" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                  </div>
                </div>
                <div class="flex flex-row items-center">
                  <h1 class="text-2xl font-semibold w-[21rem]">Product Amount Type:</h1>
                  <input type="text" name="productAmount" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                  <button class="" onclick="my_modal_1.showModal()"><i class="fa-solid fa-circle-exclamation text-4xl ml-4"></i></button>
                  <dialog id="my_modal_1" class="modal">
                      <div class="modal-box">
                          <h3 class="font-bold text-lg">Here is the instruction on how you will set the amount for products:</h3>
                          <p class="py-4">Firstly set the how you will measure the unit:</p>
                          <div class="flex flex-col items-start py-4 gap-y-2">
                              <p>wp - weight in pounds</p>
                              <p>wk - weight in kilograms</p>
                              <p>wg - weight in grams</p>
                              <p>p - pieces</p>
                              <p>ml - milliliters</p>
                              <p>l - liters</p>
                          </div>
                          <p class="py-4">Then use a comma and set the able amount of the products with , like this- wp,1,2,0.5,5 </p>
                          <p class="py-4">Here is an example: wp,1,2,3 . Means weight measurements type is pound and able ammount is 1 pound, 2 pound , 3 pound</p>
                          <p class="py-4">Here is an example: p,4,10,20 . Means each package will contain 4 pieces, 10 pieces , 20 pieces</p>
                          <div class="modal-action">
                            <button class="btn" onclick="my_modal_1.close()">Close</button>
                          </div>
                      </div>
                  </dialog>
                </div>
                <div class="flex flex-row items-center">
                    <h1 class="text-2xl font-semibold w-80">Product Image URl:</h1>
                    <input type="text" name="productImage" class="w-full h-12 border-2 border-gray-300 rounded-lg px-4 my-4" required>
                </div>
                <input type="submit" value="submit" class="bg-yellow-300 py-3 w-full rounded-lg my-4">
              </form>
            </div>
        </section>
    </main>
</body>
</html>