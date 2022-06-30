<?php include '../includes/config.php';

$page = 'employee';

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

if (!isset($_GET['view_id'])) {

    $_SESSION['employee-not-found'] = "Employee Not Found";
    header('Location: manage_employee.php');
    exit(0);
} else {
    $employee_id = $_GET['view_id'];

    $query = "SELECT * FROM departments, designations, employees WHERE employees.department_id = departments.id AND employees.designation_id = designations.id AND employees.id=:emp_id LIMIT 1";
    $statement = $conn->prepare($query);
    $data = [':emp_id' => $employee_id];
    $statement->execute($data);

    $results = $statement->fetch(PDO::FETCH_OBJ);

    if ($results) {
    } else {

        $_SESSION['employee-not-found'] = "Employee Not Found";
        header('Location: manage_employee.php');
        exit(0);
    }
}

if ($_GET['view_id'] = "") {

    $_SESSION['employee-not-found'] = "Employee Not Found";
    header('Location: manage_employee.php');
    exit(0);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details</title>
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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Employee Details</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Employee Details</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section id="basic-vertical-layouts">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12 table-responsive">
                                                        <table class='table' id="table1">

                                                            <tbody>
                                                                <tr>
                                                                    <td><b>EMP ID: </b><?php echo $results->employee_id; ?></td>
                                                                    <td><b>Full Name: </b><?php echo $results->first_name . " " . $results->middle_name . " " . $results->last_name; ?></td>
                                                                    <td><b>Profile Image: </b>
                                                                        <img src="../images/<?php echo $results->avatar; ?>" style="width:125px; height:125px;">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Age: </b><?php echo $results->age; ?></td>
                                                                    <td><b>Gender: </b><?php echo $results->gender; ?></td>
                                                                    <td><b>Contact Number: </b><?php echo $results->contact_number ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Email Address: </b> <?php echo $results->email_address ?></td>
                                                                    <td><b>Department: </b><?php echo $results->department_name; ?></td>
                                                                    <td><b>Designation: </b><?php echo $results->designation_name; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Registration Date: </b><?php echo date("M d, Y - h:i:a", strtotime($results->registration_date)); ?></td>
                                                                    <?php if ($results->account_status == '1') : ?>
                                                                        <td><b>Employee Status: </b><span class="badge bg-success">Active</span>
                                                                        </td>
                                                                    <?php else : ?>
                                                                        <td><b>Employee Status: </b><span class="badge bg-danger">Inactive</span>
                                                                        </td>
                                                                    <?php endif ?></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="col-12 d-flex justify-content-end">
                                                        <a href="manage_employee.php" class="btn btn-danger me-1 mb-1">Back</a>
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
    <script src="../assets/vendors/chartjs/Chart.min.js"></script>
    <script src="../assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/js/pages/dashboard.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>