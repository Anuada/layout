<?php
session_start();

require_once "../util/DbHelper.php";
$db = new DbHelper();

if (isset($_POST['submit'])) {
    join_event($db);
} elseif (isset($_POST['acceptBooking'])) {
    $bookingId = $_POST['bookingId'];
    handleAcceptJoining($db, $bookingId);
} elseif (isset($_POST['cancelledJoining'])) {
    $bookingId = $_POST['bookingId'];
    handleCancelledJoining($db, $bookingId);
}


function join_event($db)
{
    $userId = $_POST['userId'];
    $youth_leaderId = $_POST['youth_leaderId'];
    $reason = $_POST['reason'];
    $typeof_event = $_POST['typeof_event'];



    $table = "youth_joining_event";
    $data = array(
        "userId" => $userId,
        "youth_leaderId" => $youth_leaderId,
        "reason" => $reason,
        "typeof_event" => $typeof_event,
        "bookingStatus" => "Pending"

    );

    $success = $db->addRecord($table, $data);

    if ($success) {
        $_SESSION["m"] = "Join successfully";
        header("Location: ../user/join_Events.php");
        exit();
    } else {
        $_SESSION["m"] = "Error uploading!";
        header("Location: ../user/fileComplaint.php");
        exit();
    }
}
function handleAcceptJoining(DbHelper $db, string $bookingId)
{


    $result = $db->updateRecord("youth_joining_event", ['id' => $bookingId, 'bookingStatus' => 'Accept']);

    if ($result > 0) {
        $_SESSION["m"] = "Joining accepted";
        header("Location: ../youth_leader/dashboard.php");
        exit();
    } else {
        $_SESSION["m"] = "Error updating booking. Please try again!";
        header("Location: ../youth_leader/dashboard.php");
        exit();
    }
}

function handleCancelledJoining(DbHelper $db, string $bookingId)
{


    $result = $db->updateRecord("youth_joining_event", ['id' => $bookingId, 'bookingStatus' => 'Cancelled']);

    if ($result > 0) {
        $_SESSION["m"] = "Joining accepted";
        header("Location: ../youth_leader/dashboard.php");
        exit();
    } else {
        $_SESSION["m"] = "Error updating booking. Please try again!";
        header("Location: ../youth_leader/dashboard.php");
        exit();
    }
}
