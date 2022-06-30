<?php include '../includes/config.php';

$page = 'employee';

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>

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

                <?php if (isset($_SESSION['add-employee-success'])) : ?>
                    <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['add-employee-success']; ?></h5>
                <?php
                    unset($_SESSION['add-employee-success']);
                endif;
                ?>
                <?php if (isset($_SESSION['delete-employee-success'])) : ?>
                    <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['delete-employee-success']; ?></h5>
                <?php
                    unset($_SESSION['delete-employee-success']);
                endif;
                ?>
                <?php if (isset($_SESSION['delete-employee-failed'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['delete-employee-failed']; ?></h5>
                <?php
                    unset($_SESSION['delete-employee-failed']);
                endif;
                ?>
                <?php if (isset($_SESSION['employee-not-found'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['employee-not-found']; ?></h5>
                <?php
                    unset($_SESSION['employee-not-found']);
                endif;
                ?>
                <?php if (isset($_SESSION['invalid-file-format'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['invalid-file-format']; ?></h5>
                <?php
                    unset($_SESSION['invalid-file-format']);
                endif; ?>

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Employees</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Employees</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <a href="add_employee.php" class="btn btn-success me-1 mb-3">Add Employee</a>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class='table' id="table1">
                                <thead>
                                    <tr>
                                        <th>Emp ID</th>
                                        <th>Full Name</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Reg Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $query = "SELECT * FROM departments, employees WHERE employees.department_id = departments.id";
                                    $statement = $conn->prepare($query);
                                    $statement->execute();

                                    $statement->setFetchMode(PDO::FETCH_OBJ);
                                    $result = $statement->fetchAll();

                                    //if you were to use PDO::FETCH_ASSOC, the proper way to call your data in the database is $row['creation_date'];

                                    if ($result) {

                                        foreach ($result as $row) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row->employee_id ?></td>
                                                <td><?php echo $row->first_name . " " . $row->last_name ?></td>
                                                <td><?php echo $row->department_name ?></td>
                                                <?php if ($row->account_status == '1') : ?>
                                                    <td>
                                                        <span class="badge bg-success">Active</span>
                                                    </td>
                                                <?php else : ?>
                                                    <td>
                                                        <span class="badge bg-danger">Inactive</span>
                                                    </td>
                                                <?php endif ?>
                                                <td><?php echo date("M d, Y", strtotime($row->registration_date)); ?></td>
                                                <td>
                                                    <a href="employee_details.php?view_id=<?php echo $row->id; ?>"><i class="fa fa-eye text-success"></i></a>
                                                    <a href="edit_employee.php?edit_id=<?php echo $row->id; ?>"><i class="fa fa-pen text-primary"></i></a>
                                                    <a href="../includes/actions.php?delete_employee=<?php echo $row->id; ?>"><i class="fa fa-trash text-danger" onclick="return confirm('Are you sure you want to delete this record?');"></i></a>
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
    <script src="../assets/js/feather-icons/feather.min.js"></script>
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