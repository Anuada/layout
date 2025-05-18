<?php

session_start();


require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$db = new DbHelper();
$dh = new DirHandler();



if (isset($_POST['submit'])) {
    UpdatelguProfile($db, $dh);
}

function UpdatelguProfile($db, $dh)
{

    $accountId = $_SESSION['accountId'];
    $TypeofEvents = $_POST['TypeofEvents'];
    $Description = $_POST['Description'];



    $table = "lgu";
    $data = array(
        "accountId" => $accountId,
        "TypeofEvents" => $TypeofEvents,
        "Description" => $Description,


    );

    $success = $db->addRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Add successfully";
        header("Location: ../youth_leader/uploadEvents.php");
        exit();
    } else {

        $_SESSION["m"] = "Error uploading!";
        header("Location: ../youth_leader/updatelguProfile.php");
        exit();
    }
}
