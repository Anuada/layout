<?php
session_start();
ob_start();
?>
<link rel="stylesheet" href="../assets/css/style_login_form.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>

<div class="container" role="main" aria-label="Applicant Training Guide System login form">
    <h1 class="title-top">Applicant Training Guide</h1>
    <h2 class="title-bottom">SYSTEM</h2>
    <form action="../controller/login_controller.php" method="POST">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" placeholder="Enter here .." autocomplete="username" />
        <label for="password" style="margin-top: 16px;">Password</label>
        <input id="password" name="password" type="password" placeholder="Enter here .." autocomplete="current-password" />
        <button type="submit" name="login" class="btn-login">Login</button>

        <p style="margin-top: 20px; text-align: center; font-size: 14px;">
            Don't have an account?
            <a href="../page/register.php" style="color: #007bff; text-decoration: none;">
                Sign up here
            </a>
        </p>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require_once "../viewer/layout.php"; ?>