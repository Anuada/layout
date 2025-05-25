<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Challenges</title>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2980b9;
            --background-color: #f5f7fa;
            --card-color: #ffffff;
            --text-color: #333333;
            --border-color: #e0e0e0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: var(--background-color);
            color: var(--text-color);
        }
        
        .container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Navigation */
        .sidebar {
            width: 250px;
            background-color: var(--card-color);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            padding: 20px 0;
        }
        
        .sidebar-header {
            padding: 0 20px 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .sidebar-header h1 {
            margin: 0;
            color: var(--primary-color);
            font-size: 1.5rem;
        }
        
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-item {
            margin: 5px 0;
        }
        
        .nav-link {
            display: block;
            padding: 12px 20px;
            color: var(--text-color);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: rgba(52, 152, 219, 0.1);
            border-left: 4px solid var(--primary-color);
            color: var(--primary-color);
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
        }
        
        .challenge-card {
            background-color: var(--card-color);
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            padding: 25px;
            margin-bottom: 25px;
            display: none;
        }
        
        .challenge-card.active {
            display: block;
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .challenge-title {
            color: var(--primary-color);
            margin-top: 0;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 500px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        label {
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--text-color);
        }
        
        input[type="text"], 
        input[type="number"],
        textarea {
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 1rem;
            transition: border 0.3s;
        }
        
        input[type="text"]:focus, 
        input[type="number"]:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
        }
        
        button {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: background-color 0.3s;
            align-self: flex-start;
        }
        
        button:hover {
            background-color: var(--secondary-color);
        }
        
        .result-container {
            margin-top: 20px;
            padding: 15px;
            background-color: rgba(52, 152, 219, 0.05);
            border-radius: 4px;
            border-left: 4px solid var(--primary-color);
        }
        
        .result-title {
            font-weight: 600;
            margin-top: 0;
            margin-bottom: 10px;
            color: var(--primary-color);
        }
        
        .result-content {
            margin: 0;
            white-space: pre-wrap;
        }
        
        .note {
            font-size: 0.9rem;
            color: #666;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed var(--border-color);
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            
            .nav-menu {
                display: flex;
                overflow-x: auto;
                padding: 0 10px;
                white-space: nowrap;
            }
            
            .nav-item {
                display: inline-block;
                margin: 0 5px;
            }
            
            .nav-link {
                padding: 10px 15px;
                border-left: none;
                border-bottom: 3px solid transparent;
            }
            
            .nav-link:hover, .nav-link.active {
                border-left: none;
                border-bottom: 3px solid var(--primary-color);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h1>PHP Challenges</h1>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link active" data-target="challenge1">1. Euclidean Algorithm</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-target="challenge2">2. Prime Divisors</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-target="challenge3">3. Unique Number</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-target="challenge4">4. Expanded Notation</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-target="challenge5">5. No Yelling</a>
                </li>
            </ul>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
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
                        $result = json_encode($result);
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
                        $result = expand($num);
                        break;
                        
                    case '5':
                        $str = $_POST['no_yelling'];
                        $result = noYelling($str);
                        break;
                        
                    default:
                        $result = 'Invalid challenge selected';
                }
            }
            ?>
            
            <!-- Challenge 1: Euclidean Algorithm -->
            <div class="challenge-card active" id="challenge1">
                <h2 class="challenge-title">1. Euclidean Algorithm (GCD)</h2>
                <form method="post">
                    <input type="hidden" name="challenge" value="1">
                    <div class="form-group">
                        <label for="euclidean_a">First number (a):</label>
                        <input type="number" id="euclidean_a" name="euclidean_a" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="euclidean_b">Second number (b):</label>
                        <input type="number" id="euclidean_b" name="euclidean_b" min="1" required>
                    </div>
                    <button type="submit">Calculate GCD</button>
                </form>
                <?php if (isset($result) && ($_POST['challenge'] ?? '') == '1'): ?>
                    <div class="result-container">
                        <h3 class="result-title">Result</h3>
                        <p class="result-content"><?php echo htmlspecialchars($result); ?></p>
                    </div>
                <?php endif; ?>
                <p class="note">Returns the greatest common divisor of two numbers using the Euclidean Algorithm.</p>
            </div>
            
            <!-- Challenge 2: Prime Divisors -->
            <div class="challenge-card" id="challenge2">
                <h2 class="challenge-title">2. Prime Divisors</h2>
                <form method="post">
                    <input type="hidden" name="challenge" value="2">
                    <div class="form-group">
                        <label for="prime_num">Number:</label>
                        <input type="number" id="prime_num" name="prime_num" min="1" required>
                    </div>
                    <button type="submit">Find Prime Divisors</button>
                </form>
                <?php if (isset($result) && ($_POST['challenge'] ?? '') == '2'): ?>
                    <div class="result-container">
                        <h3 class="result-title">Result</h3>
                        <p class="result-content"><?php echo htmlspecialchars($result); ?></p>
                    </div>
                <?php endif; ?>
                <p class="note">Returns all prime divisors of a number in an array.</p>
            </div>
            
            <!-- Challenge 3: Unique Number -->
            <div class="challenge-card" id="challenge3">
                <h2 class="challenge-title">3. Unique Number</h2>
                <form method="post">
                    <input type="hidden" name="challenge" value="3">
                    <div class="form-group">
                        <label for="unique_input">Array of numbers (comma separated):</label>
                        <input type="text" id="unique_input" name="unique_input" required 
                               placeholder="e.g., 3, 3, 3, 7, 3, 3">
                    </div>
                    <button type="submit">Find Unique Number</button>
                </form>
                <?php if (isset($result) && ($_POST['challenge'] ?? '') == '3'): ?>
                    <div class="result-container">
                        <h3 class="result-title">Result</h3>
                        <p class="result-content"><?php echo htmlspecialchars($result); ?></p>
                    </div>
                <?php endif; ?>
                <p class="note">Returns the unique number in an array where all other numbers are the same.</p>
            </div>
            
            <!-- Challenge 4: Expanded Notation -->
            <div class="challenge-card" id="challenge4">
                <h2 class="challenge-title">4. Expanded Notation</h2>
                <form method="post">
                    <input type="hidden" name="challenge" value="4">
                    <div class="form-group">
                        <label for="expand_num">Number:</label>
                        <input type="number" id="expand_num" name="expand_num" min="1" required>
                    </div>
                    <button type="submit">Expand Number</button>
                </form>
                <?php if (isset($result) && ($_POST['challenge'] ?? '') == '4'): ?>
                    <div class="result-container">
                        <h3 class="result-title">Result</h3>
                        <p class="result-content"><?php echo htmlspecialchars($result); ?></p>
                    </div>
                <?php endif; ?>
                <p class="note">Returns the number in expanded notation (e.g., 13 becomes "10 + 3").</p>
            </div>
            
            <!-- Challenge 5: No Yelling -->
            <div class="challenge-card" id="challenge5">
                <h2 class="challenge-title">5. No Yelling</h2>
                <form method="post">
                    <input type="hidden" name="challenge" value="5">
                    <div class="form-group">
                        <label for="no_yelling">Sentence:</label>
                        <input type="text" id="no_yelling" name="no_yelling" required 
                               placeholder="e.g., What went wrong?????????">
                    </div>
                    <button type="submit">Fix Punctuation</button>
                </form>
                <?php if (isset($result) && ($_POST['challenge'] ?? '') == '5'): ?>
                    <div class="result-container">
                        <h3 class="result-title">Result</h3>
                        <p class="result-content"><?php echo htmlspecialchars($result); ?></p>
                    </div>
                <?php endif; ?>
                <p class="note">Reduces multiple ? or ! at the end of a sentence to just one.</p>
            </div>
        </div>
    </div>

    <script>
        // Navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const challengeCards = document.querySelectorAll('.challenge-card');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links and cards
                    navLinks.forEach(l => l.classList.remove('active'));
                    challengeCards.forEach(card => card.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Show corresponding card
                    const targetId = this.getAttribute('data-target');
                    document.getElementById(targetId).classList.add('active');
                });
            });
            
            // Keep the correct tab active after form submission
            <?php if (isset($_POST['challenge'])): ?>
                const activeChallenge = 'challenge<?php echo $_POST['challenge']; ?>';
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('data-target') === activeChallenge) {
                        link.classList.add('active');
                    }
                });
                document.querySelectorAll('.challenge-card').forEach(card => {
                    card.classList.remove('active');
                    if (card.id === activeChallenge) {
                        card.classList.add('active');
                    }
                });
            <?php endif; ?>
        });
    </script>
</body>
</html>