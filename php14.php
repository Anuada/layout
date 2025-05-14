<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Challenges</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
        }
        .challenge {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h2 {
            color: #3498db;
            margin-top: 0;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        input[type="text"], input[type="number"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #2980b9;
        }
        .result {
            margin-top: 15px;
            padding: 10px;
            background-color: #e8f4fc;
            border-radius: 4px;
            border-left: 4px solid #3498db;
        }
        .note {
            font-size: 0.9em;
            color: #7f8c8d;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>PHP Challenges</h1>
    
    <?php
    // Function to solve Challenge 1: Euclidean Algorithm
    function euclidean($a, $b) {
        if ($a < $b) {
            return euclidean($b, $a);
        }
        $r = $a % $b;
        if ($r == 0) {
            return $b;
        }
        return euclidean($b, $r);
    }

    // Function to solve Challenge 2: Prime Divisors
    function primeDivisors($n) {
        $divisors = [];
        if ($n == 1) return $divisors;
        
        // Check for divisibility by 2
        if ($n % 2 == 0) {
            $divisors[] = 2;
            while ($n % 2 == 0) {
                $n = $n / 2;
            }
        }
        
        // Check for odd divisors up to sqrt(n)
        for ($i = 3; $i * $i <= $n; $i += 2) {
            if ($n % $i == 0) {
                $divisors[] = $i;
                while ($n % $i == 0) {
                    $n = $n / $i;
                }
            }
        }
        
        // If remaining n is a prime > 2
        if ($n > 2) {
            $divisors[] = $n;
        }
        
        return $divisors;
    }

    // Function to solve Challenge 3: Unique Number
    function unique($arr) {
        $count = [];
        foreach ($arr as $num) {
            $key = (string)$num;
            if (!isset($count[$key])) {
                $count[$key] = 0;
            }
            $count[$key]++;
        }
        
        foreach ($count as $num => $c) {
            if ($c == 1) {
                // Return as number (handle both int and float cases)
                return strpos($num, '.') !== false ? (float)$num : (int)$num;
            }
        }
        
        return null;
    }

    // Function to solve Challenge 4: Expanded Notation
    function expand($num) {
        $str = (string)$num;
        $length = strlen($str);
        $parts = [];
        
        for ($i = 0; $i < $length; $i++) {
            $digit = $str[$i];
            if ($digit == '0') continue;
            
            $zeros = $length - $i - 1;
            $part = $digit . str_repeat('0', $zeros);
            $parts[] = $part;
        }
        
        return implode(' + ', $parts);
    }

    // Function to solve Challenge 5: No Yelling
    function noYelling($str) {
        // Check if the last character is ? or !
        $lastChar = substr($str, -1);
        if ($lastChar == '?' || $lastChar == '!') {
            // Find how many of the same punctuation marks are at the end
            $i = strlen($str) - 1;
            $count = 0;
            while ($i >= 0 && $str[$i] == $lastChar) {
                $count++;
                $i--;
            }
            
            if ($count > 1) {
                // Remove the extra punctuation marks
                $str = substr($str, 0, strlen($str) - $count + 1);
            }
        }
        
        return $str;
    }

    // Process form submissions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $challenge = $_POST['challenge'] ?? '';
        
        switch ($challenge) {
            case '1':
                $a = (int)$_POST['euclidean_a'];
                $b = (int)$_POST['euclidean_b'];
                $result = euclidean($a, $b);
                break;
                
            case '2':
                $num = (int)$_POST['prime_num'];
                $result = primeDivisors($num);
                $result = '[' . implode(', ', $result) . ']';
                break;
                
            case '3':
                $input = $_POST['unique_input'];
                // Parse the array input
                $arr = array_map(function($item) {
                    return is_numeric($item) ? (strpos($item, '.') !== false ? (float)$item : (int)$item) : $item;
                }, explode(',', $input));
                $result = unique($arr);
                break;
                
            case '4':
                $num = (int)$_POST['expand_num'];
                $result = '"' . expand($num) . '"';
                break;
                
            case '5':
                $str = $_POST['no_yelling'];
                $result = '"' . noYelling($str) . '"';
                break;
                
            default:
                $result = 'Invalid challenge selected';
        }
    }
    ?>
    
    <!-- Challenge 1: Euclidean Algorithm -->
    <div class="challenge">
        <h2>1. Euclidean Algorithm (GCD)</h2>
        <form method="post">
            <input type="hidden" name="challenge" value="1">
            <div>
                <label for="euclidean_a">First number (a):</label>
                <input type="number" id="euclidean_a" name="euclidean_a" min="1" required>
            </div>
            <div>
                <label for="euclidean_b">Second number (b):</label>
                <input type="number" id="euclidean_b" name="euclidean_b" min="1" required>
            </div>
            <button type="submit">Calculate GCD</button>
        </form>
        <?php if (isset($result) && $_POST['challenge'] == '1'): ?>
            <div class="result">
                <strong>Result:</strong> <?php echo htmlspecialchars($result); ?>
            </div>
        <?php endif; ?>
        <p class="note">Note: Returns the greatest common divisor of two numbers using the Euclidean Algorithm.</p>
    </div>
    
    <!-- Challenge 2: Prime Divisors -->
    <div class="challenge">
        <h2>2. Prime Divisors</h2>
        <form method="post">
            <input type="hidden" name="challenge" value="2">
            <div>
                <label for="prime_num">Number:</label>
                <input type="number" id="prime_num" name="prime_num" min="1" required>
            </div>
            <button type="submit">Find Prime Divisors</button>
        </form>
        <?php if (isset($result) && $_POST['challenge'] == '2'): ?>
            <div class="result">
                <strong>Result:</strong> <?php echo htmlspecialchars($result); ?>
            </div>
        <?php endif; ?>
        <p class="note">Note: Returns all prime divisors of a number in an array.</p>
    </div>
    
    <!-- Challenge 3: Unique Number -->
    <div class="challenge">
        <h2>3. Unique Number</h2>
        <form method="post">
            <input type="hidden" name="challenge" value="3">
            <div>
                <label for="unique_input">Array of numbers (comma separated):</label>
                <input type="text" id="unique_input" name="unique_input" required 
                       placeholder="e.g., 3, 3, 3, 7, 3, 3">
            </div>
            <button type="submit">Find Unique Number</button>
        </form>
        <?php if (isset($result) && $_POST['challenge'] == '3'): ?>
            <div class="result">
                <strong>Result:</strong> <?php echo htmlspecialchars($result); ?>
            </div>
        <?php endif; ?>
        <p class="note">Note: Returns the unique number in an array where all other numbers are the same.</p>
    </div>
    
    <!-- Challenge 4: Expanded Notation -->
    <div class="challenge">
        <h2>4. Expanded Notation</h2>
        <form method="post">
            <input type="hidden" name="challenge" value="4">
            <div>
                <label for="expand_num">Number:</label>
                <input type="number" id="expand_num" name="expand_num" min="1" required>
            </div>
            <button type="submit">Expand Number</button>
        </form>
        <?php if (isset($result) && $_POST['challenge'] == '4'): ?>
            <div class="result">
                <strong>Result:</strong> <?php echo htmlspecialchars($result); ?>
            </div>
        <?php endif; ?>
        <p class="note">Note: Returns the number in expanded notation (e.g., 13 becomes "10 + 3").</p>
    </div>
    
    <!-- Challenge 5: No Yelling -->
    <div class="challenge">
        <h2>5. No Yelling</h2>
        <form method="post">
            <input type="hidden" name="challenge" value="5">
            <div>
                <label for="no_yelling">Sentence:</label>
                <input type="text" id="no_yelling" name="no_yelling" required 
                       placeholder="e.g., What went wrong?????????">
            </div>
            <button type="submit">Fix Punctuation</button>
        </form>
        <?php if (isset($result) && $_POST['challenge'] == '5'): ?>
            <div class="result">
                <strong>Result:</strong> <?php echo htmlspecialchars($result); ?>
            </div>
        <?php endif; ?>
        <p class="note">Note: Reduces multiple ? or ! at the end of a sentence to just one.</p>
    </div>
</body>
</html>