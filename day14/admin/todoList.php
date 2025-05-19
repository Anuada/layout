<?php
session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();
$title = "Update User";
$user = $db->getRecord("users", ["userId" => $_GET["id"]]);

ob_start();
include "../viewer/topnav_admin.php";
$navbar = ob_get_clean();

ob_start();
?>

<link rel="stylesheet" href="../assets/css/update_form.css">
<div class="container">
    <h1>Update User</h1>

    <form action="../controller/todoList.php" method="post" class="user-form">
        <input type="hidden" name="userId" value="<?php echo $user["userId"] ?>">

        <div class="form-group">
            <label for="task">TASK:</label>
            <input type="text" id="task" name="task" required>

        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" required>
        </div>


        <div class="form-actions" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <button type="submit" name="submit" class="btn-submit">Update User</button>

        </div>
    </form>
</div>

<?php
$content = ob_get_clean();
require_once "../viewer/layout.php";
?>