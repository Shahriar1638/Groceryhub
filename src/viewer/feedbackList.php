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
              <h1 class="text-4xl font-bold uppercase text-center mb-8">User feedbacks</h1>
            </div>
            <div>

            </div>
            <div>
              <?php
              require 'dbconnect.php';

              $query = "SELECT email, message, time FROM feedbacks";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
                ?>
                <table class="table-auto w-[70rem] text-left border-none">
                  <thead>
                    <tr>
                      <th class="px-4 py-2">Email</th>
                      <th class="px-4 py-2">Message</th>
                      <th class="px-4 py-2">Time</th>
                    </tr>
                  </thead>
                <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                  ?>
                  <tr>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($row['email']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($row['message']) ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($row['time']) ?></td>
                  </tr>
                  <?php
                }
                echo '</tbody>';
                echo '</table>';
              } else {
                echo '<p class="text-center font-bold text-5xl">No feedbacks found.</p>';
              }
              ?>
            </div>
          </div>
        </div>
      </section>
    </main>
</body>
</html>