<?php

session_start();


require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$db = new DbHelper();
$dh = new DirHandler();



if (isset($_POST['submit'])) {
    UploadAvailabilityLawyer($db,$dh);
} 

function UploadAvailabilityLawyer($db,$dh) {
    
    $accountId = $_SESSION['accountId']; 
    $Price = $_POST['Price'];
    $TimeDuration = $_POST['TimeDuration'];
    $ExperienceWork = $_POST['ExperienceWork']; 
    $About = $_POST['About']; 
    $service = $_POST['service']; 
    $LicenseImage = $_FILES['LicenseImage']; 

    $img_name = $accountId . ".png";
    $img_file = $dh->lawyer_license . $img_name;
    move_uploaded_file($_FILES["LicenseImage"]["tmp_name"], $img_file);

    $table = "lawyer"; 
    $data = array(
        "accountId" => $accountId,
        "Price" => $Price,
        "TimeDuration" => $TimeDuration,
        "ExperienceWork" => $ExperienceWork,
        "About" => $About,
        "service" => $service,
        "LicenseImage" => $img_file, 
    );

    $success = $db->updateRecord($table, $data);

    if ($success) {
		$_SESSION["m"] ="Update successfully";
            header("Location: ../lawyer/update.profile.lawyer.php");
            exit();
       
    } else {
		
		$_SESSION["m"] ="Error uploading!";
            header("Location: ../lawyer/update.profile.lawyer.php");
            exit();
      
    }
}
?>
