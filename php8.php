<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Conditions Practice - Clean UI</title>
    <style>
    * {
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background: #f0f2f5;
        margin: 0;
        padding: 30px;
        color: #333;
    }

    h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    form {
        max-width: 700px;
        margin: auto;
        padding: 0 15px;
    }

    .section {
        background: #fff;
        border-left: 6px solid #0d6efd;
        padding: 20px;
        margin-bottom: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
    }

    .section h3 {
        margin-top: 0;
        color: #0d6efd;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        font-weight: 500;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    input[type="submit"],
    .close-btn {
        padding: 10px 18px;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        width: 100%;
    }

    input[type="submit"] {
        background: #0d6efd;
    }

    input[type="submit"]:hover {
        background: #0a58ca;
    }

    .close-btn {
        background: #dc3545;
        margin-top: 20px;
    }

    .close-btn:hover {
        background: #b02a37;
    }

    /* Modal Styling */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1000;
        display: none;
    }

    .modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        z-index: 1001;
        max-width: 400px;
        width: 90%;
        text-align: center;
        display: none;
    }

    #modalContent {
        font-size: 18px;
        font-weight: bold;
        color: #198754;
    }

    /* Responsive design */
    @media (max-width: 600px) {
        body {
            padding: 20px 10px;
        }

        .section {
            padding: 15px;
        }

        input[type="submit"],
        .close-btn {
            font-size: 14px;
            padding: 10px;
        }

        .modal {
            width: 95%;
            padding: 20px;
        }

        #modalContent {
            font-size: 16px;
        }
    }
</style>



</head>
<body>

<h2>PHP Condition Challenges</h2>

<form method="POST">
    <div class="section">
        <h3>1. Is the Water Boiling?</h3>
        <label>Enter Temperature (e.g., 212F or 100C):</label>
        <input type="text" name="temp">
        <input type="submit" name="check_boiling" value="Check Boiling Point">
    </div>

    <div class="section">
        <h3>2. Prime Number Checker</h3>
        <label>Enter a number:</label>
        <input type="number" name="val">
        <input type="submit" name="check_prime" value="Check Prime">
    </div>

    <div class="section">
        <h3>3. Count Primes Up To</h3>
        <label>Enter maximum number:</label>
        <input type="number" name="maxPrime">
        <input type="submit" name="count_primes" value="Count Primes">
    </div>

    <div class="section">
        <h3>4. Custom Character Sort</h3>
        <label>Enter Template String (t):</label>
        <input type="text" name="template">
        <label>Enter String to Sort (s):</label>
        <input type="text" name="tosort">
        <input type="submit" name="custom_sort" value="Sort String">
    </div>
</form>

<!-- Modal Box -->
<div class="modal-overlay" id="modalOverlay"></div>
<div class="modal" id="modalBox">
    <div id="modalContent">Result here...</div>
    <button class="close-btn" onclick="closeModal()">Close</button>
</div>

<script>
    function showModal(message) {
        document.getElementById('modalContent').innerHTML = message;
        document.getElementById('modalOverlay').style.display = 'block';
        document.getElementById('modalBox').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('modalOverlay').style.display = 'none';
        document.getElementById('modalBox').style.display = 'none';
    }
</script>

<?php
$result = "";

if (isset($_POST["check_boiling"])) {
    $temp = $_POST["temp"];
    $unit = strtoupper($temp[strlen($temp)-1]);
    $number = "";

    for ($i = 0; $i < strlen($temp)-1; $i++) {
        $number .= $temp[$i];
    }

    $number = $number + 0;
    $isBoiling = ($unit == "F" && $number >= 212) || ($unit == "C" && $number >= 100);
    $result = "Result: " . ($isBoiling ? "true (Boiling)" : "false (Not Boiling)");
}

if (isset($_POST["check_prime"])) {
    $val = $_POST["val"];
    $isPrime = true;

    if ($val <= 1) $isPrime = false;
    else {
        for ($i = 2; $i < $val; $i++) {
            if ($val % $i == 0) {
                $isPrime = false;
                break;
            }
        }
    }

    $result = "Result: " . ($isPrime ? "true (Prime)" : "false (Not Prime)");
}

if (isset($_POST["count_primes"])) {
    $max = $_POST["maxPrime"];
    $count = 0;

    for ($i = 2; $i <= $max; $i++) {
        $isPrime = true;
        for ($j = 2; $j < $i; $j++) {
            if ($i % $j == 0) {
                $isPrime = false;
                break;
            }
        }
        if ($isPrime) {
            $count++;
        }
    }

    $result = "Result: $count prime numbers up to $max";
}

if (isset($_POST["custom_sort"])) {
    $t = $_POST["template"];
    $s = $_POST["tosort"];
    $sorted = "";
    $used = "";

    for ($i = 0; $i < strlen($t); $i++) {
        for ($j = 0; $j < strlen($s); $j++) {
            if ($s[$j] == $t[$i]) {
                $sorted .= $s[$j];
                $used .= $j . ",";
            }
        }
    }

    for ($a = 97; $a <= 122; $a++) {
        for ($j = 0; $j < strlen($s); $j++) {
            if (strpos($used, $j . ",") === false && ord($s[$j]) == $a) {
                $sorted .= $s[$j];
            }
        }
    }

    $result = "Result: $sorted";
}

if (!empty($result)) {
    echo "<script>showModal(`$result`);</script>";
}
?>

</body>
</html>
