<?php
session_start();

require_once "../util/DbHelper.php";
$db = new DbHelper();

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (!empty(trim($username)) && !empty(trim($password))) {
        $account = $db->fetchRecords("account", ["username" => $username]);
        if ($account != null) {
            if (password_verify($password, $account[0]["password"])) {
                $db->updateRecord("account", ["accountId" => $account[0]["accountId"], "isLogin" => "1"]);

                $_SESSION["accountId"] = $account[0]["accountId"];
                $_SESSION["email"] = $account[0]["email"];
                $_SESSION["username"] = $account[0]["username"];
                $_SESSION["user_type"] = $account[0]["user_type"];

                switch ($account[0]["user_type"]) {
                    case 'users':
                        $users = $db->fetchRecords("users", ["accountId" => $account[0]["accountId"]]);
                        $_SESSION["m"] = "Welcome " . $users[0]["fname"] . " " . $users[0]["lname"];
                        header("Location: ../user/");
                        break;

                    case 'admin':
                        $admin = $db->fetchRecords("admin", ["accountId" => $account[0]["accountId"]]);
                        $_SESSION["m"] = "Welcome " . $admin[0]["fname"] . " " . $admin[0]["lname"];
                        header("Location: ../admin/");
                        break;



                    case 'youth_leader':
                        $extra_account = $db->fetchRecords("youth_leader", ["accountId" => $account[0]["accountId"]]);
                        $_SESSION["m"] = "Welcome " . $extra_account[0]["fname"] . " " . $extra_account[0]["lname"];
                        header("Location: ../youth_leader/");
                        break;



                    default:
                        break;
                }
            } else {
                $_SESSION["m"] = "Invalid password!";
                header("Location: ../page/login.php");
                exit();
            }
        } else {
            $_SESSION["m"] = "Invalid username!";
            header("Location: ../page/login.php");
            exit();
        }
    } else {
        $_SESSION["m"] = "Fill out the missing fields!";
        header("Location: ../page/login.php");
        exit();
    }
} else {
    header("Location: ../page/login.php");
    exit();
}
