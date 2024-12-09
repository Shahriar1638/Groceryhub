<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreshBasket</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <!-- design plugs -->
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
    <main class="px-60">
        <section class="my-40">
            <?php
            require_once('DBconnect.php');
            $useremail = $_COOKIE['email'];
            $query = "SELECT * FROM users WHERE email = '$useremail'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $username = $row['username'];
                $email = $row['email'];
                $phone = $row['phone_number'];
                $gender = $row['gender'];
                $address = $row['address'];
                $role = $row['role'];
                $profileurl = $row['profileurl'];
            }
            ?>
            <div class="flex items-center gap-32 relative">
                <div class="absolute top-6 right-10">
                    <a href="editprofile.php" class="text-blue-500 hover:underline">
                        <i class="fas fa-edit mr-2"></i>Edit Profile
                    </a>
                </div>
                <div>
                    <img class="rounded-full w-[30rem] h-[30rem] object-cover" src="<?php echo $profileurl; ?>" alt="">
                </div>
                <div>
                    <h1 class="text-5xl uppercase mb-4 font-bold">
                        <i class="fas fa-user mr-4"></i><?php echo $username; ?>
                    </h1>
                    <p class="text-2xl mb-4">
                        <i class="fas fa-envelope mr-4"></i><?php echo $email; ?>
                    </p>
                    <p class="text-2xl mb-4">
                        <i class="fas fa-phone mr-4"></i><?php echo $phone; ?>
                    </p>
                    <p class="text-2xl mb-4">
                        <i class="fas fa-venus-mars mr-4"></i><?php echo $gender; ?>
                    </p>
                    <p class="text-2xl mb-4">
                        <i class="fas fa-map-marker-alt mr-4"></i><?php echo $address; ?>
                    </p>
                </div>
            </div>
        </section>
        <section>

        </section>
    </main>
</body>
</html>