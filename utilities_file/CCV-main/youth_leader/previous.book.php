<?php
session_start();
include "../shared/session.lawyer.php";
require_once "../util/DbHelper.php";

include "../shared/navbar.lawyer.php";
$db = new DbHelper();


$title = "Lawyer Dashboard";

$accountId = $_SESSION['accountId'];

// Fetch booked appointments for the logged-in lawyer
$bookedAppointments = $db->joinLawyerWoman("bookinglawyer", ['lawyerId' => $accountId]);
?>

<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/login.css">
<link rel="stylesheet" href="../assets/css/bookprevtable.css">
<!-- Add additional styles for your modal if needed -->
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>


<section class="col">
  <div class="container">
    <div class="row justify-content-center pt-20">
      <div class="col-md-6 login-container bg-bubble-gum p-4 rounded w-form mb-20 shadow-sm">
        <h2 class="text-center mb-10 fuchsia">Your Booked appointments</h2>
        <?php if (!empty($bookedAppointments)) : ?>
          <table id="previous">
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
                  <td><?php echo $appointment['id'] ?></td>
                  <td><?php echo $appointment['fname'] . " " . $appointment['lname'] ?></td>
                  <td><?= htmlspecialchars(date('F d, Y', strtotime($appointment['Avail_Ldate']))) ?></td>
                  <td><?= htmlspecialchars(date('h:i A', strtotime($appointment['Avail_startLtime']))) ?></td>
                  <td><?= htmlspecialchars(date('h:i A', strtotime($appointment['Avail_EndLtime']))) ?></td>
                  <td><?php echo $appointment['specialize'] ?></td>
                  <td><?php echo $appointment['bookingStatus'] ?></td>
                  <td>
                    <?php if ($appointment['bookingStatus'] == 'Pending') : ?>
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#acceptModal<?php echo $appointment['id'] ?>">
                        Accept
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="acceptModal<?php echo $appointment['id'] ?>" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="acceptModalLabel">Accept Booking</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              Are you sure you want to accept this booking?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                              <form method="post" action="../logic/user_booking_process.php">
                                <input type="hidden" name="bookingId" value="<?php echo $appointment['id'] ?>">
                                <button type="submit" class="btn btn-primary" name="acceptBooking">Accept</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endif; ?>
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

<?php $content = ob_get_clean() ?>


<?php ob_start() ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="static/js/courtcom.js"></script>
<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>