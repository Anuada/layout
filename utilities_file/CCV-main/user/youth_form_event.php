<?php
session_start();
include "../shared/session.woman.php";
include "../shared/navbar.users.php";
$title = "Form Submit Reason";
$db = new DbHelper();
$dh = new DirHandler();
ob_start();
?>

<title><?php echo $title; ?></title>
<div class="container">

    <form action="../logic/youth_join_event_process.php" method="post" enctype="multipart/form-data" id="submitformlegal" style="margin-top:10%;">
        <input type="hidden" name="userId" value="<?php echo htmlspecialchars($_SESSION["accountId"]); ?>" required>
        <input type="hidden" name="youth_leaderId" value="<?php echo htmlspecialchars($_GET["youth_leaderId"]); ?>" required>
        <div class="form-group">
            <label for="reason">Types of Complaints</label>
            <input type="text" class="form-control" id="reason" name="reason" placeholder="Enter Reason" required>
        </div>

        <div class="form-group">
            <p class="card-text">
                <?php
                $youthleader_viewing_events = $db->youthleader_viewing_events($_GET['youth_leaderId']);
                if (!empty($youthleader_viewing_events)) : ?>
                    <strong>Events:</strong><br>
                    <select name="typeof_event" class="form-control">
                        <?php foreach ($youthleader_viewing_events as $event) : ?>
                            <option value="<?= htmlspecialchars($event->event) ?>">
                                <?= htmlspecialchars($event->event) ?> - <?= htmlspecialchars($event->des) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php else : ?>
                    No Events found.
                <?php endif; ?>
            </p>
        </div>
        <br>
        <button type="submit" name="submit" class="btn bg-fuchsia text-white" style="width: 100%">Submit Now</button>
    </form>

</div>
<?php
$content = ob_get_clean();
ob_start();
?>

<script src="../assets/js/login.session.storage.js"></script>
<script src="../assets/js/submitbooking.js"></script>

<?php
$scripts = ob_get_clean();

require_once "../shared/layout.php";
?>