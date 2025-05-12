<?php

//Hash password

// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     $email = trim($_POST["email"]);
//     $password = trim($_POST["password"]);

//     $lines = file("./util/users.txt");

//     foreach ($lines as $line) {
//         $data = explode("|", trim($line));

//         list($name, $birthdate, $age, $contact, $storedEmail, $hashedPassword) = $data;

//         if ($email === $storedEmail && password_verify($password, $hashedPassword)) {
//             $_SESSION["user_email"] = $storedEmail;
//             header("Location: landing.php?name=" . urlencode($name));
//             exit;
//         }
//     }

//     echo "<p style='color:red;'>Invalid email or password.</p>";
// }

// PlainText password ->

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $lines = file("./util/users.txt");

    foreach ($lines as $line) {
        $data = explode("|", trim($line));

        list($name, $birthdate, $age, $contact, $storedEmail, $storedPassword) = $data;

        if ($email === $storedEmail && $password === $storedPassword) {
            $_SESSION["user_email"] = $storedEmail;
            header("Location: landing.php?name=" . urlencode($name));
            exit;
        }
    }

    echo "<p style='color:red;'>Invalid email or password.</p>";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
    }
    body {
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #e6f2fb;
      color: #000;
    }
    header {
      background-color: #0078e7;
      padding: 12px 20px;
      font-size: 16px;
      font-weight: 500;
      color: #000;
    }
    main {
      padding: 20px;
      max-width: 480px;
    }
    h2 {
      font-weight: 700;
      font-size: 16px;
      margin: 0 0 12px 0;
    }
    label {
      display: block;
      font-size: 14px;
      margin-bottom: 6px;
    }
    input[type="email"],
    input[type="password"] {
      width: 100%;
      max-width: 320px;
      padding: 8px 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 2px;
      margin-bottom: 16px;
      font-family: 'Roboto', sans-serif;
    }
    button {
      background-color: #0078e7;
      border: none;
      color: #fff;
      padding: 8px 16px;
      font-size: 14px;
      border-radius: 3px;
      cursor: pointer;
      font-family: 'Roboto', sans-serif;
    }
    a.register-link {
      display: inline-block;
      margin-top: 6px;
      font-size: 14px;
      color: #3a7bd5;
      text-decoration: none;
      font-weight: 400;
    }
    a.register-link:hover {
      text-decoration: underline;
    }
    @media (max-width: 480px) {
      main {
        padding: 16px 12px;
      }
      input[type="email"],
      input[type="password"] {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<pre>
<?php
// Show users.txt contents
$lines = file("./util/users.txt");
foreach ($lines as $line) {
    $data = explode("|", trim($line));
    print_r($data);
    echo "\n";
}
?>
</pre>

<header>Applicant Training System</header>
<main>
<div class="activity-title">Day 10 - Weekly Activity</div>
<form method="POST" action="">
      <label for="email">Email address</label>
      <input type="email" id="email" name="email" placeholder="Enter email" />
      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter Password" />
      <br>
      <button type="submit">Login</button><br/>
      <a href="php11.php" class="register-link">Register</a>
    </form>

</main>
</body>
</html>

