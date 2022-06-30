<?php include '../includes/config.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['access-employee'])) {
    header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <script defer src="../assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../assets/css/app.css">
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

                <?php if (isset($_SESSION['incorrect-password'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['incorrect-password']; ?></h5>
                <?php
                    unset($_SESSION['incorrect-password']);
                endif; ?>
                <?php if (isset($_SESSION['password-not-match'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['password-not-match']; ?></h5>
                <?php
                    unset($_SESSION['password-not-match']);
                endif; ?>
                <?php if (isset($_SESSION['update-user-password-success'])) : ?>
                    <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['update-user-password-success']; ?></h5>
                <?php
                    unset($_SESSION['update-user-password-success']);
                endif; ?>
                <?php if (isset($_SESSION['update-user-password-failed'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['update-user-password-failed']; ?></h5>
                <?php
                    unset($_SESSION['update-user-password-failed']);
                endif; ?>

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Update Password</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Password</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-8">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="../includes/actions.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Current Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" name="old_password" class="form-control" placeholder="Current Password" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">New Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" name="new_password" class="form-control" placeholder="New Password" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Confirm Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" name="update_user_password" class="btn btn-primary me-1 mb-1">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>

        </div>
    </div>
    <script src="../assets/js/feather-icons/feather.min.js"></script>
    <script src="../assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/app.js"></script>

    <script src="../assets/js/main.js"></script>
</body>

</html>