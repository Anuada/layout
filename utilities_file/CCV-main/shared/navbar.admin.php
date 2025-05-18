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
    $admin = $db->fetchRecords('admin', ['accountId' => $_SESSION['accountId']]);
} else {
    header("Location: login.php");
    exit();
}

// Check if 'fname' and 'lname' keys exist in $_SESSION before accessing them
$fname = isset($admin[0]['fname']) ? $admin[0]['fname'] : '';
$lname = isset($admin[0]['lname']) ? $admin[0]['lname'] : '';

?>
<link rel="stylesheet" href="../assets/css/taglesidebar.css">
<?php ob_start() ?>
<?php $styles = ob_get_clean() ?>
<nav class="navbar fixed-top">
    <div class="container-fluid m-1">
        <a class="navbar-brand ml-10" href="#">
            <img src="../assets/img/logo/ElevateHer_Logo_Bold_Shadow.png" alt="Elevate Her Logo" width="160">
        </a>

        <div class="d-none d-md-flex">
            <ul class="navbar-nav flex-row">
                 <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./therapy.php">Therapy Counsel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./legalcounsel.php">Legal Counsel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./livelihood.php">Livelihood</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./CommunityForum.php">Community
                        Forum</a>
                </li>
                

                <li class="nav-item">
                    <div class="profile-icon" onclick="toggleSideMenu()">
                        <?php if (!empty($admin) && !empty($admin[0]["profileImage"])) : ?>
                            <img src="<?php echo $dh->admin_profile . $admin[0]["profileImage"]; ?>" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                        <?php else : ?>
                            <img onerror="this.src='../assets/img/misc/profileicon.jpg'" src="<?php echo $dh->admin_profile; ?>profileicon.jpg" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
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
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./therapy.php">Therapy Counsel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./legalcounsel.php">Legal Counsel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./livelihood.php">Livelihood</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fuchsia" style="margin-right: 15px" href="./CommunityForum.php">Community
                        Forum</a>
                </li>

                    <li class="nav-item">
                        <div class="profile-icon" onclick="toggleSideMenu()">
                            <?php if (!empty($admin) && !empty($admin[0]["profileImage"])) : ?>
                                <img src="<?php echo $dh->admin_profile . $admin[0]["profileImage"]; ?>" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                            <?php else : ?>
                                <img onerror="this.src='../assets/img/misc/profileicon.jpg'" src="<?php echo $dh->admin_profile; ?>profileicon.jpg" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
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

