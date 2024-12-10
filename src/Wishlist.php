<div>
    <?php
    require_once('DBconnect.php');
    $customeremail = $_COOKIE['email'];
    $query = "SELECT * FROM wishlist WHERE customer_email = '$customeremail'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)){
            $productid = $row['productId'];
            $query2 = "SELECT * FROM products WHERE productId = '$productid'";
            $result2 = mysqli_query($conn, $query2);
            if (mysqli_num_rows($result2) > 0){
                $row2 = mysqli_fetch_assoc($result2);
                $productname = $row2['name'];
                $productprice = $row2['price'];
                $productimage = $row2['imgurl'];
                $selleremail = $row2['selleremail'];
                $productAmmount = explode(",",$row2['ammount']);
                if($productAmmount[0] == 'wp') {
                    $ammountType= 'Pounds';
                } else if ($productAmmount[0] == 'wk') {
                    $ammountType= 'Kg';
                } else if ($productAmmount[0] == 'p') {
                    $ammountType= 'Pieces';
                }
                ?>
                <div class="flex items-center gap-32 my-8">
                    <div>
                        <img class="w-[20rem] h-[20rem] object-cover rounded-xl" src="<?php echo $productimage; ?>" alt="">
                    </div>
                    <div>
                        <h1 class="text-4xl font-bold uppercase mb-4"><?php echo $productname; ?></h1>
                        <p class="text-2xl mb-4">Price: <?php echo $productprice; ?></p>
                        <div class="dropdown dropdown-end mb-4">
                            <div tabindex="0" role="button" class="bg-green-500 text-white px-4 py-2 rounded-md">Add to cart</div>
                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                                <li onclick="handleForm('<?php echo $productname ?>', '<?php echo $productprice ?>','<?php echo $customeremail ?>','<?php echo $productid ?>','<?php echo $productAmmount[1] ?>','<?php echo $selleremail ?>')">
                                    <a><?php echo $productAmmount[1] . ' ' . $ammountType?></a>
                                </li>
                                <li onclick="handleForm('<?php echo $productname ?>', '<?php echo $productprice ?>','<?php echo $customeremail ?>','<?php echo $productid ?>','<?php echo $productAmmount[2] ?>','<?php echo $selleremail ?>')">
                                    <a><?php echo $productAmmount[2] . ' ' . $ammountType?></a>
                                </li>
                                <li onclick="handleForm('<?php echo $productname ?>', '<?php echo $productprice ?>','<?php echo $customeremail ?>','<?php echo $productid ?>','<?php echo $productAmmount[3] ?>','<?php echo $selleremail ?>')">
                                    <a><?php echo $productAmmount[3] . ' ' . $ammountType?></a>
                                </li>
                            </ul>
                        </div>
                        <form action="handleRemoveWishlist.php" method="POST">
                            <input type="hidden" name="productid" value="<?php echo $productid; ?>">
                            <input type="hidden" name="customeremail" value="<?php echo $customeremail; ?>">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Remove from wishlist</button>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
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
            console.log(productName, productPrice, customeremail, productid, productAmmount, selleremail);
            document.getElementById('addForm').elements['productname'].value = productName;
            document.getElementById('addForm').elements['productprice'].value = productPrice;
            document.getElementById('addForm').elements['customeremail'].value = customeremail;
            document.getElementById('addForm').elements['productid'].value = productid;
            document.getElementById('addForm').elements['productamount'].value = productAmmount;
            document.getElementById('addForm').elements['selleremail'].value = selleremail;
            document.getElementById('addForm').submit();
        }
    </script>
</div>