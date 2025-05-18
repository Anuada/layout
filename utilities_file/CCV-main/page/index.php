<?php
session_start();
require_once "../util/DbHelper.php";
$db = new DbHelper();
$title = "Empower, Educate, Elevate";
$load = false;
ob_start();
include "../shared/navbar.page.php";
$navbar = ob_get_clean();
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/landing.page.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>

<!-- Home Section -->
<section id="home" class="fer-sec">
    <section class="d-flex justify-content-center align-items-center text-center fs-1 fuchsia fw-bold" style="padding-top: 35vh">
        <div class="ib">
            <div class="text">LUKE 4:18-19</div>
        </div>
    </section>
    <p class="d-flex justify-content-center align-items-center text-center fs-4 fuchsia pt-4 ls-3">
        The Spirit of the Lord is on me,
        because he has anointed me
        to proclaim good news to the<br>poor.
        He has sent me to proclaim freedom for the prisoners
        and recovery of sight for the blind,
        to set the oppressed free,
        to proclaim the year of the Lord’s favor
    </p>
    <p class="text-center pt-2">
        <button class="btn bg-fuchsia p-3 fs-5 shadow w-btn" onclick="location.href='./signup.php'">Join
            Now &nbsp; <i class="fas fa-arrow-right move-right"></i></button>
    </p>
</section>

<!-- About Us -->
<section id="aboutus" class="con-sec">
    <div class="container" style="padding-top: 70px">
        <h1 class="fuchsia text-center fw-bold ls-2 u-l">About Us</h1>
    </div>
</section>

<!-- Footer -->
<section id="footer" class="foot-sec">
    <div class="text-center fuchsia pt-3">
        <p>All Rights Reserved</p>
        <p class="fw-bold">CCV Company &copy;
            <?php echo $db->getCurrentYear() ?>
        </p>
    </div>
</section>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/layout.php" ?>