<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Loop Exercises</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(to right, #8360c3, #2ebf91);
      color: white;
      padding: 30px;
    }
    h1, h2 {
      text-align: center;
    }
    section {
      background: rgba(0, 0, 0, 0.3);
      padding: 20px;
      border-radius: 15px;
      margin-bottom: 30px;
    }
    input[type=text], input[type=number] {
      padding: 10px;
      margin: 10px 0;
      border: none;
      border-radius: 5px;
      width: 80%;
    }
    input[type=submit] {
      padding: 10px 20px;
      background-color: #2ebf91;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    pre {
      background: rgba(255, 255, 255, 0.1);
      padding: 10px;
      border-radius: 10px;
      white-space: pre-wrap;
    }
  </style>
</head>
<body>
  <h1>PHP Loop Exercises</h1>

  <!-- 1. Longest Common Ending -->
  <section>
    <h2>1. Longest Common Ending</h2>
    <form method="post">
      <input type="text" name="str1" placeholder="Enter first string">
      <input type="text" name="str2" placeholder="Enter second string">
      <input type="submit" name="ending_btn" value="Find Ending">
    </form>
    <pre>
<?php
if (isset($_POST['ending_btn'])) {
  $str1 = $_POST['str1'];
  $str2 = $_POST['str2'];
  $res = "";
  $i = strlen($str1) - 1;
  $j = strlen($str2) - 1;
  while ($i >= 0 && $j >= 0 && $str1[$i] === $str2[$j]) {
    $res = $str1[$i] . $res;
    $i--;
    $j--;
  }
 
  echo "Longest Common Ending: " . $res;

}
?>
    </pre>
  </section>

  <!-- 2. Construct & Deconstruct -->
  <section>
    <h2>2. Construct & Deconstruct</h2>
    <form method="post">
      <input type="text" name="build_str" placeholder="Enter string to construct/deconstruct">
      <input type="submit" name="construct_btn" value="Build & Deconstruct">
    </form>
    <pre>
<?php
if (isset($_POST['construct_btn'])) {
  $text = $_POST['build_str'];
  $length = strlen($text);
  $output = [];
  for ($i = 1; $i <= $length; $i++) {
    $temp = "";
    for ($j = 0; $j < $i; $j++) {
      $temp .= $text[$j];
    }
    $output[] = $temp;
  }
  for ($i = $length - 1; $i > 0; $i--) {
    $temp = "";
    for ($j = 0; $j < $i; $j++) {
      $temp .= $text[$j];
    }
    $output[] = $temp;
  }
  foreach ($output as $line) {
    echo "$line\n";
  }
}
?>
    </pre>
  </section>

  <!-- 3. Multiplication Table -->
  <section>
    <h2>3. Multiplication Table (1-15)</h2>
    <pre>
<?php
for ($i = 1; $i <= 15; $i++) {
  for ($j = 1; $j <= 15; $j++) {
    printf("%4d", $i * $j);
  }
  echo "\n";
}
?>
    </pre>
  </section>

  <!-- 4. Prime Check -->
  <section>
    <h2>4. Prime Number Checker</h2>
    <form method="post">
      <input type="number" name="prime_num" placeholder="Enter a number">
      <input type="submit" name="prime_btn" value="Check Prime">
    </form>
    <pre>
<?php
if (isset($_POST['prime_btn'])) {
  $num = $_POST['prime_num'];
  $isPrime = true;
  if ($num <= 1) {
    $isPrime = false;
  } else {
    for ($i = 2; $i < $num; $i++) {
      if ($num % $i == 0) {
        $isPrime = false;
        break;
      }
    }
  }
  echo $isPrime ? "$num is a prime number." : "$num is NOT a prime number.";
}
?>
    </pre>
  </section>

  <!-- 5. Sum of Digits -->
  <section>
    <h2>5. Sum of Digits</h2>
    <form method="post">
      <input type="number" name="sum_digits" placeholder="Enter a number">
      <input type="submit" name="sum_btn" value="Sum Digits">
    </form>
    <pre>
<?php
if (isset($_POST['sum_btn'])) {
  $num = $_POST['sum_digits'];
  $original = $num;
  $sum = 0;
  while ($num > 0) {
    $digit = $num % 10;
    $sum += $digit;
    $num = ($num - $digit) / 10;
  }
  echo "The sum of the digits of $original is $sum.";
}
?>
    </pre>
  </section>
</body>
</html>
