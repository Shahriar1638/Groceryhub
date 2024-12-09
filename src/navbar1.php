<nav class="h-24 px-56 flex justify-between items-center">
    <div class="flex items-center">
        <img class="h-16 w-16" src="../ICON/logo.png" alt="">
        <h1 class="text-3xl font-bold ml-3">FreshBasket</h1>
    </div>  
    <div class="flex items-center">
        <div class="flex items-center hover:text-redSecondary">
            <i class="fa-solid fa-house fa-rotate-by mr-2"></i>
            <a href="customerHome.php" class="text-xl font-semibold uppercase">Home</a>
        </div>
        <div class="flex items-center ml-5 hover:text-redSecondary">
            <i class="fa-solid fa-list mr-2"></i>
            <a href="allItems.php" class="text-xl font-semibold uppercase">Items</a>
        </div>
        <?php
            if(isset($_COOKIE['role'])) {
                $role = $_COOKIE['role'];
                if($role == 'customer') {
                    $loyaltyPoints = $_COOKIE['loyaltyPoints'];
                    echo 
                    "
                    <div class='flex items-center ml-5 hover:text-redSecondary'>
                        <i class='fa-solid fa-receipt mr-2'></i>
                        <a href='Paymenthistory.php' class='text-xl font-semibold uppercase'>Payment History</a>
                    </div>
                    <div class='flex items-center ml-5 hover:text-redSecondary'>
                      <i class='fa-solid fa-shopping-cart mr-2'></i>
                      <a href='Cart.php' class='text-xl font-semibold uppercase'>Cart</a>
                    </div>";
                } else if ($role == 'seller'){
                    $revenue = $_COOKIE['revenue'];
                    echo 
                    "
                    <div class='flex items-center ml-5 hover:text-redSecondary'>
                        <i class='fa-solid fa-chart-line mr-2'></i>
                        <a href='sellerdashboard.php' class='text-xl font-semibold uppercase'>Dashboard</a>
                    </div>
                    <div class='flex items-center ml-5 hover:text-redSecondary'>
                      <i class='fa-solid fa-list-check mr-2'></i>
                      <a href='addProducts.php' class='text-xl font-semibold uppercase'>Add items</a>
                    </div>";
                } else {
                  header("Location: login.php");
                }
            }
           ?>
    </div>
    <div>
        <?php
        if(isset($_COOKIE['userID'])) {
            $username = $_COOKIE['username'];
            ?>
            <div class='flex items-center'>
                <?php 
                    if(isset($_COOKIE['loyaltyPoints'])) {
                        $loyaltyPoints = $_COOKIE['loyaltyPoints'];
                        echo "
                        <img src='../ICON/purepng.com-gold-coinsflatcoinsroundmetalgoldclipart-1421526479543zg85n.png' class='w-8 h-8 mr-4' alt=''>
                        <h1 class='text-xl font-semibold uppercase mr-6'>$loyaltyPoints</h1>";
                    } else if(isset($_COOKIE['revenue'])) {
                        $revenue = $_COOKIE['revenue'];
                        echo "
                        <img src='../ICON/png-transparent-gold-coin-gold-coins-gold-gold-label-material-thumbnail.png' class='w-8 h-8 mr-4' alt=''>
                        <h1 class='text-xl font-semibold uppercase mr-6'>$$revenue</h1>";
                    }
                ?>
                <i class='fa-solid fa-user mr-2 text-2xl'></i>
                <h1 class='text-xl font-semibold uppercase mr-4'><a href='profile.php'><?php echo $username ?></a></h1>
                <button onclick='handleSignout()' class='bg-[#D2222D] text-white block px-6 py-3 rounded-md uppercase font-semibold'>logout</button>
            </div>
        <?php
        } else {
            echo "No username cookie set";
        }
        ?>
        <script>
            function handleSignout() {
            document.cookie.split(";").forEach(function(c) { 
                document.cookie = c.trim().split("=")[0] + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/"; 
            });
            window.location.href = "login.php";
            }
        </script>
    </div>
</nav>