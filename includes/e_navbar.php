<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">

        <li class="dropdown">
            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="avatar me-1">
                    <img src="../images/<?php echo $_SESSION['avatar']; ?>">
                </div>
                <div class="d-none d-md-block d-lg-inline-block">Hi, <?php echo $_SESSION['first_name']; ?></div>
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