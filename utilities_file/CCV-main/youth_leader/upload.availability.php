<?php
session_start(); 
include "../shared/session.lawyer.php";
$title = "Booking Legal Counsel Form"; 

ob_start(); 
?>

<title><?php echo $title; ?></title>
<link rel="stylesheet" href="../assets/css/formsubmit.booklawyer.css">

<div class="container">
    <section class="row">
        <section class="col">
            <div class="d-flex justify-content-center align-items-center text-center pt-40">
                <a href="./">
                    <img src="../assets/img/logo/ElevateHer_Logo_Bold_Shadow.png" alt="ElevateHer">
                </a>
            </div>
            <p class="text-center fs-4 fuchsia pt-4">
               Upload Schedule Availability
            </p>
        </section>
        <section class="col">
            <div class="container">
                <div class="row justify-content-center pt-20">
                    <div class="col-md-6 login-container p-4 rounded w-form mb-20 shadow-sm">
                        <h2 class="text-center mb-4 fuchsia">Book Lawyer Now</h2>
                        <form action="../logic/UploadAvailabilityLawyer.process.php" method="post" id="submitformlegal">
                            <input type="hidden" name="lawyerId" id="lawyerId" value="<?php echo $_SESSION["accountId"] ?? ''; ?>" required>
                            <input type="hidden" name="womanId" id="womanId" value="<?php echo $_GET["id"] ?? ''; ?>" required>

                            <p class="form-group">
                                <label for="Avail_startLTime" class="fuchsia">Start Time</label>
                                <input type="time" class="form-control" id="Avail_startLTime" name="Avail_startLTime" placeholder="Enter Start Time" required>
                            </p>
                            <p class="form-group">
                                <label for="Avail_EndLTime" class="fuchsia">End Time</label>
                                <input type="time" class="form-control" id="Avail_EndLTime" name="Avail_EndLTime" placeholder="Enter End Time" required>
                            </p>
                            <p class="form-group">
                                <label for="Avail_Ldate" class="fuchsia">Date</label>
                                <input type="date" class="form-control" id="Avail_Ldate" name="Avail_Ldate" placeholder="Enter Date" required>
                            </p>
                           
                            <p class="form-group pt-1">
                                <button type="submit" name="submit" class="btn bg-fuchsia text-white" style="width: 100%">Submit Now</button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </section>
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
