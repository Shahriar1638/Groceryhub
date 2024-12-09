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
            <div class="flex flex-col">
              <h1 class="text-4xl font-bold mb-6 uppercase">Register new admin informations</h1>
              <form action="handleSignupAdmin.php" method="post">
                <div class="flex flex-col space-y-6 mb-4">
                  <input class="px-6 py-2 rounded-md border border-solid border-gray-400 w-[50rem]" type="text" name="username" placeholder="Enter admin username......" required>
                  <input class="px-6 py-2 rounded-md border border-solid border-gray-400 w-[50rem]" type="email" name="email" placeholder="Enter admin email......" required>
                  <input class="px-6 py-2 rounded-md border border-solid border-gray-400 w-[50rem]" type="password" name="password" placeholder="set admin userpassword......" required>
                  <select class="px-6 py-2 rounded-md border border-solid border-gray-400 w-[50rem]" name="gender" required>
                    <option value="" disabled selected>Select gender...</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
                  <input class="px-6 py-2 rounded-md border border-solid border-gray-400 w-[50rem]" type="text" name="phone" placeholder="Enter admin phone number......" required>
                  <input class="px-6 py-2 rounded-md border border-solid border-gray-400 w-[50rem]" type="text" name="address" placeholder="Enter admin address......" required>
                  <input class="px-6 py-2 rounded-md border border-solid border-gray-400 w-[50rem]" type="url" name="profileurl" placeholder="Enter admin profile URL......" required>
                </div>
                <input type="submit" value="Sign up" class="px-6 py-2 w-[50rem] bg-greenSecondary font-bold uppercase rounded-md text-white cursor-pointer transition duration-300 ease-in">
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>
</body>
</html>