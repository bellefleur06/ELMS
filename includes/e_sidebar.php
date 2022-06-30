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
                <li class="sidebar-item <?php if ($page == 'apply-leave') {
                                            echo 'active';
                                        } ?>">
                    <a href="apply_leave.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Apply Leave</span>
                    </a>
                </li>
                <li class="sidebar-item <?php if ($page == 'leave-status') {
                                            echo 'active';
                                        } ?>">
                    <a href="leave_status.php" class='sidebar-link'>
                        <i class="fa fa-plane text-success"></i>
                        <span>Leave Status</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>