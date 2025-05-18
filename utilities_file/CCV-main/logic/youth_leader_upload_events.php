<?php

session_start();

require_once "../util/DbHelper.php";

$db = new DbHelper();

if (isset($_POST['submit'])) {
    uploadEvents($db);
}

function uploadEvents($db)
{
    $youth_leaderId = $_POST['youth_leaderId'];
    $TypeofEvents = $_POST['TypeofEvents'];
    $Description = $_POST['Description'];
    $date = $_POST['date'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];
    $location = $_POST['location'];

    $table = "leader_upload_events";
    $data = array(
        "youth_leaderId" => $youth_leaderId,
        "TypeofEvents" => $TypeofEvents,
        "Description" => $Description,
        "date" => $date,
        "time_start" => $time_start,
        "time_end" => $time_end,
        "location" => $location,
    );

    $success = $db->addRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Upload successfully";
    } else {
        $_SESSION["m"] = "Error uploading!";
    }

    header("Location: ../youth_leader/upload_events.php");
    exit();
}
