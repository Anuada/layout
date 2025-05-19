<?php
session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();
$title = "Update User";

$user = $db->getRecord("todo_list", ["userId" => $_GET["id"]]);

// Define enum values manually
$statusOptions = ['Pending', 'InProgress', 'Completed'];

ob_start();
include "../viewer/topnav_admin.php";
$navbar = ob_get_clean();

ob_start();
?>

<link rel="stylesheet" href="../assets/css/view_task.css">
<div class="container">
    <h1>Update User</h1>

    <?php if ($user): ?>
    <form method="post" action="../controller/update_status.php">
        <input type="hidden" name="userId" value="<?= htmlspecialchars($_GET['id']) ?>">
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
                    <td>
                        <select name="status">
                            <?php foreach ($statusOptions as $status): ?>
                                <option value="<?= $status ?>" <?= $user['status'] == $status ? 'selected' : '' ?>>
                                    <?= $status ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <button type="submit" name="submit">Update Status</button>
    </form>
    <?php else: ?>
        <p>No record found.</p>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
require_once "../viewer/layout.php";
?>
