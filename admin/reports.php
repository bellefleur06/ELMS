<?php include '../includes/config.php';

$page = 'report';

if (!isset($_SESSION['username'])) {
   header('Location: ../index.php');
}

$query = "SELECT "

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reports</title>

   <link rel="stylesheet" href="../assets/css/bootstrap.css">

   <script defer src="../assets/fontawesome/js/all.min.js"></script>
   <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
   <link rel="stylesheet" href="../assets/css/app.css">
   <style type="text/css">
      .notif:hover {
         background-color: rgba(0, 0, 0, 0.1);
      }
   </style>
</head>

<body>
   <div id="app">

      <?php include '../includes/sidebar.php'; ?>

      <div id="main">
         <nav class="navbar navbar-header navbar-expand navbar-light">
            <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
            <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button>

            <?php include '../includes/navbar.php'; ?>

         </nav>

         <div class="main-content container-fluid">
            <div class="page-title">
               <div class="row">
                  <div class="col-12 col-md-6 order-md-1 order-last">
                     <h3>Reports</h3>
                  </div>
                  <div class="col-12 col-md-6 order-md-2 order-first">
                     <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Reports</li>
                        </ol>
                     </nav>
                  </div>
               </div>

            </div>


            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
               <div class="row match-height">
                  <div class="col-md-12 col-12">
                     <div class="card">
                        <div class="card-content">
                           <div class="card-body">
                              <form class="form form-vertical">
                                 <div class="form-body">
                                    <div class="row">
                                       <div class="col-12">
                                          <div class="card-body">
                                             <div class="chart chart-lg">
                                                <canvas id="chartjs-pie"></canvas>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- // Basic Vertical form layout section end -->
         </div>
      </div>
   </div>
   <script src="../assets/js/feather-icons/feather.min.js"></script>
   <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
   <script src="../assets/js/app.js"></script>

   <script src="../assets/js/main.js"></script>
   <script src="../assets/js/chart.js"></script>
   <script>
      document.addEventListener("DOMContentLoaded", function() {
         // Pie chart
         new Chart(document.getElementById("chartjs-pie"), {
            type: "pie",
            data: {
               labels: ["Approved", "Pending", "Cancelled"],
               datasets: [{
                  data: [34, 12, 15],
                  backgroundColor: [
                     window.theme.primary,
                     window.theme.warning,
                     window.theme.danger,
                  ],
                  borderColor: "transparent"
               }]
            },
            options: {
               maintainAspectRatio: true,
               legend: {
                  display: true
               }
            }
         });
      });
   </script>
</body>

</html>