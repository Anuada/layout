<?php

if (isset($_SESSION['accountId'])) {
    switch ($_SESSION["user_type"]) {
        case 'woman':
            break;
        case 'lawyer':
            header("Location: ../lawyer/");
            break;
        case 'counselor':
            header("Location: ../counselor/");
            break;
        case 'livelihood-provider':
            header("Location: ../livelihood-provider/");
            break;
        case 'admin':
            header("Location: ../admin/");
            break;
        
        default:
            break;
    }
} else {
    header("Location: ../page/login.php");
    exit();
}