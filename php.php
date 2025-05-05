<!DOCTYPE html>
<html>
<head>
    <title>PHP Multi-Tool Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            margin: 0;
            padding: 20px;
        }
        h2, h3 {
            color: #333;
        }
        form {
            background: #ffffff;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            padding: 8px;
            width: 100%;
            max-width: 400px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover {
            background-color: #004a99;
        }
        code {
            background-color: #e6f0ff;
            padding: 4px 8px;
            border-radius: 4px;
            display: inline-block;
        }
        .result {
            background: #e9ffe9;
            padding: 10px;
            margin-top: 10px;
            border-left: 4px solid #28a745;
            border-radius: 6px;
        }
        .error {
            background: #ffe9e9;
            padding: 10px;
            margin-top: 10px;
            border-left: 4px solid #dc3545;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<h1>PHP Tools: Converters & Parsers</h1>

<!-- Minutes to Seconds -->
<form method="post">
    <h2>Convert Minutes to Seconds</h2>
    <label for="minutes">Enter Minutes:</label>
    <input type="number" id="minutes" name="minutes" required>
    <button type="submit" name="submit_minutes">Convert</button>
</form>

<!-- Fix Import Statement -->
<form method="post">
    <h2>Fix Incorrect Python Import Statement</h2>
    <label for="wrong_import">Enter incorrect import:</label>
    <input type="text" id="wrong_import" name="wrong_import" required placeholder="e.g., import pi from math">
    <button type="submit" name="submit_import">Fix</button>
</form>

<!-- SpongeCase -->
<form method="post">
    <h2>Convert to SpongeCase (Alternating Caps)</h2>
    <label for="input_text">Enter your text:</label>
    <input type="text" id="input_text" name="input_text" required placeholder="e.g., Hello World">
    <button type="submit" name="submit_sponge">Convert</button>
</form>

<!-- Bugger and Grab Number Sum -->
<form method="post">
    <h2>Multiplicative Persistence & Sum of Numbers in String</h2>

    <h3>1. Multiplicative Persistence (Bugger)</h3>
    <label for="bugger_input">Enter a number:</label>
    <input type="number" id="bugger_input" name="bugger_input" placeholder="e.g. 39">

    <h3>2. Sum Numbers from String</h3>
    <label for="sum_input">Enter a string with numbers:</label>
    <input type="text" id="sum_input" name="sum_input" placeholder="e.g. aeiou250abc10">

    <button type="submit" name="submit_bugger_sum">Submit</button>
</form>

<?php
function toSpongeCase($text) {
    $result = '';
    $toggle = true;
    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (ctype_alpha($char)) {
            $result .= $toggle ? strtoupper($char) : strtolower($char);
            $toggle = !$toggle;
        } else {
            $result .= $char;
        }
    }
    return $result;
}

function bugger($num) {
    $count = 0;
    while ($num >= 10) {
        $digits = str_split((string)$num);
        $num = array_product($digits);
        $count++;
    }
    return $count;
}

function grabNumberSum($str) {
    preg_match_all('/\d+/', $str, $matches);
    $numbers = array_map('intval', $matches[0]);
    return array_sum($numbers);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Minutes to seconds
    if (isset($_POST['submit_minutes'])) {
        $minutes = intval($_POST['minutes']);
        $seconds = $minutes * 60;
        echo "<div class='result'><strong>$minutes</strong> minute(s) = <strong>$seconds</strong> second(s)</div>";
    }

    // Fix Python Import
    if (isset($_POST['submit_import'])) {
        $input = trim($_POST['wrong_import']);
        if (preg_match('/^import\s+(\w+)\s+from\s+(\w+)$/', $input, $matches)) {
            $object = $matches[1];
            $module = $matches[2];
            $correct = "from $module import $object";
            echo "<div class='result'>Fixed Import: <code>$correct</code></div>";
        } else {
            echo "<div class='error'>Invalid format. Use: import object from module</div>";
        }
    }

    // Spongecase
    if (isset($_POST['submit_sponge'])) {
        $input = $_POST['input_text'];
        $converted = toSpongeCase($input);
        echo "<div class='result'>SpongeCase Result: <code>$converted</code></div>";
    }

    // Bugger and Grab Number Sum
    if (isset($_POST['submit_bugger_sum'])) {
        if (!empty($_POST['bugger_input'])) {
            $buggerNum = intval($_POST['bugger_input']);
            $buggerResult = bugger($buggerNum);
            echo "<div class='result'>Multiplicative Persistence of <strong>$buggerNum</strong> is: <strong>$buggerResult</strong></div>";
        }
        if (!empty($_POST['sum_input'])) {
            $sumString = $_POST['sum_input'];
            $sumResult = grabNumberSum($sumString);
            echo "<div class='result'>Sum of numbers in the string: <strong>$sumResult</strong></div>";
        }
    }
}
?>

</body>
</html>
