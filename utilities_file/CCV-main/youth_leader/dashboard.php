<?php
session_start();
include "../shared/session.youth_leader.php";
include "../shared/navbar.youth_leader.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$dbHelper = new DbHelper();
$title = "Youth Leader Dashboard";
$accountId = $_SESSION['accountId'];

$tableName = "youth_leader";
$row = $dbHelper->fetchRecords($tableName, ['accountId' => $accountId]);
$joined_event = $dbHelper->youth_joining_event($accountId);

?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/lawyer.sidebar.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<br>
<br>
<br>

<section>
  <div class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-8 col-xl-9">
          <style>
            .table-container {
              display: flex;
              justify-content: center;
              align-items: center;
              margin-top: 5%;
            }

            table {
              border-collapse: collapse;
              width: 100%;
            }

            th,
            td {
              border: 1px solid #dddddd;
              text-align: left;
              padding: 8px;
            }

            th,
            td {
              background-color: #f2f2f2;
            }

            tr:nth-child(even) {
              background-color: #f2f2f2;
            }

            tr:hover {
              background-color: #dddddd;
            }

            .profile-img {
              border-radius: 50%;
              margin-left: 20px;
            }
          </style>

          <div class="table-container">
            <table>
              <tr>
                <th colspan="7" class="bg-fuchsia text-center">YOUTH EVENT</th>
              </tr>
              <tr>
                <th>Profile</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Event</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <?php foreach ($joined_event as $event) : ?>
                <tr>
                  <td><img src="<?php echo $dh->users_profile . $event->profileImage; ?>" alt="Profile Picture" width="60" height="60" class="profile-img"></td>
                  <td><?php echo $event->fname; ?></td>
                  <td><?php echo $event->lname; ?></td>
                  <td>
                    <button class="btn bg-fuchsia" data-toggle="modal" data-target="#typesOfEvents<?php echo $event->id ?>">View</button>
                  </td>
                  <td>
                    <button class="btn bg-fuchsia" data-toggle="modal" data-target="#reason<?php echo $event->id ?>">View</button>
                  </td>
                  <td>
                    <?php echo $event->bookingStatus; ?>
                  </td>
                  <td>
                    <?php if ($event->bookingStatus == "Pending") : ?>
                      <!-- Accept Button -->
                      <button class="btn btn-success" data-toggle="modal" data-target="#acceptModal<?php echo $event->id; ?>">Accept</button>

                      <!-- Cancel Button -->
                      <button class="btn btn-danger" data-toggle="modal" data-target="#cancelModal<?php echo $event->id; ?>">Cancel</button>
                    <?php else : ?>

                    <?php endif; ?>
                  </td>
                </tr>

                <!-- Accept Modal -->
                <div class="modal fade" id="acceptModal<?php echo $event->id; ?>" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel<?php echo $event->id; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="acceptModalLabel<?php echo $event->id; ?>">Confirm Accept</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to accept This person?
                      </div>
                      <div class="modal-footer">
                        <form method="post" action="../logic/youth_join_event_process.php">
                          <input type="hidden" name="bookingId" value="<?php echo $event->id; ?>">
                          <button type="submit" name="acceptBooking" class="btn btn-success">Accept</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Cancel Modal -->
                <div class="modal fade" id="cancelModal<?php echo $event->id; ?>" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel<?php echo $event->id; ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel<?php echo $event->id; ?>">Confirm Cancel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to cancel this Person?
                      </div>
                      <div class="modal-footer">
                        <form method="post" action="../logic/youth_join_event_process.php">
                          <input type="hidden" name="bookingId" value="<?php echo $event->id; ?>">
                          <button type="submit" name="cancelledJoining" class="btn btn-danger">Cancel</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="typesOfEvents<?php echo $event->id ?>" tabindex="-1" role="dialog" aria-labelledby="typesOfEventsLabel<?php echo $event->id ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="typesOfEventsLabel<?php echo $event->id ?>">Youth Joined Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Event Name: <?php echo $event->event; ?></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal fade" id="reason<?php echo $event->id ?>" tabindex="-1" role="dialog" aria-labelledby="reasonLabel<?php echo $event->id ?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="reasonLabel<?php echo $event->id ?>">Reason for Joining</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Reason: <?php echo $event->reason; ?></p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<br>
<br>
<br>

<?php $content = ob_get_clean(); ?>

<?php ob_start(); ?>
<!-- Additional scripts if needed -->
<script src="../assets/js/script.js"></script>
<script src="../assets/js/lawyer.sidebar.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php"; ?>