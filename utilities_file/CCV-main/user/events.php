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

<style>
    .video-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
    }

    .fer-sec {
        position: relative;
        min-height: 100vh;
    }

    .content-overlay {
        position: relative;
        z-index: 1;
    }

    @media (max-width: 768px) {
        .fer-sec {
            padding: 10px;
        }

        .content-overlay {
            padding: 10px;
        }

        .btn {
            padding: 8px 16px;
            font-size: 1rem;
        }
    }
</style>

<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>

<br>
<br>
<br>
<br>

<section id="home" class="fer-sec d-flex align-items-center justify-content-center">
    <video autoplay muted loop class="video-background">
        <source src="../assets/video/youth_video.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <section class="text-center fuchsia fw-bold content-overlay">

    </section>
    <div style="margin-top:20%;" class="text-center mt-10">
        <a href="join_Events.php" class="btn btn-success btn-lg mt-10">Join Events Now</a>
    </div>
</section>
<br>


<br>

<br>
<br>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean() ?>
<?php require_once "../shared/layout.php" ?>