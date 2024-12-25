<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groceryhub</title>
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
      <section class="pl-40 pt-4 h-screen">
        <div class="grid grid-cols-6">
          <div class="mt-16">
            <?php include 'sidebar2.php'; ?>
          </div>
          <div class="col-span-5 bg-white rounded-tl-3xl h-screen pl-12 pt-12 border-2 border-solid border-l-yellowPrimary border-t-yellowPrimary border-r-transparent border-b-transparent">
            <?php
            require_once('DBconnect.php');
            $useremail = $_COOKIE['email'];
            $username = $_COOKIE['username'];
            ?>
            <div>
              <h1 class="text-4xl font-bold uppercase text-center mb-8">Welcome home, <?php echo $username; ?></h1>
            </div>
            <div class="mb-8">
              <h2 class="text-2xl font-semibold">Your Revenue: $<?php echo $_COOKIE['revenue']; ?></h2>
            </div>
            <div class="mb-8">
              <h2 class="text-2xl font-semibold">Approved Products</h2>
              <?php
              $sql = "SELECT COUNT(*) as count FROM products WHERE status='published' AND selleremail='$useremail'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
              $approvedCount = $row['count'];
              ?>
              <p class="text-xl">Number of Approved Products: <?php echo $approvedCount; ?></p>
            </div>
            <div>
              <h2 class="text-2xl font-semibold mb-4">Approved Products Info</h2>
              <table class="table-auto w-[80rem]">
                <thead>
                  <tr>
                    <th class="px-4 py-2">Product Name</th>
                    <th class="px-4 py-2">Sell Count</th>
                    <th class="px-4 py-2">Ratings</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT name, cartcount, rating FROM products WHERE status='published' AND selleremail='$useremail'";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='border px-4 py-2'>" . $row['name'] . "</td>";
                    echo "<td class='border px-4 py-2'>" . $row['cartcount'] . "</td>";
                    $rating = intval($row['rating']);
                    echo "<td class='border px-4 py-2'>";
                    for ($i = 0; $i < 5; $i++) {
                      if ($i < $rating) {
                      echo "<i class='fas fa-star text-yellow-500'></i>";
                      } else {
                      echo "<i class='far fa-star text-yellow-500'></i>";
                      }
                    }
                    echo "</td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </main>
</body>
</html>