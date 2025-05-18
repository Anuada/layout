<?php
session_start();

require_once "../util/DirHandler.php";
require_once "../util/DbHelper.php";
include "../shared/session.youth_leader.php";

$dh = new DirHandler();
$db = new DbHelper();

$title = "Update Profile youth_leader";

if (isset($_SESSION['accountId'])) {
    $accountId = $_SESSION['accountId'];
    $youth_leader = $db->fetchRecords('youth_leader', ['accountId' => $accountId]);
    if (empty($youth_leader)) {
        header("Location: login.php");
        exit();
    }
    $fname = isset($youth_leader[0]['fname']) ? htmlspecialchars($youth_leader[0]['fname']) : '';
    $lname = isset($youth_leader[0]['lname']) ? htmlspecialchars($youth_leader[0]['lname']) : '';
} else {
    header("Location: login.php");
    exit();
}
ob_start();
?>
<?php include "../shared/navbar.youth_leader.php"; ?>

<title><?php echo $title; ?></title>

<div class="container" style="margin-top:10%; background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 100px; border-radius: 15px;">
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 margin-left">
            <div class="card" style="margin-top:35%;">
                <div style="margin-top:10px;" class="user-profile text-center">
                    <?php if (!empty($youth_leader) && !empty($youth_leader[0]["profileImage"])) : ?>
                        <img src="<?php echo $dh->youth_leader . $youth_leader[0]["profileImage"]; ?>" alt="Profile Image" class="profile-img">
                    <?php else : ?>
                        <img onerror="this.src='../assets/img/misc/profileicon.jpg'" src="<?php echo $dh->youth_leader; ?>profileicon.jpg" alt="Profile Image" class="profile-img">
                    <?php endif; ?>
                    <br>
                    <br>
                    <h6 class="user-contact">
                        <?php
                        if (isset($youth_leader[0]['fname']) && isset($youth_leader[0]['lname'])) {
                            echo htmlspecialchars($youth_leader[0]['fname']) . ' ' . htmlspecialchars($youth_leader[0]['lname']);
                        }
                        ?>
                    </h6>
                    <h6 style="color:darkcyan">YOUTH LEADER</h6>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <form action="../logic/youth_leader_upload_events.php" method="post" enctype="multipart/form-data" id="submitformlegal" style="margin-top:10%;">
                <input type="hidden" name="youth_leaderId" value="<?php echo $_SESSION['accountId']; ?>" required>

                <div class="form-group">
                    <label for="TypeofEvents">Types of Events</label>
                    <input type="text" class="form-control" id="TypeofEvents" name="TypeofEvents" placeholder="Enter Events" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="date">Date Start</label>
                    <input type="date" class="form-control" id="date" name="date" placeholder="date" required>
                </div>
                <br>

                <div class="form-group">
                    <label for="time_start">Time Start</label>
                    <input type="time" class="form-control" id="time_start" name="time_start" placeholder="Time Start" required>
                </div>
                <br>

                <div class="form-group">
                    <label for="time_end">Time End</label>
                    <input type="time" class="form-control" id="time_end" name="time_end" placeholder="Time End" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Enter Location" required>
                </div>

                <br>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" class="form-control" id="Description" name="Description" placeholder="Enter Description" required>
                </div>
                <br>

                <button type="submit" name="submit" class="btn bg-fuchsia text-white">Submit Now</button>
            </form>
        </div>
    </div>
</div>

<style>
    .profile-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        max-width: 100px;
        max-height: 100px;
    }
</style>

<?php
$content = ob_get_clean();
ob_start();
?>

<?php
$scripts = ob_get_clean();
require_once "../shared/layout.php";
?>