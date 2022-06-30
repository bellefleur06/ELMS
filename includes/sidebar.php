<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <a href="dashboard.php" style="color:#727e8c">
            <div class="sidebar-header" style="height: 50px;margin-top: -30px">
                <i class="fa fa-users text-success me-4"></i>
                <span>ELMS</span>
            </div>
        </a>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-item <?php if ($page == 'dashboard') {
                                            echo 'active';
                                        } ?>'>
                    <a href="dashboard.php" class='sidebar-link'>
                        <i class="fa fa-home text-success"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class='sidebar-item has-sub <?php if ($page == 'department') {
                                                    echo 'active';
                                                } ?>'>
                    <a href="#" class='sidebar-link'>
                        <i class="fa fa-building text-success"></i>
                        <span>Department</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="add_department.php">Add Department</a>
                        </li>
                        <li>
                            <a href="manage_department.php">Manage Department</a>
                        </li>
                    </ul>
                </li>
                <li class='sidebar-item has-sub <?php if ($page == 'designation') {
                                                    echo 'active';
                                                } ?>'>
                    <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Designation</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="add_designation.php">Add Designation</a>
                        </li>
                        <li>
                            <a href="manage_designation.php">Manage Designation</a>
                        </li>
                    </ul>
                </li>
                <li class='sidebar-item has-sub <?php if ($page == 'employee') {
                                                    echo 'active';
                                                } ?>'>
                    <a href="#" class='sidebar-link'>
                        <i class="fa fa-users text-success"></i>
                        <span>Employees</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="add_employee.php">Add Employee</a>
                        </li>
                        <li>
                            <a href="manage_employee.php">Manage Employee</a>
                        </li>
                    </ul>
                </li>
                <li class='sidebar-item has-sub <?php if ($page == 'leave_type') {
                                                    echo 'active';
                                                } ?>'>
                    <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Leave Type</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="add_leave_type.php">Add Leave Type</a>
                        </li>
                        <li>
                            <a href="manage_leave_type.php">Manage Leave Type</a>
                        </li>
                    </ul>
                </li>
                <li class='sidebar-item has-sub <?php if ($page == 'leaves') {
                                                    echo 'active';
                                                } ?>'>
                    <a href="#" class='sidebar-link'>
                        <i class="fa fa-table text-success"></i>
                        <span>Leave Management</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="all_leave.php">All Leaves</a>
                        </li>
                        <li>
                            <a href="pending_leave.php">Pending Leaves</a>
                        </li>
                        <li>
                            <a href="approve_leave.php">Approve Leaves</a>
                        </li>
                        <li>
                            <a href="not_approve_leave.php">Declined Leaves</a>
                        </li>
                    </ul>
                </li>
                <?php if ($_SESSION['user_category'] == "Admin") : ?>
                    <li class='sidebar-item has-sub <?php if ($page == 'user') {
                                                        echo 'active';
                                                    } ?>'>
                        <a href="#" class='sidebar-link'>
                            <i class="fa fa-user text-success"></i>
                            <span>Users</span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="add_user.php">Add User</a>
                            </li>
                            <li>
                                <a href="manage_user.php">Manage Users</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- <li class='sidebar-item <?php if ($page == 'report') {
                                                    echo 'active';
                                                } ?>'>
                    <a href="reports.php" class='sidebar-link'>
                        <i class="fa fa-chart-bar text-success"></i>
                        <span>Reports</span>
                    </a>
                </li> -->
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>