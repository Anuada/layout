<?php
session_start();
require_once "../models/DbHelper.php";
$db = new DbHelper();
$title = "Update User";
$user = $db->getRecord("users", ["userId" => $_GET["id"]]);

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}
ob_start();
include "../viewer/topnav_users.php";
$navbar = ob_get_clean();

ob_start();
?>

<link rel="stylesheet" href="../assets/css/update_form.css">
<div class="container">
    <h1>Update User</h1>

    <form action="../controller/update_profile_user_side.php" method="post" class="user-form">
        <input type="hidden" name="userId" value="<?php echo $user["userId"] ?>">

        <div class="form-group">
            <label for="fname">First Name:</label>
            <input type="text" id="fname" name="fname" value="<?php echo $user["fname"] ?>" required>

        </div>

        <div class="form-group">
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" name="lname" value="<?php echo $user["lname"] ?>" required>
        </div>

        <div class="form-group">
            <label for="contactNo">Contact Number:</label>
            <input type="text" id="contactNo" name="contactNo" value="<?php echo $user["contactNo"] ?>" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" required><?= htmlspecialchars($user['address']) ?></textarea>
        </div>

        <div class="form-actions" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <button type="submit" name="submit" class="btn-submit">Update User</button>
            <button type="button" id="openModalBtn" class="btn-secondary">Edit Credentials</button>
        </div>
    </form>
</div>

<!-- Modal -->
<div id="updateModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Update Account Info</h2>
        <form action="../controller/credentials_update_user_side.php" method="post">
            <input type="hidden" name="accountId" value="<?= htmlspecialchars($user['accountId']) ?>">

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" name="password" id="password">
                <small>Leave blank if you don't want to change it.</small>
            </div>

            <div class="form-actions">
                <button type="submit" name="submit" class="btn-submit">Update Credentials</button>
                <button type="button" class="btn-cancel" id="closeModalBtn">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Styles and Script -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 10% auto;
        padding: 30px;
        border-radius: 10px;
        width: 50%;
        position: relative;
    }

    .close-btn {
        color: #aaa;
        float: right;
        font-size: 28px;
        cursor: pointer;
    }

    .close-btn:hover {
        color: red;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>

<script>
    document.getElementById("openModalBtn").onclick = function () {
        document.getElementById("updateModal").style.display = "block";
    };
    document.getElementById("closeModalBtn").onclick = function () {
        document.getElementById("updateModal").style.display = "none";
    };
    document.querySelector(".close-btn").onclick = function () {
        document.getElementById("updateModal").style.display = "none";
    };
    window.onclick = function (event) {
        if (event.target == document.getElementById("updateModal")) {
            document.getElementById("updateModal").style.display = "none";
        }
    };
</script>

<?php
$content = ob_get_clean();
require_once "../viewer/layout.php";
?>
