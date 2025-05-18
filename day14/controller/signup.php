<?php
session_start();
require_once "../models/DbHelper.php";

$db = new DbHelper();

if (isset($_POST["signup"])) {
    $fname = trim($_POST["fname"]);
    $lname = trim($_POST["lname"]);
    $contact = trim($_POST["contact"]);
    $address = trim($_POST["address"]);
    $email = trim($_POST["email"]);
    $user_type = strtolower(trim($_POST["user_type"])); 
    $username = trim($_POST["username"]);
    $password = $_POST["password"];
    $con_password = $_POST["con_password"];

 
    if (!empty($fname) && !empty($lname) && !empty($contact) && !empty($address) &&
        !empty($email) && !empty($user_type) && !empty($username) &&
        !empty($password) && !empty($con_password)) {

        if (in_array($user_type, ['admin', 'users'])) {

            $check_email = $db->getRecord("account", ["email" => $email]);
            if (!$check_email) {

                $check_username = $db->getRecord("account", ["username" => $username]);
                if (!$check_username) {
                    
                    if (strlen($password) < 6) {
                        $_SESSION["m"] = "Password must be at least 6 characters!";
                        $_SESSION["icon"] = "error";
                        header("Location: ../page/register.php");
                        exit();
                    }

                    if ($password === $con_password) {

                        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                        $db->addRecord("account", [
                            "email" => $email,
                            "username" => $username,
                            "password" => $hashed_password,
                            "user_type" => $user_type,
                            "isLogin" => "0"
                        ]);

                        $newAccount = $db->fetchSingle("account", ["username" => $username]);
                        $accountId = $newAccount["accountId"];

                        $info = [
                            "accountId" => $accountId,
                            "fname" => $fname,
                            "lname" => $lname,
                            "address" => $address,
                            "contactNo" => $contact
                        ];

                        if ($user_type === 'users') {
                            $db->addRecord("users", $info);
                        } elseif ($user_type === 'admin') {
                            $db->addRecord("admin", $info);
                        }

                        $_SESSION["m"] = "Successful Register";
                        $_SESSION["icon"] = "success";
                        header("Location: ../page/");
                        exit();

                    } else {
                        $_SESSION["m"] = "Passwords do not match !";
                        $_SESSION["icon"] = "error";
                        header("Location: ../page/register.php");
                        exit();
                    }

                } else {
                    $_SESSION["m"] = "Username already exists !";
                    $_SESSION["icon"] = "error";
                    header("Location: ../page/register.php");
                    exit();
                }

            } else {
                $_SESSION["m"] = "Email already exists !";
                $_SESSION["icon"] = "error";
                header("Location: ../page/register.php");
                exit();
            }

        } else {
            $_SESSION["m"] = "Invalid user type !";
            $_SESSION["icon"] = "error";
            header("Location: ../page/register.php");
            exit();
        }

    } else {
        $_SESSION["m"] = "Fill out the missing fields !";
        $_SESSION["icon"] = "error";
        header("Location: ../page/register.php");
        exit();
    }

} else {
    $_SESSION["m"] = "Unauthorized access !";
    $_SESSION["icon"] = "error";
    header("Location: ../page/register.php");
    exit();
}
