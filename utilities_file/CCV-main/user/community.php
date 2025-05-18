<?php
session_start();
include "../shared/session.woman.php";
require_once "../util/DbHelper.php";
$db = new DbHelper();
$title = "Women";
ob_start();
include "../shared/navbar.users.php";
$navbar = ob_get_clean();
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/landing.page.css">
<link rel="stylesheet" href="../assets/css/therapy.css">

<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>

<br>
<br>
<br>
<br>

<section id="home" class="fer-sec d-flex align-items-center justify-content-center">
    <section class="text-center fuchsia fw-bold">
        <br>
        <br>

        <div class="d-flex align-items-center image-container">
            <img src="../assets/img/misc/therapy.png" alt="Left Image" class="image" style="max-width: 50%; max-height: 30%; margin-right: 20px;">

            <div class="text-background" style="background-color: rgba(255, 0, 255, 0.5); padding: 20px; border-radius: 10px;">
                <p class="secondary-text text-justify">
                    You can share thought and give ideas for others
                </p>
                </p>
            </div>
        </div>

        <div>
            <a href="next.one.page.php" class="btn btn-success mt-3">Next</a>
        </div>
        <br>
    </section>
</section>
<br>
<br>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/layout.php" ?>