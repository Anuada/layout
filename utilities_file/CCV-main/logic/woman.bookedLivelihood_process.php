<?php
// Start the session for counselor side process
session_start();

// Include the database connection file
require_once "../util/DbHelper.php";

$db = new DbHelper();

// Check if the form is submitted
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
    // Collect form data
    $womanId = $_POST["womanId"];
    $Livelihood_providerId = $_POST["Livelihood_providerId"];
    $StartdayOfMonth = $_POST['StartdayOfMonth'];
    $EnddayOfMonth = $_POST['EnddayOfMonth'];
    $Course = $_POST['Course'];
    $postLink = $_POST['postLink'];

    // Check if the user is authenticated
    if (isset($_SESSION['accountId'])) {
        $accountId = $_SESSION['accountId'];

        // Insert the booking into the database
        $result = $db->addRecord("bookinglivelihood", [
            'womanId' => $womanId,
            'Livelihood_providerId' => $Livelihood_providerId,
            'StartdayOfMonth' => $StartdayOfMonth,
            'EnddayOfMonth' => $EnddayOfMonth,
            'Course' => $Course,
            'postLink' => $postLink,
            'BookingStatus' => "Pending"
        ]);

        if ($result) {
            $_SESSION["m"] = "Booking successful";
            header("Location: ../user/choose.instructor.livelihood.php");
            exit();
        } else {
            $_SESSION["m"] = "Error submitting booking. Please try again!";
            header("Location: ../user/choose.instructor.livelihood.php");
            exit();
        }
    } else {
        $_SESSION["m"] = "User not authenticated. Please log in!";
        header("Location: ../user/choose.instructor.livelihood.php");
        exit();
    }
}

function handleAcceptBooking(DbHelper $db) {
    $bookingId = $_POST['bookingId'];

    // Update the booking status to "Accept"
    $result = $db->updateRecord("bookinglivelihood", ['id' => $bookingId, 'BookingStatus' => 'Accept']);

    // Check the result of the update
    if ($result) {
        $_SESSION["m"] = "Booking accepted";
        header("Location: ../livelihood-provider/submit.link.livelihood.php");
        exit();
    } else {
        $_SESSION["m"] = "Error accepting booking. Please try again.";
        header("Location: ../livelihood-provider/dashboard.php");
        exit();
    }
}

function handleCancelBooking(DbHelper $db) {
    $bookingId = $_POST['bookingId'];

    // Update the booking status to "Canceled"
    $result = $db->updateRecord("bookinglivelihood", ['id' => $bookingId, 'BookingStatus' => 'Canceled']);

    // Check the result of the update
    if ($result) {
        $_SESSION["m"] = "Booking canceled";
        header("Location: ../livelihood-provider/dashboard.php");
        exit();
    } else {
        $_SESSION["m"] = "Error canceling booking. Please try again!";
        header("Location: ../livelihood-provider/dashboard.php");
        exit();
    }
}

function handleEditBooking(DbHelper $db) {
    $bookingId = isset($_POST['bookingId']) ? $_POST['bookingId'] : null;

    // Collect updated form data
    $newStartdayOfMonth = isset($_POST['StartdayOfMonth']) ? $_POST['StartdayOfMonth'] : null;
    $newEnddayOfMonth = isset($_POST['EnddayOfMonth']) ? $_POST['EnddayOfMonth'] : null;
    $newCourse = isset($_POST['Course']) ? $_POST['Course'] : null;
    $newpostLink = isset($_POST['postLink']) ? $_POST['postLink'] : null;

    // Update the booking details in the database
    $result = $db->updateRecord("bookinglivelihood", [
        'id' => $bookingId,
        'StartdayOfMonth' => $newStartdayOfMonth,
        'EnddayOfMonth' => $newEnddayOfMonth,
        'Course' => $newCourse,
        'postLink' => $newpostLink,
    ]);

    // Check the result of the update
    if ($result) {
        $_SESSION["m"] = "Booking updated";
        header("Location: ../livelihood-provider/dashboard.php");
        exit();
    } else {
        $_SESSION["m"] = "Error updating booking. Please try again!";
        header("Location: ../livelihood-provider/dashboard.php");
        exit();
    }
}
?>
