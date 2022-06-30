<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
        <li class="dropdown nav-icon">
            <a href="#" data-bs-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-lg-inline-block">
                    <?php $count = $conn->query("SELECT count(*) FROM leave_applications WHERE leave_status = '0' AND notification_status = '0'")->fetchColumn(); ?>
                    <?php if ($count > 0) : ?>
                        <i data-feather="bell"></i><span class="badge bg-info"><?php echo $count; ?></span>
                    <?php else : ?>
                        <i data-feather="bell"></i></span>
                    <?php endif; ?>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                <h6 class='py-2 px-4'>Notifications</h6>
                <ul class="list-group rounded-none">
                    <li class="list-group-item border-0 align-items-start">
                        <div class="row mb-2">
                            <?php

                            $query = "SELECT * FROM leave_types, employees, leave_applications WHERE leave_applications.leave_type_id = leave_types.id AND leave_applications.employee_id = employees.id AND leave_applications.leave_status = '0' ORDER BY leave_applications.id DESC";
                            $statement = $conn->prepare($query);
                            $statement->execute();

                            $statement->setFetchMode(PDO::FETCH_OBJ);
                            $result = $statement->fetchAll();

                            //if you were to use PDO::FETCH_ASSOC, the proper way to call your data in the database is $row['creation_date'];

                            if ($result) {

                                foreach ($result as $row) {
                            ?>
                                    <div class="col-md-12 notif">
                                        <?php if ($row->notification_status == '0') : ?>
                                            <a href="leave_details.php?view_id=<?php echo $row->id; ?>">
                                                <h6 style="font-weight:bold"><?php echo $row->first_name . " " . $row->last_name; ?></h6>
                                                <p class="text-xs" style="font-weight:bold">
                                                    Applied for a <?php echo $row->leave_type; ?> on <?php echo date("M d, Y - h:i:a", strtotime($row->date_applied)); ?>
                                                </p>
                                            </a>
                                        <?php else : ?>
                                            <a href="leave_details.php?view_id=<?php echo $row->id; ?>">
                                                <h6><?php echo $row->first_name . " " . $row->last_name; ?></h6>
                                                <p class="text-xs">
                                                    Applied for a <?php echo $row->leave_type; ?> at <?php echo date("M d, Y - h:i:a", strtotime($row->date_applied)); ?>
                                                </p>
                                            </a>
                                        <?php endif ?>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="col-md-12">
                                    <h6 style="font-weight:bold">No Records Yet.</h6>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </li>
                </ul>
            </div>
        </li>
        <li class="dropdown">
            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="avatar me-1">
                    <img src="../images/<?php echo $_SESSION['avatar']; ?>">
                </div>
                <div class="d-none d-md-block d-lg-inline-block">Hi, <?php echo $_SESSION['user_category']; ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="update.php?edit_id=<?php echo $_SESSION['id']; ?>"><i data-feather="user"></i> Account</a>
                <a class="dropdown-item" href="update_password.php?edit_id=<?php echo $_SESSION['id']; ?>"><i data-feather="settings"></i> Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../logout.php" onclick="return confirm('Are you sure you want to logout?');"><i data-feather="log-out"></i> Logout</a>
            </div>
        </li>
    </ul>
</div>