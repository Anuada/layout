<?php
session_start();
include "../shared/session.lawyer.php";
require_once "../util/DbHelper.php";

// Initialize the database helper
$dbHelper = new DbHelper();

// Get the logged-in lawyer's account ID from the session
$accountId = $_SESSION['accountId'];

// Fetch booked appointments for the logged-in lawyer
$bookedAppointments = $dbHelper->joinLawyerWoman("lawyeravailability", ['lawyer_Id' => $accountId]);

// Set the title for the dashboard
$title = "Lawyer Dashboard";

// Start the output buffering for styles and scripts
ob_start();
include "../shared/navbar.lawyer.php";
?>
<link rel="stylesheet" href="../assets/css/login.css">
<link rel="stylesheet" href="../assets/css/bookprevtable.css">
<!-- Add additional styles for your modal if needed -->
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Add additional JS for your modal if needed -->
<?php $scripts = ob_get_clean(); ?>

<?php ob_start(); ?>
<section class="col">
    <div class="container">
        <div class="row justify-content-center pt-20">
            
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
                                    <td><?= htmlspecialchars($appointment['postLink']) ?></td>
                                    <td><?= htmlspecialchars($appointment['bookingStatus']) ?></td>
                                    <td>
                                        <?php if ($appointment['bookingStatus'] == 'Pending') : ?>
                                            <!-- Add content or remove the block if not needed -->

                                        <?php endif; ?>
                                        <!-- Edit button trigger modal -->
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= htmlspecialchars($appointment['id']) ?>">
                                            Edit
                                        </button>

                                        <!-- Edit Modal content -->
                                        <!-- Edit Modal content -->
<div class="modal fade" id="editModal<?= htmlspecialchars($appointment['id']) ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="../logic/edit.LegalCounsel.process.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit form fields -->
                    <!-- Edit form fields -->
<input type="hidden" name="bookingId" value="<?= htmlspecialchars($appointment['id']) ?>">
<div class="mb-3">
    <label for="Avail_Ldate" class="form-label">New Date:</label>
    <!-- Use the correct format for input type 'date' -->
    <input type="date" class="form-control" name="Avail_Ldate" id="Avail_Ldate" value="<?= date('Y-m-d', strtotime($appointment['Avail_Ldate'])) ?>">
</div>
<!-- Add more form fields as needed -->
<div class="mb-3">
    <label for="Avail_startLtime" class="form-label">New Start Time:</label>
    <input type="time" class="form-control" name="Avail_startLtime" id="Avail_startLtime" value="<?= date('H:i', strtotime($appointment['Avail_startLtime'])) ?>">
</div>
<div class="mb-3">
    <label for="Avail_EndLtime" class="form-label">New End Time:</label>
    <input type="time" class="form-control" name="Avail_EndLtime" id="Avail_EndLtime" value="<?= date('H:i', strtotime($appointment['Avail_EndLtime'])) ?>">
</div>
<div class="mb-3">
    <label for="postLink" class="form-label">New Specialization:</label>
    <input type="text" class="form-control" name="postLink" id="postLink" value="<?= htmlspecialchars($appointment['postLink']) ?>">
</div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning" name="editBooking">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No booked appointments found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php $content = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>
