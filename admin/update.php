<?php include '../includes/config.php';

if (!isset($_SESSION['username']) && !isset($_SESSION['access-admin'])) {
    header('Location: ../index.php');
}

if (!isset($_GET['edit_id'])) {

    header('Location: dashboard.php');
    exit(0);
} else {
    $user_id = $_GET['edit_id'];

    $query = "SELECT * FROM users WHERE id=:usr_id LIMIT 1";
    $statement = $conn->prepare($query);
    $data = [':usr_id' => $user_id];
    $statement->execute($data);

    $results = $statement->fetch(PDO::FETCH_OBJ);

    if ($results) {
    } else {

        header('Location: dashboard.php');
        exit(0);
    }
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
                <?php if (isset($_SESSION['invalid-file-format'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['invalid-file-format']; ?></h5>
                <?php
                    unset($_SESSION['invalid-file-format']);
                endif; ?>
                <?php if (isset($_SESSION['update-user-profile-success'])) : ?>
                    <h5 id="alert" class="alert alert-success"><?php echo $_SESSION['update-user-profile-success']; ?></h5>
                <?php
                    unset($_SESSION['update-user-profile-success']);
                endif; ?>
                <?php if (isset($_SESSION['update-user-profile-failed'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['update-user-profile-failed']; ?></h5>
                <?php
                    unset($_SESSION['update-user-profile-failed']);
                endif; ?>

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Update Profile</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>

                </div>

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="../includes/actions.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="id" value="<?php echo $results->id ?>">
                                            <input type="hidden" name="profile" value="<?php echo $results->avatar ?>">
                                            <div class="row">
                                                <div class="col-md-8 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Full Name</label>
                                                        <div class="position-relative">
                                                            <input type="text" name="fullname" class="form-control" autocomplete="off" placeholder="Full Name" value="<?php echo $results->fullname; ?>" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Profile</label>
                                                        <div class="position-relative">
                                                            <input type="file" name="avatar" class="form-control" id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Contact</label>
                                                        <div class="position-relative">
                                                            <input type="text" name="contact" class="form-control" autocomplete="off" placeholder="Contact" value="<?php echo $results->contact; ?>" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Email</label>
                                                        <div class="position-relative">
                                                            <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Email" value="<?php echo $results->email; ?>" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-envelope"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" name="password" class="form-control" placeholder="Enter Password To Save Changes" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit" name="update_user_profile" class="btn btn-primary me-1 mb-1">Save</button>
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