<?php

session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();

if (isset($_POST['submit'])) {
    addTask($db);
} 

function addTask($db) {
    $userId = $_POST['userId'];
    $task = $_POST['task'];
    $description = $_POST['description'];
    $date = $_POST['date'];

 
    

    $table = "todo_list"; 
    $data = array(
    
        "userId" => $userId,
        "task" => $task,
        "description" => $description,
        "date" => $date,
    
       
       
    );

    $success = $db->addrecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Submitted successfully";
        header("Location: ../admin/");
        exit();
    } else {
        $_SESSION["m"] = "Error uploading !";
        header("Location: ../admin/");
        exit();
    }
}

?>