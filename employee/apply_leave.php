<?php include '../includes/config.php';

$page = 'apply-leave';

if (!isset($_SESSION['username']) && !isset($_SESSION['access-employee'])) {
    header('Location: ../index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Application</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">

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

                <?php if (isset($_SESSION['leave-application-details-required'])) : ?>
                    <h5 id="alert" class="alert alert-warning"><?php echo $_SESSION['leave-application-details-required']; ?></h5>
                <?php
                    unset($_SESSION['leave-application-details-required']);
                endif; ?>
                <?php if (isset($_SESSION['apply-leave-failed'])) : ?>
                    <h5 id="alert" class="alert alert-danger"><?php echo $_SESSION['apply-leave-failed']; ?></h5>
                <?php
                    unset($_SESSION['apply-leave-failed']);
                endif; ?>

                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Apply for a Leave</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php" class="text-success">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Leave Application</li>
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
                                        <form class="form" action="../includes/actions.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                                            <div class="row">
                                                <?php $ref_num = rand(000000, 999999); ?>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Reference Number</label>
                                                        <div class="position-relative">
                                                            <input type="text" name="reference_number" class="form-control" value="<?php echo $ref_num ?>" readonly required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-hashtag"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $query = "SELECT * FROM leave_types ORDER BY leave_type ASC";
                                                try {
                                                    $statement = $conn->prepare($query);
                                                    $statement->execute();

                                                    $statement->setFetchMode(PDO::FETCH_OBJ);
                                                    $result = $statement->fetchAll();
                                                } catch (PDOException $e) {

                                                    echo ($e->getMessage());
                                                } ?>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Leave Type</label>
                                                        <div class="position-relative">
                                                            <fieldset class="form-group">
                                                                <select class="form-select" name="leave_type" id="basicSelect" required>
                                                                    <option disabled selected value="0">-- Select Leave Type --</option>
                                                                    <?php foreach ($result as $row) { ?>
                                                                        <option value="<?php echo $row->id; ?>"><?php echo $row->leave_type . " (" . $row->days_allowed . " days)"; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">Starting Date</label>
                                                        <div class="position-relative">
                                                            <input type="date" name="starting_date" class="form-control" placeholder="first name" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group has-icon-left">
                                                        <label for="first-name-icon">End Date</label>
                                                        <div class="position-relative">
                                                            <input type="date" name="end_date" class="form-control" placeholder="first name" required id="first-name-icon">
                                                            <div class="form-control-icon">
                                                                <i class="fa fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <a href="leave_status.php" class="btn btn-danger me-1 mb-1">Back</a>
                                                    <button type="submit" name="apply_leave" class="btn btn-primary me-1 mb-1 float-end">Save</button>
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