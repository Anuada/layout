<?php
session_start();
include "../shared/session.woman.php";
require_once "../util/DbHelper.php";
$db = new DbHelper();
$title = "Women";
ob_start();
include "../shared/navbar.woman.php";
$navbar = ob_get_clean();
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/landing.page.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>

<!-- Home Section -->
<section id="home" class="fer-sec">
    <section class="d-flex justify-content-center align-items-center text-center fs-1 fuchsia fw-bold"
        style="padding-top: 35vh">

    </section>


</section>






<!-- Footer -->
<section id="footer" class="foot-sec">
    <div class="text-center fuchsia pt-3">
        <p>All Rights Reserved</p>
        <p class="fw-bold">ElevateHer &copy;
            <?php echo $db->getCurrentYear() ?>
        </p>
    </div>
</section>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/layout.php" ?>