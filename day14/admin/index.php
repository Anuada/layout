<?php
session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();
$title = "Admin Dashboard";

// Fetch all users
$fetchData = $db->fetchData_user();

if (isset($_SESSION['accountId'])) {
    $admin = $db->getAllRecords('admin', ['accountId' => $_SESSION['accountId']]);
} else {
    header("Location: login.php");
    exit();
}

ob_start();
include "../viewer/topnav_admin.php";
$navbar = ob_get_clean();

ob_start();
?>

<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/admin_table.css">


<div class="container">
    <h1>All Users</h1>
    <?php if (!empty($fetchData)) : ?>
        <table class="user-table" aria-label="Users Table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Contact No.</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>

            </thead>
            <tbody>
                <?php foreach ($fetchData as $user) : ?>
                    <tr>
                        <td><?= htmlspecialchars($user['fname'] . ' ' . $user['lname']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['contactNo']) ?></td>
                        <td><?= htmlspecialchars($user['address']) ?></td>
                        <td>
                            <a href="update.php?id=<?= $user['userId'] ?>" class="btn-edit">Update</a>
                            <a href="../controller/delete_user.php?id=<?= $user['accountId'] ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">
                                Delete
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No users found.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require_once "../viewer/layout.php";
?>