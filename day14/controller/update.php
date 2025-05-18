<?php

session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();

if (isset($_POST['submit'])) {
    UpdateInfo($db);
} 

function UpdateInfo($db) {
    $userId = $_POST['userId'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contactNo = $_POST['contactNo']; 
    $address = $_POST['address'];

    $table = "users"; 
    $data = array(

        "userId" => $userId,
        "fname" => $fname,
        "lname" => $lname,
        "contactNo" => $contactNo,
        "address" => $address,
    );

    $success = $db->updateRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Update successfully";
        header("Location: ../admin/");
        exit();
    } else {
        $_SESSION["m"] = "Error uploading!";
        header("Location: ../admin/update.php");
        exit();
    }
}

?>