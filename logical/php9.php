<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi Checker</title>
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background: #f0f0f5;
    }

    .container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    }

    h2 {
        text-align: center;
        font-size: 1.8em;
        margin-bottom: 20px;
    }

    .section {
        margin-bottom: 30px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    input[type="submit"] {
        width: 100%;
        padding: 12px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1em;
    }

    input[type="submit"] {
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
    }

    input[type="submit"]:hover {
        background: #0056b3;
    }

    .result {
        margin-top: 20px;
        padding: 15px;
        background-color: #e0f7fa;
        border-left: 6px solid #00796b;
        border-radius: 5px;
        animation: slideIn 0.5s ease-out;
        font-size: 1.1em;
    }

    @keyframes slideIn {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @media (max-width: 600px) {
        body {
            padding: 10px;
        }

        .container {
            padding: 15px;
        }

        h2 {
            font-size: 1.5em;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            font-size: 0.95em;
            padding: 10px;
        }

        .result {
            font-size: 1em;
        }
    }
</style>
</head>
<body>

<?php
function safeOutput($str) {
    $map = [
        '&' => '&amp;',
        '"' => '&quot;',
        "'" => '&#039;',
        '<' => '&lt;',
        '>' => '&gt;',
    ];
    $output = "";
    $len = stringLength($str);
    for ($i = 0; $i < $len; $i++) {
        $c = $str[$i];
        $output .= array_key_exists($c, $map) ? $map[$c] : $c;
    }
    return $output;
}

function customTrim($str) {
    $start = 0;
    $end = stringLength($str) - 1;

    while ($start <= $end && ($str[$start] === ' ' || $str[$start] === "\t" || $str[$start] === "\n" || $str[$start] === "\r")) {
        $start++;
    }

    while ($end >= $start && ($str[$end] === ' ' || $str[$end] === "\t" || $str[$end] === "\n" || $str[$end] === "\r")) {
        $end--;
    }

    $trimmed = "";
    for ($i = $start; $i <= $end; $i++) {
        $trimmed .= $str[$i];
    }
    return $trimmed;
}

function stringLength($str) {
    $count = 0;
    while (isset($str[$count])) {
        $count++;
    }
    return $count;
}

function parseCSV($input) {
    $result = [];
    $temp = "";
    $i = 0;

    while (isset($input[$i])) {
        $char = $input[$i];
        if ($char === ',') {
            $result[] = customTrim($temp);
            $temp = "";
        } else {
            $temp .= $char;
        }
        $i++;
    }

    if ($temp !== "") {
        $result[] = customTrim($temp);
    }

    return $result;
}

function hurdleJump($hurdles, $jumpHeight) {
    for ($i = 0; $i < count($hurdles); $i++) {
        if ($jumpHeight < (int)$hurdles[$i]) {
            return false;
        }
    }
    return true;
}

function secondLargest($array) {
    if (count($array) < 2) return "Need at least two numbers.";

    $largest = null;
    $second = null;

    for ($i = 0; $i < count($array); $i++) {
        $num = (int)$array[$i];
        if ($largest === null || $num > $largest) {
            $second = $largest;
            $largest = $num;
        } elseif ($num < $largest && ($second === null || $num > $second)) {
            $second = $num;
        }
    }

    return $second === null ? "There is no second largest (all values might be equal)." : $second;
}

function findBob($array) {
    for ($i = 0; $i < count($array); $i++) {
        if (customTrim($array[$i]) === "Bob") {
            return $i;
        }
    }
    return -1;
}
?>

<div class="container">
    <h2>Multi Checker</h2>
    <form method="post">
        <div class="section">
            <label>Enter hurdle heights (comma-separated):</label>
            <input type="text" name="hurdles" value="<?php echo array_key_exists('hurdles', $_POST) ? safeOutput($_POST['hurdles']) : ''; ?>">
            <label>Enter jump height:</label>
            <input type="number" name="jump_height" value="<?php echo array_key_exists('jump_height', $_POST) ? safeOutput($_POST['jump_height']) : ''; ?>">
        </div>

        <div class="section">
            <label>Enter numbers (comma-separated):</label>
            <input type="text" name="numbers" value="<?php echo array_key_exists('numbers', $_POST) ? safeOutput($_POST['numbers']) : ''; ?>">
        </div>

        <div class="section">
            <label>Enter names (comma-separated):</label>
            <input type="text" name="names" value="<?php echo array_key_exists('names', $_POST) ? safeOutput($_POST['names']) : ''; ?>">
        </div>

        <input type="submit" name="submit_all" value="Submit">
    </form>

<?php
if (array_key_exists('submit_all', $_POST)) {
    echo '<div class="result">';

    if ($_POST['hurdles'] !== '' && $_POST['jump_height'] !== '') {
        $hurdles = parseCSV($_POST['hurdles']);
        $jumpHeight = (int)$_POST['jump_height'];
        $canJump = hurdleJump($hurdles, $jumpHeight);
        echo "<strong>Hurdle Jump Result:</strong> " . ($canJump ? "✅ Can jump all hurdles" : "❌ Cannot jump all hurdles");
    } elseif ($_POST['numbers'] !== '') {
        $numbers = parseCSV($_POST['numbers']);
        $second = secondLargest($numbers);
        echo "<strong>Second Largest Result:</strong> $second";
    } elseif ($_POST['names'] !== '') {
        $names = parseCSV($_POST['names']);
        $bobIndex = findBob($names);
        echo "<strong>Find 'Bob' Result:</strong> " . ($bobIndex === -1 ? "'Bob' not found" : "'Bob' found at index $bobIndex");
    } else {
        echo "<strong>Error:</strong> Please fill out at least one section.";
    }

    echo '</div>';
}
?>

</div>
</body>
</html>
