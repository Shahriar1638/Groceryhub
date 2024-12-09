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
    <div class="flex items-center">
        <h1 class="text-2xl font-semibold uppercase mr-4">Welcome to admin dashboard, <?php echo $username ?></h1>
        <button onclick='handleSignout()' class='bg-[#D2222D] text-white block px-6 py-3 rounded-md uppercase font-semibold'>logout</button>
    </div>
    <script>
        function handleSignout() {
        document.cookie.split(";").forEach(function(c) { 
            document.cookie = c.trim().split("=")[0] + "=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/"; 
        });
        window.location.href = "login.php";
        }
    </script>
</nav>