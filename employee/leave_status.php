<?php include '../includes/config.php';

$page = 'leave-status';

if (!isset($_SESSION['username']) && !isset($_SESSION['access-employee'])) {
    header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Status</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <link rel="stylesheet" href="../assets/vendors/simple-datatables/style.css">

    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
</head>

<body>
    <div id="app">

        <?php include '../includes/e_sidebar.php'; ?>

        <div id="main">
            <nav class="navbar navbar-header navbar-expand navbar-light">
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php include '../includes/e_navbar.php'; ?>

            </nav>

            <div class="main-content container-fluid">

                <?php if (isset($_SESSION['apply-leave-success'])) : ?>
                    <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['apply-leave-success']; ?></h5>
                <?php
                    unset($_SESSION['apply-leave-success']);
                endif;
                ?>

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Leave Status</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Leave Status</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <a href="apply_leave.php" class="btn btn-success me-1 mb-3">Apply Leave</a>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>Leave Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Date Applied</th>
                                        <th>Remark</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = "SELECT * FROM leave_types, leave_applications WHERE leave_applications.leave_type_id = leave_types.id AND leave_applications.employee_id = '{$_SESSION['id']}'";
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
                                                <td><?php echo date("M d, Y", strtotime($row->start_date)); ?></td>
                                                <td><?php echo date("M d, Y", strtotime($row->end_date)); ?></td>
                                                <td><?php echo date("M d, Y - h:i:a", strtotime($row->date_applied)); ?></td>
                                                <td><?php echo $row->remarks; ?></td>
                                                <?php if ($row->leave_status == '0') : ?>
                                                    <td>
                                                        <span class="badge bg-info">Pending</span>
                                                    </td>
                                                <?php elseif ($row->leave_status == '1') : ?>
                                                    <td>
                                                        <span class="badge bg-success">Approved</span>
                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <span class="badge bg-danger">Declined</span>
                                                    </td>
                                                <?php endif ?>
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
    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/js/vendors.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>