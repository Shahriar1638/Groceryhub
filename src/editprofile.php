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
        </section>
        <section class="my-40">
            <form action="handleEditProfile.php" method="POST">
                <div class="mb-4">
                    <label for="username" class="block text-lg font-medium text-gray-700">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $username; ?>" class="mt-2 block w-full shadow-md px-6 py-2 border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="mt-2 block w-full shadow-md px-6 py-2 border-gray-300 rounded-md" readonly>
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-lg font-medium text-gray-700">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" class="mt-2 block w-full shadow-md px-6 py-2 border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-lg font-medium text-gray-700">Gender</label>
                    <select name="gender" id="gender" class="mt-2 block w-full shadow-md px-6 py-2 border-gray-300 rounded-md">
                        <option value="Male" <?php if($gender == 'Male') echo 'selected'; ?>>Male</option>
                        <option value="Female" <?php if($gender == 'Female') echo 'selected'; ?>>Female</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-lg font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="<?php echo $address; ?>" class="mt-2 block w-full shadow-md px-6 py-2 border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="profileurl" class="block text-lg font-medium text-gray-700">Profile Picture URL</label>
                    <input type="text" name="profileurl" id="profileurl" value="<?php echo $profileurl; ?>" class="mt-2 block w-full shadow-md px-6 py-2 border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-lg font-medium text-gray-700">Role</label>
                    <input type="text" name="role" id="role" value="<?php echo $role; ?>" class="mt-2 block w-full shadow-md px-6 py-2 border-gray-300 rounded-md" readonly>
                </div>
                <div class="mt-6">
                    <button type="submit" class="px-4 py-2 bg-yellowPrimary text-white rounded-md">Save Changes</button>
                </div>
            </form>
        </section>
        <section>

        </section>
    </main>
</body>
</html>