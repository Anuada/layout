
<?php

include "../util/dbhelper.php";

$db = new DbHelper;


if (isset($_POST["submit"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $age = $_POST["age"];

    if (!empty(trim($fname)) && !empty(trim($lname)) && !empty(trim($age))) {
        $addEmployee = $db->addRecord("data", ["fname" => $fname, "lname" => $lname, "age" => $age]);
        if ($addEmployee > 0) {
            header("Location: ../");
            exit();
        } else {
            header("Location: ../?m=NO+DATA+WAS+ADDED");
            exit();
        }
    } else {
        header("Location: ../");
        exit();
    }
} 


?>