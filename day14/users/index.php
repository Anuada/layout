<?php
session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();
$title = "Users Dashboard";

if (!isset($_SESSION['accountId'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['accountId'];
$fetchData = $db->fetchData_users($id);
$user = !empty($fetchData) ? $fetchData[0] : null;

ob_start();
include "../viewer/topnav_users.php";
$navbar = ob_get_clean();

ob_start(); ?>
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/users_profile.css">

</style>
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container">
    <?php if ($user): ?>
        <div class="profile-box">
    <h2>User Profile</h2>

    <div class="info-row">
        <div class="profile-label">Full Name:</div>
        <div class="profile-value"><?= htmlspecialchars($user->fname . ' ' . $user->lname) ?></div>
    </div>

    <div class="info-row">
        <div class="profile-label">Contact No:</div>
        <div class="profile-value"><?= htmlspecialchars($user->contactNo) ?></div>
    </div>

    <div class="info-row">
        <div class="profile-label">Address:</div>
        <div class="profile-value"><?= htmlspecialchars($user->address) ?></div>
    </div>

    <div class="info-row">
        <div class="profile-label">Email:</div>
        <div class="profile-value"><?= htmlspecialchars($user->email) ?></div>
    </div>
</div>

    <?php else: ?>
        <div class="alert alert-danger">User profile not found.</div>
    <?php endif; ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require_once "../viewer/layout.php"; ?>
