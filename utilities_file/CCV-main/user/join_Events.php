<?php
session_start();
include "../shared/session.woman.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$db = new DbHelper();
$title = "Choose Events";

ob_start();
include "../shared/navbar.users.php";
$navbar = ob_get_clean();

$tableName = $db->fetchRecords("youth_leader");


?>

<?php ob_start(); ?>
<link rel="stylesheet" href="../assets/css/index.livelihoodTwo.css">
<link rel="stylesheet" href="../assets/css/lawyer.sidebar.css">
<style>
    .fixed-size-img {
        width: 300px;
        height: 300px;
        object-fit: cover;
    }
</style>

<div class="container" style="margin-top:10%;">

    <div class="row">
        <?php if (!empty($tableName)) : ?>
            <?php foreach ($tableName as $row) : ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php
                                $profileImage = isset($row['profileImage']) ? $dh->youth_leader . $row['profileImage'] : '../assets/img/misc/profileicon.jpg';
                                ?>
                                <img src="<?= htmlspecialchars($profileImage) ?>" alt="Profile Image" class="img-fluid fixed-size-img">
                            </h5>
                            <br>

                            <h5 class="card-title">
                                <p>Youth Leader: <?= htmlspecialchars($row['fname'] . ' ' . $row['lname']) ?></p>
                            </h5>
                            <p class="card-text">

                                <center><a href="youth_form_event.php?youth_leaderId=<?= htmlspecialchars($row['accountId']) ?>" class="btn btn-primary">VIEW EVENT NOW</a></center>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-md-12">
                <div class="alert alert-info" role="alert">
                    <center>No livelihood providers found. Please try a different search term.</center>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
$content = ob_get_clean();

ob_start();
?>

<script src="../assets/js/navbar.js"></script>
<script src="../assets/js/scroll.js"></script>
<?php $scripts = ob_get_clean(); ?>

<?php require_once "../shared/layout.php" ?>