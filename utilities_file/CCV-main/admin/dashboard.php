<?php
session_start();
include "../shared/session.admin.php";
?>

<?php $title = "Admin Dashboard" ?>

<?php ob_start() ?>
<!-- <link rel="stylesheet" href="../assets/css/login.css"> -->
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>
<!-- content -->
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<!-- scripts -->
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>