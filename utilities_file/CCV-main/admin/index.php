<?php
session_start(); 
include "../shared/session.admin.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$db = new DbHelper();
$title = "admin";



if (isset($_SESSION['accountId'])) {
    $admin = $db->fetchRecords('admin', ['accountId' => $_SESSION['accountId']]);
} else {
    
    header("Location: login.php");
    exit();
}

ob_start();
include "../shared/navbar.admin.php";
$navbar = ob_get_clean();

ob_start();
?>
<link rel="stylesheet" href="../assets/css/landing.page.css">
<link rel="stylesheet" href="../assets/css/therapy.css">
<link rel="stylesheet" href="../assets/css/home.css"> <!-- Add your home page styles here -->
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Home Section -->
<section id="home" class="fer-sec d-flex align-items-center justify-content-center">
    <section class="text-center fuchsia fw-bold">
        <div class="container">
            <?php if (!empty($admin) && isset($admin[0])) : ?>
                <h2>Welcome, <?php echo htmlspecialchars($admin[0]["fname"]) . " " . htmlspecialchars($admin[0]["lname"]); ?></h2>

                <?php
                // Display profile picture if it exists
                if (!empty($admin[0]["profileImage"])) :
                    $profileImage = $dh->admin_profile . $admin[0]["profileImage"]; // Adjust the path accordingly
                ?>
                    <img onerror="this.src='../assets/img/misc/profileicon.jpg'" src="<?= $profileImage ?>" alt="Profile Image" class="profile-image rounded-circle" style="width: 150px; height: 150px;">
                <?php else : ?>
                    <img src="../assets/img/misc/profileicon.jpg" alt="Default Profile Image" class="profile-image rounded-circle" style="width: 150px; height: 150px;">
                <?php endif; ?>

                <!-- Add more details as needed -->
            <?php else : ?>
                <p>No user found.</p>
            <?php endif; ?>
        </div>
    </section>
</section>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="../assets/js/navbar.js"></script>
<script src="../assets/js/scroll.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
