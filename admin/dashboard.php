<?php include '../includes/config.php';

$page = 'dashboard';

if (!isset($_SESSION['username']) && !isset($_SESSION['access-admin'])) {
   header('Location: ../index.php');
}

$username = $_SESSION['username'];

$query = "SELECT * FROM users WHERE username=:username";
$statement = $conn->prepare($query);
$data = [':username' => $username];

$statement->execute($data);
$results = $statement->fetch();

$_SESSION['id'] = $results['id'];
$_SESSION['user_category'] = $results['user_category'];
$_SESSION['avatar'] = $results['avatar'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>
   <link rel="stylesheet" href="../assets/css/bootstrap.css">
   <script defer src="../assets/fontawesome/js/all.min.js"></script>
   <link rel="stylesheet" href="../assets/vendors/chartjs/Chart.min.css">
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
               <h3>Dashboard</h3>
            </div>
            <section class="section">
               <div class="row mb-2">
                  <div class="col-xl-4 col-md-12 mb-4">
                     <div class="card">
                        <a href="manage_employee.php">
                           <div class="card-body">
                              <div class="d-flex justify-content-between p-md-1">
                                 <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                       <i class="fa fa-users text-warning fa-3x me-4"></i>
                                    </div>
                                    <div>
                                       <?php $count = $conn->query("SELECT count(*) FROM employees")->fetchColumn(); ?>
                                       <h4>Employees</h4>
                                       <h2 class="h1 mb-0"><?php echo $count; ?></h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-4 col-md-12 mb-4">
                     <div class="card">
                        <a href="all_leave.php">
                           <div class="card-body">
                              <div class="d-flex justify-content-between p-md-1">
                                 <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                       <i class="fa fa-plane text-success fa-3x me-4"></i>
                                    </div>
                                    <div>
                                       <?php $count = $conn->query("SELECT count(*) FROM leave_applications")->fetchColumn(); ?>
                                       <h4>Leave</h4>
                                       <h2 class="h1 mb-0"><?php echo $count; ?></h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-4 col-md-12 mb-4">
                     <div class="card">
                        <a href="approve_leave.php">
                           <div class="card-body">
                              <div class="d-flex justify-content-between p-md-1">
                                 <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                       <i class="fa fa-check text-info fa-3x me-4"></i>
                                    </div>
                                    <div>
                                       <?php $count = $conn->query("SELECT count(*) FROM leave_applications WHERE leave_status = '1'")->fetchColumn(); ?>
                                       <h4>Approved</h4>
                                       <h2 class="h1 mb-0"><?php echo $count; ?></h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-4 col-md-12 mb-4">
                     <div class="card">
                        <a href="pending_leave.php">
                           <div class="card-body">
                              <div class="d-flex justify-content-between p-md-1">
                                 <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                       <i class="fa fa-info text-warning fa-3x me-4"></i>
                                    </div>
                                    <div>
                                       <?php $count = $conn->query("SELECT count(*) FROM leave_applications WHERE leave_status = '0'")->fetchColumn(); ?>
                                       <h4>Pending</h4>
                                       <h2 class="h1 mb-0"><?php echo $count; ?></h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="col-xl-4 col-md-12 mb-4">
                     <div class="card">
                        <a href="not_approve_leave.php">
                           <div class="card-body">
                              <div class="d-flex justify-content-between p-md-1">
                                 <div class="d-flex flex-row">
                                    <div class="align-self-center">
                                       <i class="fa fa-trash text-danger fa-3x me-4"></i>
                                    </div>
                                    <div>
                                       <?php $count = $conn->query("SELECT count(*) FROM leave_applications WHERE leave_status = '2'")->fetchColumn(); ?>
                                       <h4>Declined</h4>
                                       <h2 class="h1 mb-0"><?php echo $count; ?></h2>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </a>
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>
   <script src="../assets/js/feather-icons/feather.min.js"></script>
   <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
   <script src="../assets/js/app.js"></script>
   <script src="../assets/vendors/chartjs/Chart.min.js"></script>
   <script src="../assets/vendors/apexcharts/apexcharts.min.js"></script>
   <script src="../assets/js/pages/dashboard.js"></script>
   <script src="../assets/js/main.js"></script>
</body>

</html>