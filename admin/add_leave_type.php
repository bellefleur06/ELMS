<?php include '../includes/config.php';

$page = 'leave_type';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Leave Type</title>

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

                <?php if (isset($_SESSION['add-leave_type-failed'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['add-leave_type-failed']; ?></h5>
                <?php
                    unset($_SESSION['add-leave_type-failed']);
                endif; ?>

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Add Leave Type</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Leave Type</li>
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
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="first-name-icon">Leave Name</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="type" class="form-control" autocomplete="off" placeholder="Leave Name" required id="first-name-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-table"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="email-id-icon">Description</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="description" class="form-control" autocomplete="off" placeholder="Leave Description" required id="email-id-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-table"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group has-icon-left">
                                                            <label for="email-id-icon">Number of Days Allowed</label>
                                                            <div class="position-relative">
                                                                <input type="text" name="days_allowed" class="form-control" autocomplete="off" placeholder="Days Allowed" required id="email-id-icon">
                                                                <div class="form-control-icon">
                                                                    <i class="fa fa-table"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <a href="manage_leave_type.php" class="btn btn-danger me-1 mb-1">Back</a>
                                                        <button type="submit" name="add_leave_type" class="btn btn-primary me-1 mb-1 float-end">Save</button>
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