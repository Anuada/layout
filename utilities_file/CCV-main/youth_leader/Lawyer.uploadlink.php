<?php
session_start();
include "../shared/session.lawyer.php";
require_once "../util/DbHelper.php";
require_once "../util/DirHandler.php";

$dh = new DirHandler();
$db = new DbHelper();
$title = "Women";

ob_start();
include "../shared/navbar.lawyer.php";
?>
<?php
$uploadedLink = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadedLink = $_POST["link"];

    echo "<p>The link <strong>" . htmlspecialchars($uploadedLink) . "</strong> has been uploaded.</p>";
}
?>
<link rel="stylesheet" href="../assets/css/landing.page.css">
<link rel="stylesheet" href="../assets/css/login.css">
<link rel="stylesheet" href="../assets/css/submitlink.css">

<?php $navbar = ob_get_clean(); ?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="link">Enter a link to upload:</label>
    <br>
    <input type="url" name="link" id="link" required>
    <br>
    <button type="submit" class="button button1">Submit the link here!</button>
</form>

<?php
$content = ob_get_clean();

ob_start();
?>
<script src="../assets/js/navbar.js"></script>
<?php $scripts = ob_get_clean();

require_once "../shared/layout.php";
?>