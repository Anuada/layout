<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../shared/session.lawyer.php";
require_once "../util/DirHandler.php";
require_once "../util/DbHelper.php";

$dh = new DirHandler();
$db = new DbHelper();

$title = "Update Profile Lawyer";

if (isset($_SESSION['accountId'])) {
    $accountId = $_SESSION['accountId'];
    $lawyer = $db->fetchRecords('lawyer',['accountId' => $accountId]);
    if (empty($lawyer)) {
        header("Location: login.php");
        exit();
    }
    $fname = isset($lawyer[0]['fname']) ? htmlspecialchars($lawyer[0]['fname']) : '';
    $lname = isset($lawyer[0]['lname']) ? htmlspecialchars($lawyer[0]['lname']) : '';
    
} else {
    header("Location: login.php");
    exit();
}
ob_start();
?>
<?php include "../shared/navbar.lawyer.php"; ?>

<title><?php echo $title; ?></title>

<link rel="stylesheet" href="../assets/css/update.profile.css">


<div class="container">
    <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="account-settings">
                        <div class="user-profile">
                            <div class="user-avatar">
                              <?php if (!empty($lawyer) && !empty($lawyer[0]["profileImage"])) : ?>
                            <img src="<?php echo $dh->lawyer_profile . $lawyer[0]["profileImage"]; ?>" alt="Profile Image" width="40" height="40" style="border-radius: 50%;" onerror="this.src='../assets/img/misc/profileicon.jpg'">
                        <?php else : ?>
                            <img onerror="this.src='../assets/img/misc/profileicon.jpg'" src="<?php echo $dh->lawyer_profile; ?>profileicon.jpg" alt="Profile Image" width="40" height="40" style="border-radius: 50%;">
                        <?php endif; ?>
                            </div>
                            <h5 class="user-name"><?php echo $fname . " " . $lname; ?></h5>
								<h6 class="user-email"><?php echo isset($lawyer[0]['contactNo']) ? htmlspecialchars($lawyer[0]['contactNo']) : ''; ?></h6>

                        </div>
                        <div class="about">
                            <h5>About</h5>
                            <p><?php echo isset($lawyer[0]['About']) ? htmlspecialchars($lawyer[0]['About']) : ''; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row gutters">
                        <form action="../logic/update.profile.lawyer.process.php" method="post" enctype="multipart/form-data" id="submit">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="">
                                    <label for="Price">Price</label>
                                    <input value="<?php echo $lawyer[0]["Price"]?>" type="number" class="form-control" id="Price" name="Price" placeholder="Enter Price">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="TimeDuration">Time Duration</label>
                                    <input value="<?php echo $lawyer[0]["TimeDuration"]?>" type="text" class="form-control" id="TimeDuration" name="TimeDuration" placeholder="Enter Duration Time">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="About">About</label>
                                    <input value="<?php echo $lawyer[0]["About"]?>" type="text" class="form-control" id="About" name="About" placeholder="Enter About">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ExperienceWork">Experience Work</label>
                                    <input value="<?php echo $lawyer[0]["ExperienceWork"]?>" type="text" class="form-control" id="ExperienceWork" name="ExperienceWork" placeholder="Enter experience">
                                </div>
                            </div>
							
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="ExperienceWork">Service</label>
                                    <input value="<?php echo $lawyer[0]["service"]?>" type="text" class="form-control" id="service" name="service" placeholder="Enter experience">
                                </div>
                            </div>
							
							<br>
							
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="form-group">
        <label for="LicenseImage">License Image</label>
        <input type="file" accept="image/*" name="LicenseImage" id="LicenseImage" class="form-control">
    </div>
</div>

<br>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="text-right">
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
								</br>
                            </div>
							
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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