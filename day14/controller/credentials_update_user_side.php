<?php
session_start();
require_once "../models/DbHelper.php";

$db = new DbHelper();

if (isset($_POST['submit'])) {
    updateCredentials($db);
}

function updateCredentials($db) {
    if (!isset($_POST['accountId'])) {
        $_SESSION["m"] = "Invalid request.";
        header("Location: ../users/updateProfile_users.php");
        exit();
    }

    $accountId = $_POST['accountId'];
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $data = [
        "accountId" => $accountId,
        "username" => $username,
        "email" => $email
    ];

    if (strlen($password) < 6) {
        $_SESSION["m"] = "Password must be at least 6 characters!";
        $_SESSION["icon"] = "error";
        header("Location: ../users/");
        exit();
    }
    // Only hash and include password if it's not empty
    if (!empty($password)) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $table = "account";
    $success = $db->updateRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Credentials updated successfully.";
    } else {
        $_SESSION["m"] = "Error updating credentials!";
    }

    header("Location: ../users/");
    exit();
}
