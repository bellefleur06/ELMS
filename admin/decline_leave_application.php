<?php include '../includes/config.php';

$page = 'leaves';

if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

if (!isset($_GET['view_id'])) {

    $_SESSION['leave_application-not-found'] = "Leave Application Not Found";
    header('Location: all_leave.php');
    exit(0);
} else {
    $leave_id = $_GET['view_id'];

    $query = "SELECT * FROM leave_types, employees, leave_applications WHERE leave_applications.leave_type_id = leave_types.id AND leave_applications.employee_id = employees.id AND leave_applications.id =:leave_id LIMIT 1";
    $statement = $conn->prepare($query);
    $data = [':leave_id' => $leave_id];
    $statement->execute($data);

    $results = $statement->fetch(PDO::FETCH_OBJ);

    if ($results) {
    } else {
        $_SESSION['leave_application-not-found'] = "Leave Application Not Found";
        header('Location: all_leave.php');
        exit(0);
    }
}

if ($_GET['view_id'] = "") {

    $_SESSION['leave_application-not-found'] = "Leave Application Not Found";
    header('Location: manage_employee.php');
    exit(0);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Decline Leave Application</title>

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

                <?php if (isset($_SESSION['decline-leave-application-failed'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['decline-leave-application-failed']; ?></h5>
                <?php
                    unset($_SESSION['decline-leave-application-failed']);
                endif;
                ?>

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Decline Leave Application</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dasnboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Decline Leave Application</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row match-height">
                        <div class="col-md-8 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-vertical" action="../includes/actions.php" method="post">
                                            <input type="hidden" name="leave_id" value="<?php echo $results->id; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Decline Reason</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="reason" class="form-control" autocomplete="off" placeholder="Decline Reason" id="first-name-icon" required>
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-table"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <a href="leave_details.php?view_id=<?php echo $results->id; ?>" class="btn btn-danger me-1 mb-1">Back</a>
                                                        <button type="submit" name="decline_leave_application" class="btn btn-primary me-1 mb-1 float-end">Decline</button>
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
</body>

</html>