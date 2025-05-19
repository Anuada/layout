<?php
session_start();
require_once "../models/DbHelper.php";

$db = new DbHelper();
$title = "Users Dashboard";

$id = $_SESSION['accountId'];
$fetchData = $db->fetchData_users($id);
$user = !empty($fetchData) ? $fetchData[0] : null;

// Navbar
ob_start();
include "../viewer/topnav_users.php";
$navbar = ob_get_clean();

// Styles
ob_start(); ?>
<link rel="stylesheet" href="../assets/css/users_profile.css">
<?php $styles = ob_get_clean(); ?>

<!-- Main Content -->
<?php ob_start(); ?>
<div class="container">
    <?php if ($user): ?>
        <div class="profile-box">
            <div class="profile-header">
                <h2>User Profile</h2>
                <div>
                    <a class="update-btn" href="updateProfile_users.php?id=<?= $user->userId ?>">Update</a>
                    <a class="update-btn" href="view_task.php?id=<?= $user->userId ?>">My Task</a>
                </div>
            </div>

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
