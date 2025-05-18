<?php
session_start();
include "../shared/session.woman.php";
include "../shared/navbar.users.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$dbHelper = new DbHelper();
$title = "Youth Leader Dashboard";
$accountId = $_SESSION['accountId'];

$tableName = "users";
$row = $dbHelper->fetchRecords($tableName, ['accountId' => $accountId]);
$joined_event = $dbHelper->youth_view_event($accountId);

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
                            text-align: center;
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
                                <th colspan="7" class="bg-fuchsia text-center">JOINED EVENT</th>
                            </tr>
                            <tr>
                                <th>LEADER</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Event</th>
                                <th>Location</th>
                                <th>Status</th>
                            </tr>
                            <?php foreach ($joined_event as $event) : ?>
                                <tr>
                                    <td><img src="<?php echo $dh->youth_leader . $event->profileImage; ?>" alt="Profile Picture" width="60" height="60" class="profile-img"></td>
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

                                </tr>

                                <!-- Accept Modal -->
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

                                <!-- Cancel Modal -->

                                <div class="modal fade" id="reason<?php echo $event->id ?>" tabindex="-1" role="dialog" aria-labelledby="reasonLabel<?php echo $event->id ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="reasonLabel<?php echo $event->id ?>">Location</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <center>
                                                    <p class="justify-text">
                                                        <a href="<?php echo $event->location; ?>" target="_blank">
                                                            <span>Click here</span>
                                                        </a>
                                                    </p>
                                                </center>
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