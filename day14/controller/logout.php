<?php
session_start();

require_once "../models/DbHelper.php";

$db = new DbHelper();

$db->updateRecord("account", ["accountId" => $_SESSION["accountId"], "isLogin" => "0"]);

session_unset();
session_destroy();
header("Location: ../page/");