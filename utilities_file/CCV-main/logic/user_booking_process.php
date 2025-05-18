<?php
// Start the session
session_start();

// Include the database connection file
require_once "../util/DbHelper.php";

$db = new DbHelper();

// Check if the form is submitted
if (isset($_POST['submit'])) {
    handleBookingSubmission($db);
} elseif (isset($_POST['acceptBooking'])) {
    $bookingId = $_POST['bookingId'];
    handleAcceptBooking($db, $bookingId);
} elseif (isset($_POST['cancelBooking'])) {
    handleCancelBooking($db);
} elseif (isset($_POST['editBooking'])) {
    handleEditBooking($db);
} 

/**
 * Handles the form submission for booking a counselor.
 * @param DbHelper $db
 */
function handleBookingSubmission(DbHelper $db) {
    // Collect form data
    $womanId = $_POST["womanId"];
    $lawyerId = $_POST["lawyerId"];
    $availability = $_POST["availability"];
    $specialize = $_POST['specialize'];
    $Reason = $_POST['Reason'];

    // Check if the user is authenticated
    if (isset($_SESSION['accountId'])) {
        $accountId = $_SESSION['accountId'];

        // Insert the booking into the database
        $result = $db->addRecord("bookinglawyer", [
            'womanId' => $womanId,
            'lawyerId' => $lawyerId,
            'availability_id' => $availability,
            'specialize' => $specialize,
            'Reason' => $Reason,
            'bookingStatus' => "Pending"
        ]);

        // Check the result of the insertion
        if ($result) {
            $_SESSION["m"] ="Booking successful";
            header("Location: ../user/legalcounsel.chooselawyer.php");
            exit();
        } else {
            $_SESSION["m"] ="Error booking lawyer. Please try again!";
            header("Location: ../user/dashboard.php");
            exit();
        }
    } else {
        $_SESSION["m"] ="User not authenticated. Please log in!";
        header("Location: ../user/woman.dashboard.php");
        exit();
    }
}

/**
 * Handles the form submission for accepting a booking.
 * @param DbHelper $db
 * @param int $bookingId
 */
function handleAcceptBooking(DbHelper $db, string $bookingId) {
    // Assuming you have a hidden input field in your form containing the booking ID

    // Update the booking status to "Accept"
    $result = $db->updateRecord("bookinglawyer", ['id' => $bookingId, 'bookingStatus' => 'Accept']);

    // Check the result of the update
    if ($result > 0) {
        $_SESSION["m"] ="Booking accepted";
        header("Location: ../lawyer/index.php");
        exit();
    } else {
        $_SESSION["m"] ="Error updating booking. Please try again!";
        header("Location: ../lawyer/index.php");
        exit();
    }
}

/**
 * Handles the form submission for canceling a booking.
 * @param DbHelper $db
 */
function handleCancelBooking(DbHelper $db) {
    // Assuming you have a hidden input field in your form containing the booking ID
    $bookingId = $_POST['bookingId'];

    // Update the booking status to "Canceled"
    $result = $db->updateRecord("bookinglawyer", ['id' => $bookingId, 'bookingStatus' => 'Cancelled']);

    // Check the result of the update
    if ($result) {
        $_SESSION["m"] ="The booking has been canceled. Can you provide an explanation?";
        header("Location: ../user/edit.userwoman.php");
        exit();
    } else {
        $_SESSION["m"] ="Error Cancelled booking. Please try again!";
        header("Location: ../user/edit.userwoman.php");
        exit();
    }
}


/**
 * Handles the form submission for editing a booking.
 * @param DbHelper $db
 */
function handleEditBooking(DbHelper $db) {
   $bookingId = isset($_POST['bookingId']) ? $_POST['bookingId'] : null;
   $newReason = isset($_POST['Reason']) ? $_POST['Reason'] : null;

    $result = $db->updateRecord("bookinglawyer", [
        'id' => $bookingId,
        'Reason' => $newReason	,
    ]);

    
    if ($result) {
        $_SESSION["m"] ="Booking updated";
        header("Location: ../user/woman.dashboard.php");
        exit();
    } else {
        $_SESSION["m"] ="Error updating booking. Please try again!";
        header("Location: ../user/woman.dashboard.php");
        exit();
    }
}
?>
