<?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = $_POST["name"];
//     $birthdate = $_POST["birthdate"];
//     $age = $_POST["age"];
//     $contact = $_POST["contact"];
//     $email = $_POST["email"];
//     $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password for security

//     $userData = "$name|$birthdate|$age|$contact|$email|$password\n";

//     file_put_contents("./util/users.txt", $userData, FILE_APPEND);
//     echo "Registration successful! <a href='login.php'>Login here</a>";
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $birthdate = $_POST["birthdate"];
    $age = $_POST["age"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $password = $_POST["password"]; // ❗ No hash here (plain text)

    $userData = "$name|$birthdate|$age|$contact|$email|$password\n";

    file_put_contents("./util/users.txt", $userData, FILE_APPEND);
    echo "Registration successful! <a href='login.php'>Login here</a>";
}
?>

<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Applicant Training System</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
  body {
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-color: #e6f2fb;
    color: #000;
  }
  header {
    background-color: #2196f3;
    padding: 10px 15px;
    font-size: 18px;
  }
  main {
    padding: 15px;
    max-width: 480px;
  }
  h2 {
    font-weight: 600;
    font-size: 16px;
    margin: 0 0 10px 0;
  }
  label {
    display: block;
    font-size: 14px;
    margin-bottom: 4px;
  }
  input[type="text"],
  input[type="email"],
  input[type="password"],
  input[type="date"],
  input[type="number"] {
    width: 100%;
    padding: 8px 10px;
    font-size: 14px;
    border: 1px solid #d1d9e6;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 15px;
    background-color: #fff;
  }
  input[type="date"] {
    font-family: 'Roboto', sans-serif;
  }
  button {
    background-color: #2196f3;
    border: none;
    color: white;
    padding: 8px 15px;
    font-size: 14px;
    border-radius: 4px;
    cursor: pointer;
  }
  a.login-link {
    display: inline-block;
    margin-top: 8px;
    font-size: 14px;
    color: #2196f3;
    text-decoration: none;
  }
  a.login-link:hover {
    text-decoration: underline;
  }
  @media (max-width: 480px) {
    main {
      padding: 10px;
    }
  }
</style>
</head>
<body>
<header>Applicant Training System</header>
<main>
  <h2>Day 10 - Weekly Activity</h2>
  <form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter Name" />
    <label for="birthdate">BirthDate:</label>
    <input type="date" id="birthdate" name="birthdate" />
    <label for="age">Age:</label>
    <input type="text" id="age" name="age" placeholder="Enter Age" />
    <label for="contact">Contact No:</label>
    <input type="text" id="contact" name="contact" placeholder="Enter Age" />
    <label for="email">Email address</label>
    <input type="email" id="email" name="email" placeholder="Enter email" />
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Enter Password" />
    <button type="submit">Register</button>
  </form>
  <a href="login.php" class="login-link">Login</a>
</main>
</body>
</html>


<!-- <form method="POST" action="">
    <h2>Register</h2>
    Name: <input type="text" name="name" required><br>
    Birthdate: <input type="date" name="birthdate" required><br>
    Age: <input type="number" name="age" required><br>
    Contact Number: <input type="text" name="contact" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form> -->
