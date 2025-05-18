<?php
session_start();
include "../shared/session.youth_leader.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

require_once "../util/DbHelper.php";

$db = new DbHelper();
$title = "youth_leader";
$dh = new DirHandler();
ob_start();
include "../shared/navbar.youth_leader.php";
$navbar = ob_get_clean();
?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/homepagelawyer.css">

<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<br>
<br>
<br>
<br>


<br>
<br>
<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Additional scripts if needed -->
<script src="../assets/js/script.js"></script>

<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>