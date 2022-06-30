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
    <title>Add Employee</title>

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

                <?php if (isset($_SESSION['employee-details-required'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['employee-details-required']; ?></h5>
                <?php
                    unset($_SESSION['employee-details-required']);
                endif; ?>
                <?php if (isset($_SESSION['employee-already-exist'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['employee-already-exist']; ?></h5>
                <?php
                    unset($_SESSION['employee-already-exist']);
                endif; ?>
                <?php if (isset($_SESSION['invalid-file-format'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['invalid-file-format']; ?></h5>
                <?php
                    unset($_SESSION['invalid-file-format']);
                endif; ?>
                <?php if (isset($_SESSION['email-already-used'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['email-already-used']; ?></h5>
                <?php
                    unset($_SESSION['email-already-used']);
                endif; ?>
                <?php if (isset($_SESSION['username-already-used'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['username-already-used']; ?></h5>
                <?php
                    unset($_SESSION['username-already-used']);
                endif; ?>
                <?php if (isset($_SESSION['add-employee-failed'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['add-employee-failed']; ?></h5>
                <?php
                    unset($_SESSION['add-employee-failed']);
                endif; ?>

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Add Employee</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Employee</li>
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
                                            <div class="row">
                                                <?php $emp_id = "EMP-" . rand(000, 999); ?>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">ID Number</label>
                                                        <div class="position-relative">
                                                            <input type="text" name="id" class="form-control" value="<?php echo $emp_id; ?>" readonly id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-hashtag"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Gender</label>
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select" name="gender" id="basicSelect">
                                                                    <option disabled selected value="0">-- Select Gender -- </option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">First Name</label>
                                                        <div class="position-relative">
                                                            <input type="text" name="first_name" class="form-control" placeholder="First Name" autocomplete="off" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Middle Name</label>
                                                        <div class="position-relative">
                                                            <input type="text" name="middle_name" class="form-control" placeholder="Middle Name (Optional)" autocomplete="off" id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Last Name</label>
                                                        <div class="position-relative">
                                                            <input type="text" name="last_name" class="form-control" placeholder="Last Name" autocomplete="off" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Age</label>
                                                        <div class="position-relative">
                                                            <input type="number" name="age" class="form-control" placeholder="Age" autocomplete="off" min="0" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Email</label>
                                                        <div class="position-relative">
                                                            <input type="email" name="email_address" class="form-control" placeholder="Email" autocomplete="off" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-envelope"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Contact</label>
                                                        <div class="position-relative">
                                                            <input type="number" name="contact_number" class="form-control" placeholder="Contact" autocomplete="off" min="0" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-phone"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Profile</label>
                                                        <div class="position-relative">
                                                            <input type="file" name="avatar" class="form-control" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $query = "SELECT * FROM departments ORDER BY department_name ASC";
                                                try {
                                                    $statement = $conn->prepare($query);
                                                    $statement->execute();

                                                    $statement->setFetchMode(PDO::FETCH_OBJ);
                                                    $result = $statement->fetchAll();
                                                } catch (PDOException $e) {

                                                    echo ($e->getMessage());
                                                } ?>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Department</label>
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="department" id="basicSelect">
                                                                <option disabled selected value="0">-- Select Department --</option>
                                                                <?php foreach ($result as $row) { ?>
                                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->department_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <?php
                                                $query = "SELECT * FROM designations ORDER BY designation_name ASC";
                                                try {
                                                    $statement = $conn->prepare($query);
                                                    $statement->execute();

                                                    $statement->setFetchMode(PDO::FETCH_OBJ);
                                                    $result = $statement->fetchAll();
                                                } catch (PDOException $e) {

                                                    echo ($e->getMessage());
                                                } ?>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Designation</label>
                                                        <fieldset class="form-group">
                                                            <select class="form-select" name="designation" id="basicSelect">
                                                                <option disabled selected value="0">-- Select Designation --</option>
                                                                <?php foreach ($result as $row) { ?>
                                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->designation_name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Username</label>
                                                        <div class="position-relative">
                                                            <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Password</label>
                                                        <div class="position-relative">
                                                            <input type="password" name="password" class="form-control" placeholder="Passsword" autocomplete="off" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-key"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <a href="manage_employee.php" class="btn btn-danger me-1 mb-1">Back</a>
                                                    <button type="submit" name="add_employee" class="btn btn-primary me-1 mb-1 float-end">Save</button>
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