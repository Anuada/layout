<?php
session_start();
include "../shared/session.lawyer.php";
require_once "../util/DbHelper.php";
// Initialize the database helper
$dbHelper = new DbHelper();

// Function to handle the form submission for deleting a booking
function handleDeleteBooking($db) {
    // Assuming you have a hidden input field in your form containing the booking ID
    $bookingId = $_POST['bookingId'];

    // Perform the deletion from the database
    $result = $db->deleteRecord("bookinglawyer", ['id' => $bookingId]);

    // Check the result of the deletion
    if ($result) {
        $_SESSION["m"] = "Booking deleted";
        header("Location: ../lawyer/dashboard.php");
        exit();
    } else {
        $_SESSION["m"] = "Error deleting booking. Please try again!";
        header("Location: ../lawyer/dashboard.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteAppointment'])) {
    handleDeleteBooking($dbHelper);
}

// Get the logged-in lawyer's account ID from the session
$accountId = $_SESSION['accountId'];

// Fetch booked appointments for the logged-in lawyer
$bookedAppointments = $dbHelper->joinLawyerWoman("bookinglawyer", ['lawyerId' => $accountId]);

// Set the title for the dashboard
$title = "Lawyer Dashboard";

// Start the output buffering for styles and scripts
ob_start();

?>
<!-- Add your styles -->
<link rel="stylesheet" href="../assets/css/login.css">
<link rel="stylesheet" href="../assets/css/bookprevtable.css">
<!-- Add additional styles for your modal if needed -->
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Add your scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Add additional JS for your modal if needed -->
<?php $scripts = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Your HTML content -->
<section class="col">
   <div class="container">
        <div class="row justify-content-center pt-20">
            <div class="col-md-6 login-container bg-bubble-gum p-4 rounded w-form mb-20 shadow-sm">
                <h2 class="text-center mb-10 fuchsia">Your Booked Appointments</h2>
                <?php if (!empty($bookedAppointments)) : ?>
                    <table id="previous" class="table">
                        <thead>
                            <tr>
                                <th>Appointment Id</th>
                                <th>Booker Name</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Specialization</th>
                                <th>Booking Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookedAppointments as $appointment) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($appointment['id']) ?></td>
                                    <td><?= htmlspecialchars($appointment['fname'] . " " . $appointment['lname']) ?></td>
                                    <td><?= htmlspecialchars(date('F d, Y', strtotime($appointment['Avail_Ldate']))) ?></td>
                                    <td><?= htmlspecialchars(date('h:i A', strtotime($appointment['Avail_startLtime']))) ?></td>
                                    <td><?= htmlspecialchars(date('h:i A', strtotime($appointment['Avail_EndLtime']))) ?></td>
                                    <td><?= htmlspecialchars($appointment['specialize']) ?></td>
                                    <td><?= htmlspecialchars($appointment['bookingStatus']) ?></td>
                                    <td>
                                        <form method="post" action="lawyerbook.delete.php">
                                            <input type="hidden" name="deleteAppointment" value="true">
                                            <input type="hidden" name="bookingId" value="<?= htmlspecialchars($appointment['id']) ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No booked appointments available.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
