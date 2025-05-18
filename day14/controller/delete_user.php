<?php
session_start();
require_once "../models/DbHelper.php";

// Check if the user is logged in
if (!isset($_SESSION['accountId'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $accountId = intval($_GET['id']); // Sanitize input
    $db = new DbHelper();

    // Delete from 'users' where accountId = ?
    $deleted = $db->deleteRecord('account', ['accountId' => $accountId]);

    if ($deleted) { 
        $_SESSION['success'] = "User deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete user.";
    }

    header("Location: ../admin/index.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../admin/index.php");
    exit();
}
?>
