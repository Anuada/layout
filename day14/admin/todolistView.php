<?php
session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();
$title = "Update User";

$user = $db->getRecord("todo_list", ["userId" => $_GET["id"]]);

ob_start();
include "../viewer/topnav_admin.php";
$navbar = ob_get_clean();

ob_start();
?>

<link rel="stylesheet" href="../assets/css/view_task.css">
<div class="container">
    <h1>Update User</h1>

    <?php if ($user): ?>
        <table>
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= htmlspecialchars($user['task']) ?></td>
                    <td><?= htmlspecialchars($user['description']) ?></td>
                    <td><?= htmlspecialchars($user['status']) ?></td>
                    
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>No record found.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require_once "../viewer/layout.php";
?>
