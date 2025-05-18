<?php

session_start();


require_once "../util/DbHelper.php";

$db = new DbHelper();


if (isset($_POST['submit'])) {
    handleBookingSubmission($db);
} elseif (isset($_POST['acceptBooking'])) {
    handleAcceptBooking($db);
} elseif (isset($_POST['cancelBooking'])) {
    handleCancelBooking($db);
} elseif (isset($_POST['editBooking'])) {
    handleEditBooking($db);
} 


function handleBookingSubmission(DbHelper $db) {
    
    $womanId = $_POST["womanId"];
    $counselor = $_POST["counselorId"];
    $StartCtime = $_POST['StartCtime'];
    $EndCtime = $_POST['EndCtime'];
    $Cdate = $_POST['Cdate'];
    $specialize = $_POST['specialize'];

    
    if (isset($_SESSION['accountId'])) {
        $accountId = $_SESSION['accountId'];

        
        $result = $db->addRecord("bookingcounselor", [
            'womanId' => $womanId,
            'counselorId' => $counselorId,
            'StartCtime' => $StartCtime,
            'EndCtime' => $EndCtime,
            'Cdate' => $Cdate,
            'specialize' => $specialize,
            'bookingStatus' => "Pending"
        ]);

        
        if ($result) {
            $_SESSION["m"] ="Booking successful";
            header("Location: ../user/legalcounsel.choosecounselor.php.php");
            exit();
        } else {
            $_SESSION["m"] ="Error booking counselor. Please try again!";
            header("Location: ../user/woman.bookedcounselor.php");
            exit();
        }
    } else {
        $_SESSION["m"] ="User not authenticated. Please log in!";
        header("Location: ../user/woman.bookedcounselor.php");
        exit();
    }
}




function handleCancelBooking(DbHelper $db) {
    $bookingId = $_POST['bookingId'];

    
    $result = $db->updateRecord("bookingcounselor", ['id' => $bookingId, 'bookingStatus' => 'Canceled']);

    
    if ($result) {
        $_SESSION["m"] ="Booking canceled";
        header("Location: ../user/woman.bookedcounselor.php");
        exit();
    } else {
        $_SESSION["m"] ="Error updating booking. Please try again!";
        header("Location: ../user/woman.bookedcounselor.php");
        exit();
    }
	
}



function handleEditBooking(DbHelper $db) {
    $bookingId = isset($_POST['bookingId']) ? $_POST['bookingId'] : null;

    
    $newStartTime = isset($_POST['newStartTime']) ? $_POST['newStartTime'] : null;
    $newEndTime = isset($_POST['newEndTime']) ? $_POST['newEndTime'] : null;
    $newDate = isset($_POST['newDate']) ? $_POST['newDate'] : null;
    $newSpecialization = isset($_POST['newSpecialization']) ? $_POST['newSpecialization'] : null;

   
    $result = $db->updateRecord("bookingcounselor", [
        'id' => $bookingId,
        'StartCtime' => $newStartTime,
        'EndCtime' => $newEndTime,
        'Cdate' => $newDate,
        'specialize' => $newSpecialization,
    ]);

    
    if ($result) {
        $_SESSION["m"] ="Booking updated";
        header("Location: ../user/woman.bookedcounselor.php");
        exit();
    } else {
        $_SESSION["m"] ="Error updating booking. Please try again!";
        header("Location: ../user/woman.bookedcounselor.php");
        exit();
    }
}
?>
