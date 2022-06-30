<?php

include 'includes/config.php';

if (isset($_SESSION['username']) && isset($_SESSION['access-admin'])) {
    header('Location: admin/dashboard.php');
} else if (isset($_SESSION['username']) && isset($_SESSION['access-employee'])) {
    header('Location: employee/dashboard.php');
}

$login_as_employee = false;

if (isset($_GET['login_as'])) {

    $login_as_employee = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <script defer src="assets/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth">

        <div class="container">
            <div class="row">

                <?php if ($login_as_employee == true) : ?>

                    <div class="col-md-5 col-sm-12 mx-auto">
                        <div class="card pt-4">
                            <div class="card-body">

                                <?php if (isset($_SESSION['login-failed'])) : ?>
                                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['login-failed']; ?></h5>
                                <?php
                                    unset($_SESSION['login-failed']);
                                endif; ?>

                                <div class="text-center mb-3">
                                    <h3>ELMS (Employee)</h3>
                                </div>
                                <form action="includes/actions.php" method="POST">
                                    <div class="form-group position-relative has-icon-left">
                                        <label for="username">Username</label>
                                        <div class="position-relative">
                                            <input type="text" name="username" class="form-control" id="username" autocomplete="off" required>
                                            <div class="form-control-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group position-relative has-icon-left">
                                        <label for="password">Password</label>
                                        <!-- <a href="login.php" class='float-end'>
                                            <small>Forgot password?</small>
                                        </a> -->
                                        <div class="position-relative">
                                            <input type="password" name="password" class="form-control" id="password" autocomplete="off" required>
                                            <div class="form-control-icon">
                                                <i class="fa fa-key"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-check clearfix my-1'>
                                    </div>
                                    <div class="clearfix">
                                        <a href="index.php">
                                            <label>Login as Admin?</label>
                                        </a>
                                        <button type="submit" name="employee_login" class="btn btn-primary float-end">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php else : ?>

                    <div class="col-md-5 col-sm-12 mx-auto">
                        <div class="card pt-4">
                            <div class="card-body">

                                <?php if (isset($_SESSION['login-failed'])) : ?>
                                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['login-failed']; ?></h5>
                                <?php
                                    unset($_SESSION['login-failed']);
                                endif; ?>

                                <div class="text-center mb-3">
                                    <h3>ELMS (Admin)</h3>
                                </div>
                                <form action="includes/actions.php" method="POST">
                                    <div class="form-group position-relative has-icon-left">
                                        <label for="username">Username</label>
                                        <div class="position-relative">
                                            <input type="text" name="username" class="form-control" id="username" autocomplete="off" required>
                                            <div class="form-control-icon">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group position-relative has-icon-left">
                                        <label for="password">Password</label>
                                        <!-- <a href="login.php" class='float-end'>
                                            <small>Forgot password?</small>
                                        </a> -->
                                        <div class="position-relative">
                                            <input type="password" name="password" class="form-control" id="password" autocomplete="off" required>
                                            <div class="form-control-icon">
                                                <i class="fa fa-key"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='form-check clearfix my-1'>
                                    </div>
                                    <div class="clearfix">
                                        <a href="index.php?login_as=employee">
                                            <label>Login as Employee?</label>
                                        </a>
                                        <button type="submit" name="admin_login" class="btn btn-primary float-end">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>