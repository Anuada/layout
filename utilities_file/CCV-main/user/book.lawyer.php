<?php
session_start(); 
include "../shared/session.woman.php";
require_once "../util/DbHelper.php";
$db = new DbHelper();
$title = "Booking Legal Counsel Form"; 

$availables = $db->fetchRecords('lawyeravailability', ['lawyer_Id' => $_GET['id']]);
$lawyer_bookings = $db->fetchRecords('bookinglawyer');

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
                Empower You to Help Justice
            </p>
        </section>
        <section class="col">
    <div class="container">
        <div class="row justify-content-center pt-20">
            <div class="col-md-6 login-container p-4 rounded w-form mb-20 shadow-sm">
                <h2 class="text-center mb-4 fuchsia">Book Lawyer Now</h2>
                <form action="../logic/user_booking_process.php" method="post" id="submitformlegal">
                    <input type="hidden" name="womanId" id="womanId" value="<?php echo $_SESSION["accountId"] ?>" required>
                    <input type="hidden" name="lawyerId" id="lawyerId" value="<?php echo $_GET["id"] ?>" required>

                    <p class="form-group">
                        <label for="availability" class="fuchsia">Availability</label>
                        <select class="form-control" id="availability" name="availability">
                            <option selected disabled>SELECT AVAILABILITY</option>
                            <?php foreach($availables as $avail): ?>
                                <?php
                                $available_id = array_column($lawyer_bookings,'availability_id');
                                ?>
                                <?php if(!in_array($avail['id'], $available_id)): ?>
                                    <option value="<?php echo $avail['id'] ?>"><?php echo date('F d, Y', strtotime($avail['Avail_Ldate'])) . " | " . date('g:i A', strtotime($avail['Avail_startLtime'])) . " - " . date('g:i A', strtotime($avail['Avail_EndLtime'])) ?></option>
                                <?php endif; ?>
                                
                            <?php endforeach ?>
                        </select>
                    </p>
                    <p class="form-group">
                        <label for="specialize" class="fuchsia">Specialize</label>
                        <input type="text" class="form-control" id="specialize" name="specialize" placeholder="Enter specialize">
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
