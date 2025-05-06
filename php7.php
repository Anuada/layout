<!DOCTYPE html>
<html>
<head>
    <title>PHP Condition Challenges</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        input, select { margin: 5px 0; padding: 5px; }
        .box { margin-bottom: 20px; }
    </style>
    <script>
        function toggleFields() {
            var problem = document.getElementById("problem").value;
            document.getElementById("tempInput").style.display = (problem == "1") ? "block" : "none";
            document.getElementById("primeInput").style.display = (problem == "2") ? "block" : "none";
            document.getElementById("primeCountInput").style.display = (problem == "3") ? "block" : "none";
            document.getElementById("customSortInput").style.display = (problem == "4") ? "block" : "none";
        }
    </script>
</head>
<body>

<h2>PHP Condition Practice</h2>
<form method="POST">
    <div class="box">
        <label>Select Problem:</label>
        <select name="problem" id="problem" onchange="toggleFields()">
            <option value="1">1. Boiling Point</option>
            <option value="2">2. Prime Number Check</option>
            <option value="3">3. Count Primes</option>
            <option value="4">4. Custom Sort</option>
        </select>
    </div>

    <div class="box" id="tempInput" style="display:block;">
        <label>Enter Temperature (e.g., 212F or 100C):</label><br>
        <input type="text" name="temp">
    </div>

    <div class="box" id="primeInput" style="display:none;">
        <label>Enter a number to check if prime:</label><br>
        <input type="number" name="val">
    </div>

    <div class="box" id="primeCountInput" style="display:none;">
        <label>Count prime numbers up to:</label><br>
        <input type="number" name="maxPrime">
    </div>

    <div class="box" id="customSortInput" style="display:none;">
        <label>Enter template string (t):</label><br>
        <input type="text" name="template"><br>
        <label>Enter string to sort (s):</label><br>
        <input type="text" name="tosort">
    </div>

    <input type="submit" name="submit" value="Check Answer">
</form>

<?php
if (isset($_POST["submit"])) {
    $problem = $_POST["problem"];

    // Problem 1: Boiling Point
    if ($problem == "1") {
        $temp = $_POST["temp"];
        $unit = $temp[strlen($temp)-1];
        $number = "";
        for ($i = 0; $i < strlen($temp)-1; $i++) {
            $number .= $temp[$i];
        }

        $number = $number + 0; // convert to int

        if (($unit == "F" && $number >= 212) || ($unit == "C" && $number >= 100)) {
            echo "<p><strong>Result:</strong> true (Boiling)</p>";
        } else {
            echo "<p><strong>Result:</strong> false (Not Boiling)</p>";
        }
    }

    // Problem 2: Prime Number Check
    if ($problem == "2") {
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

        echo "<p><strong>Result:</strong> " . ($isPrime ? "true (Prime)" : "false (Not Prime)") . "</p>";
    }

    // Problem 3: Count Prime Numbers
    if ($problem == "3") {
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

        echo "<p><strong>Result:</strong> $count prime numbers up to $max</p>";
    }

    // Problem 4: Custom Sort
    if ($problem == "4") {
        $t = $_POST["template"];
        $s = $_POST["tosort"];

        $sorted = "";
        $used = "";

        // Add characters from template in order
        for ($i = 0; $i < strlen($t); $i++) {
            for ($j = 0; $j < strlen($s); $j++) {
                if ($s[$j] == $t[$i]) {
                    $sorted .= $s[$j];
                    $used .= $j . ",";
                }
            }
        }

        // Add remaining characters in alphabetical order
        for ($a = 97; $a <= 122; $a++) {
            for ($j = 0; $j < strlen($s); $j++) {
                if (strpos($used, $j . ",") === false && ord($s[$j]) == $a) {
                    $sorted .= $s[$j];
                }
            }
        }

        echo "<p><strong>Result:</strong> $sorted</p>";
    }
}
?>

</body>
</html>
