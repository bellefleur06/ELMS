<?php include '../includes/config.php';

$page = 'leaves';

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

if (!isset($_GET['view_id'])) {

   $_SESSION['leave_application-not-found'] = "Leave Application Not Found";
   header('Location: all_leave.php');
   exit(0);
} else {

   $leave_id = $_GET['view_id'];
   $notification_status = 1;

   $query = "SELECT * FROM leave_types, employees, leave_applications WHERE leave_applications.leave_type_id = leave_types.id AND leave_applications.employee_id = employees.id AND leave_applications.id =:leave_id LIMIT 1";
   $statement = $conn->prepare($query);
   $data = [':leave_id' => $leave_id];
   $statement->execute($data);

   $results = $statement->fetch(PDO::FETCH_OBJ);

   if ($results) {

      $query = "UPDATE leave_applications SET notification_status=:notification_status WHERE id =:leave_id LIMIT 1";
      $statement = $conn->prepare($query);

      $data = [
         ':notification_status' => $notification_status,
         ':leave_id' => $leave_id
      ];

      $statement->execute($data);
   } else {
      $_SESSION['leave_application-not-found'] = "Leave Application Not Found";
      header('Location: all_leave.php');
      exit(0);
   }
}

if ($_GET['view_id'] = "") {

   $_SESSION['leave_application-not-found'] = "Leave Application Not Found";
   header('Location: all_leave.php');
   exit(0);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Leave Application Details</title>
   <link rel="stylesheet" href="../assets/css/bootstrap.css">
   <script defer src="../assets/fontawesome/js/all.min.js"></script>
   <link rel="stylesheet" href="../assets/vendors/chartjs/Chart.min.css">
   <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
   <link rel="stylesheet" href="../assets/css/app.css">
   <link rel="shortcut icon" href="../assets/images/favicon.svg" type="image/x-icon">
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

            <?php if (isset($_SESSION['approve-leave-application-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['approve-leave-application-success']; ?></h5>
            <?php
               unset($_SESSION['approve-leave-application-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['approve-leave-application-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['approve-leave-application-failed']; ?></h5>
            <?php
               unset($_SESSION['approve-leave-application-failed']);
            endif;
            ?>
            <?php if (isset($_SESSION['decline-leave-application-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['decline-leave-application-success']; ?></h5>
            <?php
               unset($_SESSION['decline-leave-application-success']);
            endif;
            ?>


            <div class="page-title">
               <h3>Leave Details</h3>
            </div>
            <section id="basic-vertical-layouts">
               <div class="row match-height">
                  <div class="col-md-12 col-12">
                     <div class="card">
                        <div class="card-content">
                           <div class="card-body">
                              <form class="form form-vertical" action="../includes/actions.php" method="post">
                                 <input type="hidden" name="leave_id" value="<?php echo $leave_id; ?>">
                                 <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                                 <div class="form-body">
                                    <div class="row">
                                       <div class="col-12">
                                          <table class='table' id="table1">
                                             <tbody>
                                                <tr>
                                                   <td><b>Full Name: </b><?php echo $results->first_name . " " . $results->last_name; ?></td>
                                                   <td><b>Age: </b><?php echo $results->age; ?></td>
                                                   <td><b>Gender: </b><?php echo $results->gender; ?></td>
                                                </tr>
                                                <tr>
                                                   <td><b>Leave Type:</b> <?php echo $results->leave_type; ?></td>
                                                   <td><b>Leave Date:</b> <?php echo date("M d, Y", strtotime($results->start_date)) . " to " . date("M d, Y", strtotime($results->end_date)); ?></td>
                                                   <td><b>Application Date: </b><?php echo date("M d, Y - h:i:a", strtotime($results->date_applied)); ?></td>
                                                </tr>
                                                <tr><?php if ($results->leave_status == '0') : ?>
                                                      <td><b>Leave Status: </b><span class="badge bg-info"> Pending </span></td>
                                                   <?php elseif ($results->leave_status == '1') : ?>
                                                      <td><b>Leave Status: </b><span class="badge bg-success"> Approved </span></td>
                                                   <?php else : ?>
                                                      <td><b>Leave Status: </b><span class="badge bg-danger"> Declined </span></td>
                                                   <?php endif; ?>
                                                   <td><b>Remarks: </b><?php echo $results->remarks; ?></td>
                                                   <?php if ($results->leave_status == '0') : ?>
                                                      <td></td>
                                                   <?php elseif ($results->leave_status == '1') : ?>
                                                      <td><b>Approved On: </b><?php echo date("M d, Y - h:i:a", strtotime($results->date_approved)); ?></td>
                                                   <?php else : ?>
                                                      <td><b>Declined On: </b><?php echo date("M d, Y", strtotime($results->date_declined)); ?></td>
                                                   <?php endif ?>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </div>
                                       <?php if ($results->leave_status == '0') : ?>
                                          <div class="col-12 d-flex justify-content-end">
                                             <button type="submit" name="approve_leave_application" class="btn btn-primary me-1 mb-1">Approve</button>
                                             <a href="decline_leave_application.php?view_id=<?php echo $results->id; ?>" class="btn btn-danger me-1 mb-1">Decline</a>
                                          </div>
                                       <?php else : ?>
                                          <div class="col-12 d-flex justify-content-end">
                                             <a href="all_leave.php" class="btn btn-danger me-1 mb-1">Back</a>
                                          </div>
                                       <?php endif; ?>
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
   <script src="../assets/vendors/chartjs/Chart.min.js"></script>
   <script src="../assets/vendors/apexcharts/apexcharts.min.js"></script>
   <script src="../assets/js/pages/dashboard.js"></script>
   <script src="../assets/js/main.js"></script>
</body>

</html>

<script>
   setTimeout(function() {
      document.getElementById("alert").style.display = "none";
   }, 3000);
</script>