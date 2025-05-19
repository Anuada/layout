<?php

session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();

if (isset($_POST['submit'])) {
    addTask($db);
} 

function addTask($db) {
    $userId = $_POST['userId'];
    $status = $_POST['status'];
    
    $table = "todo_list"; 
    $data = array(
    
        "userId" => $userId,
        "status" => $status,
        
       
    );

    $success = $db->updateRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Submitted successfully";
        header("Location: ../users/");
        exit();
    } else {
        $_SESSION["m"] = "Error uploading !";
        header("Location: ../users/");
        exit();
    }
}
