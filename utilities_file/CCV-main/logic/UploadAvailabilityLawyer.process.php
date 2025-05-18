<?php
session_start();


require_once "../util/DbHelper.php";

$db = new DbHelper();


if (isset($_POST['submit'])) {
    handleAvailSubmission($db);
}

function handleAvailSubmission(DbHelper $db) {
   

    $lawyerId = $_POST["lawyerId"];
    $Avail_startLTime = $_POST['Avail_startLTime'];
    $Avail_EndLTime = $_POST['Avail_EndLTime'];
    $Avail_Ldate = $_POST['Avail_Ldate'];

    
    if (isset($_SESSION['accountId'])) {
        $accountId = $_SESSION['accountId'];

      
        $result = $db->addRecord("lawyeravailability", [
		
            'lawyer_Id' => $lawyerId,
            'Avail_startLTime' => $Avail_startLTime,
            'Avail_EndLTime' => $Avail_EndLTime,
            'Avail_Ldate' => $Avail_Ldate,
        ]);

        if ($result) {
            $_SESSION["m"] ="submit successful availability";
            header("Location: ../lawyer/upload.availability.php");
            exit();
        } else {
            $_SESSION["m"] ="Error submit availability. Please try again!";
            header("Location: ../lawyer/dashboard.php");
            exit();
        }
    } else {
        $_SESSION["m"] ="User not authenticated. Please log in!";
        header("Location: ../lawyer/upload.availability.php");
        exit();
    }
}


?>
