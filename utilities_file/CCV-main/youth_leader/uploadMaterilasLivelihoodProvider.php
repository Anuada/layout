<?php
session_start(); 
include "../shared/session.livelihood.provider.php";
$title = "Upload Materials Form"; 

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
               Upload Materials
            </p>
        </section>
        <section class="col">
            <div class="container">
                <div class="row justify-content-center pt-20">
                    <div class="col-md-6 login-container p-4 rounded w-form mb-20 shadow-sm">
                        <h2 class="text-center mb-4 fuchsia">Upload Now</h2>
                        <form action="../logic/uploadMaterialsLivelihoodProvider.process.php" method="post" id="submitformlegal">
                            <input type="hidden" name="livelihood_providerId" id="livelihood_providerId" value="<?php echo $_SESSION["accountId"] ?? ''; ?>" required>
                            <input type="hidden" name="womanId" id="womanId" value="<?php echo $_GET["id"] ?? ''; ?>" required>

                            <p class="form-group">
                                <label for="postdate" class="fuchsia">Post date</label>
                                <input type="date" class="form-control" id="postdate" name="postdate" placeholder="Post Date" required>
                            </p>
                            <p class="form-group">
                                <label for="PostResources" class="fuchsia">Learning Resources</label>
                                <input type="text" class="form-control" id="PostResources" name="PostResources" placeholder="Post Resources" required>
                            </p>
                            <p class="form-group">
                                <label for="quizlink" class="fuchsia">Post Quiz link</label>
                                <input type="text" class="form-control" id="quizlink" name="quizlink" placeholder="Post Quiz" required>
                            </p>
							
							<p class="form-group">
                                <label for="Expertise" class="fuchsia">Post Your Expertise</label>
                                <input type="text" class="form-control" id="Expertise" name="Expertise" placeholder="Enter Expertise" required>
                            </p>
							
							<p class="form-group">
                                <label for="definition" class="fuchsia">Definition of Expertise</label>
                                <input type="text" class="form-control" id="definition" name="definition" placeholder="Enter Definition" required>
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
