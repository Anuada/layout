<?php
session_start();
require_once "../models/DbHelper.php";

$db = new DbHelper();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (!empty($username) && !empty($password)) {
        $account = $db->fetchSingle("account", ["username" => $username]);

        if ($account && password_verify($password, $account["password"])) {
            // Update isLogin status
            $db->updateRecord("account", [
                "accountId" => $account["accountId"],
                "isLogin" => "1"
            ]);

            // Store session data
            $_SESSION["accountId"] = $account["accountId"];
            $_SESSION["username"] = $account["username"];
            $_SESSION["user_type"] = $account["user_type"];

            // Redirect based on user_type
            switch ($account["user_type"]) {
                
                case 'admin':
                    $admin = $db->fetchSingle("admin", ["accountId" => $account["accountId"]]);
                    $_SESSION["m"] = "Welcome " . $admin["fname"] . " " . $admin["lname"];
                    header("Location: ../admin/");
                    break;

                case "users":
                    $users = $db->fetchSingle("users", ["accountId" => $account["accountId"]]);
                    $_SESSION["m"] = "Welcome! " . $users["fname"] . " " . $users["lname"];
                    header("Location: ../users/");
                    exit();
                default:
                    $_SESSION["m"] = "Unknown user type.";
                    header("Location: ../page/");
                    exit();

                    
            }

        } else {
            $_SESSION["m"] = "Invalid username or password !";
            header("Location: ../page/");
            exit();
        }
    } else {
        $_SESSION["m"] = "Fill out the missing fields !";
        header("Location: ../page/");
        exit();
    }
} else {
    $_SESSION["m"] = "Unauthorized access !";
    header("Location: ../page/");
    exit();
}
