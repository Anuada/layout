<?php

require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$db = new DbHelper();

if (isset($_SESSION['accountId'])) {
    $users = $db->fetchRecords('users', ['accountId' => $_SESSION['accountId']]);
} else {
    header("Location: ../page/login.php");
    exit();
}


$fname = isset($users[0]['fname']) ? $users[0]['fname'] : '';
$lname = isset($users[0]['lname']) ? $users[0]['lname'] : '';

?>

<?php ob_start() ?>
<?php $styles = ob_get_clean() ?>
<nav class="navbar fixed-top">
    <div class="container-fluid m-1">
        <a class="navbar-brand ml-10" href="#">
            <img src="../assets/img/logo/yt_final1.png" alt="Youth Logo" width="160">
        </a>

        <div class="d-none d-md-flex">
            <ul class="navbar-nav flex-row">
                <ul class="main-nav">
                    <li class="has-submenu">
                        <a href="#">Option <i class="fas fa-chevron-down"></i></a>
                        <ul class="submenu">
                            <li><a href="view_joined_events.php">Events</a></li>



                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fuchsia" style="margin-right: 15px" href="./index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fuchsia" style="margin-right: 15px" href="./community.php">Community Forum</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fuchsia" style="margin-right: 15px" href="./events.php">Events
                        </a>
                    </li>



                    <li class="nav-item dropdown position-relative">
                        <div class="dropdown">
                            <a href="#" class="nav-link" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="toggleSideMenu()">
                                <?php if (!empty($users) && !empty($users[0]["profileImage"])) : ?>
                                    <img src="<?php echo $dh->users_profile . $users[0]["profileImage"]; ?>" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                                <?php else : ?>
                                    <img onerror="this.src='../assets/img/misc/profileicon.jpg'" src="<?php echo $dh->users_profile; ?>profileicon.jpg" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                                <?php endif; ?>
                            </a>
                            <!-- Drop Down Menu -->
                            <div class="dropdown-menu position-absolute dropdown-menu-right" style="right: 0; top: 100%;" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="#">
                                    <?php echo $fname . " " . $lname ?>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../user/woman.update.profile.php">Update Profile</a>
                                <a class="dropdown-item" href="../logic/logout.php">Logout</a>
                            </div>

                        </div>
                    </li>
                </ul>
        </div>

        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


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
                        <a class="nav-link fuchsia" style="margin-right: 15px" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fuchsia" style="margin-right: 15px" href="./Community_Forum.php">Community Forum</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fuchsia" style="margin-right: 15px" href="./CommunityForum.php">Events
                        </a>
                    </li>

                    <li class="nav-item">
                        <div class="profile-icon" onclick="toggleSideMenu()">
                            <?php if (!empty($users) && !empty($users[0]["profileImage"])) : ?>
                                <img src="<?php echo $dh->users_profile . $users[0]["profileImage"]; ?>" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                            <?php else : ?>
                                <img onerror="this.src='../assets/img/misc/profileicon.jpg'" src="<?php echo $dh->users_profile; ?>profileicon.jpg" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                            <?php endif; ?>
                        </div>
                        <div class="side-menu offcanvas" tabindex="-1" id="offcanvasProfile" aria-labelledby="offcanvasProfileLabel">
                            <ul>
                                <li><a>
                                        <?php echo $fname . " " . $lname; ?>
                                    </a></li>
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