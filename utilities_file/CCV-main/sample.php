<?php

include "./util/DbHelper.php";

$db = new DbHelper();

$all_user = $db->joinLawyerWoman("bookinglawyer", ['lawyerId' => '2d4a4038-0fda-4bde-a1f6-0bcc67700aee']);

print_r($all_user);