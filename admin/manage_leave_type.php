<?php include '../includes/config.php';

$page = 'leave_type';

if (!isset($_SESSION['username'])) {
   header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Leave Types</title>

   <link rel="stylesheet" href="../assets/css/bootstrap.css">

   <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">

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

            <?php if (isset($_SESSION['add-leave_type-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['add-leave_type-success']; ?></h5>
            <?php
               unset($_SESSION['add-leave_type-success']);
            endif; ?>
            <?php if (isset($_SESSION['delete-leave_type-success'])) : ?>
               <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['delete-leave_type-success']; ?></h5>
            <?php
               unset($_SESSION['delete-leave_type-success']);
            endif;
            ?>
            <?php if (isset($_SESSION['delete-leave_type-failed'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['delete-leave_type-failed']; ?></h5>
            <?php
               unset($_SESSION['delete-leave_type-failed']);
            endif;
            ?>
            <?php if (isset($_SESSION['leave_type-not-found'])) : ?>
               <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['leave_type-not-found']; ?></h5>
            <?php
               unset($_SESSION['leave_type-not-found']);
            endif;
            ?>

            <div class="page-title">
               <div class="row">
                  <div class="col-12 col-md-6 order-md-1 order-last">
                     <h3>Leave Types</h3>
                  </div>
                  <div class="col-12 col-md-6 order-md-2 order-first">
                     <nav aria-label="breadcrumb" class='breadcrumb-header'>
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Leave Types</li>
                        </ol>
                     </nav>
                  </div>
               </div>
            </div>

            <a href="add_leave_type.php" class="btn btn-success me-1 mb-3">Add Leave Type</a>

            <section class="section">
               <div class="card">
                  <div class="card-body">
                     <table class='table' id="table1">
                        <thead>
                           <tr>
                              <th>Leave Name</th>
                              <th>Description</th>
                              <th>Days Allowed</th>
                              <th>Creation Date</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php

                           $query = "SELECT * FROM leave_types";
                           $statement = $conn->prepare($query);
                           $statement->execute();

                           $statement->setFetchMode(PDO::FETCH_OBJ);
                           $result = $statement->fetchAll();

                           //if you were to use PDO::FETCH_ASSOC, the proper way to call your data in the database is $row['creation_date'];

                           if ($result) {

                              foreach ($result as $row) {
                           ?>
                                 <tr>
                                    <td><?php echo $row->leave_type; ?></td>
                                    <td><?php echo $row->description; ?></td>
                                    <td><?php echo $row->days_allowed; ?> days</td>
                                    <td><?php echo date("M d, Y - h:i:a", strtotime($row->creation_date)); ?></td>
                                    <td>
                                       <a href="edit_leave_type.php?edit_id=<?php echo $row->id; ?>"><i class="fa fa-pen text-success"></i></a>
                                       <a href="../includes/actions.php?delete_leave_type=<?php echo $row->id; ?>"><i class="fa fa-trash text-danger" onclick="return confirm('Are you sure you want to delete this record?');"></i></a>
                                    </td>
                                 </tr>
                           <?php
                              }
                           } else {
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>

            </section>
         </div>
      </div>
   </div>
   <script src=" ../assets/js/feather-icons/feather.min.js"></script>
   <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
   <script src="../assets/js/app.js"></script>

   <script src="../assets/vendors/simple-datatables/simple-datatables.js"></script>
   <script src="../assets/js/vendors.js"></script>

   <script src="../assets/js/main.js"></script>
</body>

</html>

<script>
   setTimeout(function() {
      document.getElementById("alert").style.display = "none";
   }, 3000);
</script>