<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$db = new DbHelper();
$title = "profilepic";
if (isset($_SESSION['accountId'])) {
    $youth_leader = $db->fetchRecords('youth_leader', ['accountId' => $_SESSION['accountId']]);
} else {
    header("Location: login.php");
    exit();
}

// Check if 'fname' and 'lname' keys exist in $_SESSION before accessing them
$fname = isset($youth_leader[0]['fname']) ? $youth_leader[0]['fname'] : '';
$lname = isset($youth_leader[0]['lname']) ? $youth_leader[0]['lname'] : '';
?>


<?php ob_start() ?>

<?php $styles = ob_get_clean() ?>
<nav class="navbar fixed-top">
    <div class="container-fluid m-1">
        <a class="navbar-brand m-1" href="#">
            <img src="../assets/img/logo/yt_final1.png" alt="Elevate Her Logo" width="160">
        </a>

        <div class="d-none d-md-flex">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="dashboard.php">Events </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="upload_events.php">Upload Events</a>

                </li>

                <li class="nav-item dropdown position-relative">
                    <div class="dropdown">
                        <a href="#" class="nav-link" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="toggleSideMenu()">
                            <img src="<?php echo $dh->youth_leader . $youth_leader[0]["profileImage"]; ?>" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                        </a>
                        <!-- Drop Down Menu -->
                        <div class="dropdown-menu position-absolute dropdown-menu-right" style="right: 0; top: 100%;" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <?php echo $fname . " " . $lname ?>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../lawyer/update.profile.lawyer.php">Update Profile</a>
                            <a class="dropdown-item" href="../logic/logout.php">Logout</a>
                        </div>
                        <!-- Drop Down Menu -->
                    </div>
                </li>
            </ul>
        </div>

        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Offcanvas menu for smaller screens -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                    <a class="navbar-brand" href="#">
                        <img src="../assets/img/logo/ElevateHer_Logo_Bold.png" alt="Elevate Her Logo" width="160">
                    </a>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link fuchsia" href="index.php">Home</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link fuchsia" style="margin-right: 15px" href="dashboard.php">Events </a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link fuchsia" style="margin-right: 15px" href="upload_events.php">Upload Events</a>

                    </li>


                    <li class="nav-item">
                        <div class="profile-icon" onclick="toggleSideMenu()">
                            <?php if (!empty($youth_leader) && !empty($youth_leader[0]["profileImage"])) : ?>
                                <img src="<?php echo $dh->youth_leader . $youth_leader[0]["profileImage"]; ?>" alt="Profile Image" width="40" height="40" style="border-radius: 50%;"> <?php else : ?>
                                <img onerror="this.src='../assets/img/misc/profileicon.jpg'" src="<?php echo $dh->youth_leader; ?>profileicon.jpg" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                            <?php endif; ?>
                        </div>
                        <div class="side-menu offcanvas" tabindex="-1" id="offcanvasProfile" aria-labelledby="offcanvasProfileLabel">
                            <ul>
                                <li><a><?php echo $fname . " " . $lname; ?></a></li>
                                <li><a href="../logic/logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script src="../assets/js/taglesidebar.js"></script>