<!DOCTYPE html>
<html data-theme="light" lang="en" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groceryhub</title>
    <!-- design plugs -->
    <script src="https://kit.fontawesome.com/5f28ebb90a.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.3/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                    <h1 class="text-4xl font-bold uppercase text-center mb-8">Reports</h1>
                </div>
                <div class='overflow-x-auto'>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th class="uppercase">Reporter Name</th>
                                <th class="uppercase">Reporter Email</th>
                                <th class="uppercase">Message</th>
                                <th class="uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            require_once('DBconnect.php');
                            $query = "SELECT * FROM reports";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0){
                                while ($row = mysqli_fetch_assoc($result)){
                                    $reportid = $row['report_id'];
                                    $reporterName = $row['reporter_name'];
                                    $reporterEmail = $row['reporter_email'];
                                    $message = $row['message'];
                                    $status = $row['status'];
                                    ?>
                                    <tr>
                                        <td><?php echo $reporterName ?></td>
                                        <td><?php echo $reporterEmail ?></td>
                                        <td><?php echo $message ?></td>
                                        <td>
                                            <?php if ($status == '0') { ?>
                                                <Button onclick="handleReportAction('<?php echo$reportid?>','1')" class="bg-yellowPrimary text-white px-4 py-2 rounded-md">Pending</Button>
                                            <?php } else { ?>
                                                <span class="bg-greenSecondary text-white px-4 py-2 rounded-md">Action taken</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }?>
                        </tbody>
                    </table>
                    <form id="HandleReport" action="../controler/handleReportAction.php" method="post" class="hidden">
                        <input type="hidden" name="reportId" id="reportId">
                        <input type="hidden" name="action" id="action">
                    </form>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        function handleReportAction(reportId, action) {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "Did you take action properly?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, confirm it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    document.getElementById('reportId').value = reportId;
                                    document.getElementById('action').value = action;
                                    document.querySelector('form').submit();
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
      </section>
    </main>
</body>
</html>