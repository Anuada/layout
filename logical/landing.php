<?php
session_start();

if (!isset($_SESSION["user_email"])) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION["user_email"];
$lines = file("./util/users.txt");

$userData = null;

foreach ($lines as $line) {
    list($name, $birthdate, $age, $contact, $storedEmail, $hashedPassword) = explode("|", trim($line));

    if ($email === $storedEmail) {
        $userData = [
            "Name" => $name,
            "Birthdate" => $birthdate,
            "Age" => $age,
            "Contact Number" => $contact,
            "Email" => $storedEmail
        ];
        break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
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
            background-color: #0084ff;
            padding: 10px 15px;
            font-size: 16px;
            color: #fff;
        }
        main {
            padding: 10px 15px 30px 15px;
        }
        .activity-title {
            font-weight: 700;
            margin: 10px 0 0 0;
            font-size: 14px;
        }
        .dashboard-subtitle {
            font-weight: 400;
            font-size: 13px;
            margin: 3px 0 10px 0;
        }
        .profile-container {
    background-color: #fff;
    border: 1px solid #d9e6f2;
    border-radius: 3px;
    padding: 15px 20px 20px 20px;
    width: 100%;
    margin: 0;
}
        .profile-header {
            font-size: 18px;
            font-weight: 500;
            color: #0084ff;
            margin-bottom: 15px;
        }
        .tabs {
            border-bottom: 1px solid #d9e6f2;
            margin-bottom: 15px;
        }
        .tab {
            display: inline-block;
            padding: 8px 15px;
            font-size: 13px;
            color: #555;
            border: 1px solid #d9e6f2;
            border-bottom: none;
            border-radius: 3px 3px 0 0;
            background-color: #fff;
            cursor: default;
            user-select: none;
        }
        .tab.active {
            color: #000;
            font-weight: 500;
        }
        .profile-info {
            width: 100%;
            border-collapse: collapse;
        }
        .profile-info tr {
            border-bottom: 1px solid #d9e6f2;
        }
        .profile-info td {
            padding: 10px 0;
            font-size: 13px;
            vertical-align: top;
        }
        .profile-info td.label {
            font-weight: 700;
            width: 140px;
        }
        .profile-info td.value {
            font-weight: 400;
            color: #555;
        }
        .logout {
            margin: 20px auto;
    
        }
        .logout form button {
            background-color: #0084ff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }
        .logout form button:hover {
            background-color: #006edc;
        }
        @media (max-width: 480px) {
            .profile-container {
                padding: 10px 10px 15px 10px;
            }
            .profile-info td.label {
                width: 110px;
                font-size: 12px;
            }
            .profile-info td.value {
                font-size: 12px;
            }
            header {
                font-size: 14px;
                padding: 8px 10px;
            }
            main {
                padding: 8px 10px 20px 10px;
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


<?php if ($userData): ?>
    <div class="profile-container">
    <div class="activity-title">Day 10 - Weekly Activity</div>
  <div class="dashboard-subtitle">User Dashboard</div>
        <div class="profile-header">User Profile Information</div>
        <div class="tabs" role="tablist">
            <div class="tab active" role="tab" aria-selected="true" tabindex="0">Basic Info</div>
        </div>
        <table class="profile-info" role="presentation">
            <tbody>
                <tr>
                    <td class="label">Full Name</td>
                    <td class="value"><?= htmlspecialchars($userData["Name"]) ?></td>
                </tr>
                <tr>
                    <td class="label">Birth Date</td>
                    <td class="value"><?= htmlspecialchars($userData["Birthdate"]) ?></td>
                </tr>
                <tr>
                    <td class="label">Age</td>
                    <td class="value"><?= htmlspecialchars($userData["Age"]) ?></td>
                </tr>
                <tr>
                    <td class="label">Contact No</td>
                    <td class="value"><?= htmlspecialchars($userData["Contact Number"]) ?></td>
                </tr>
                <tr>
                    <td class="label">Email Address</td>
                    <td class="value"><?= htmlspecialchars($userData["Email"]) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p style="text-align:center;">User data not found.</p>
<?php endif; ?>

<div class="logout">
<form method="POST" action="./logic/logout_logic.php">
    <button type="submit">Logout</button>
</form>

</div>
</main>

</body>
</html>
