<?php
session_start();
require_once "../util/DbHelper.php";
$db = new DbHelper();

if ((isset($_GET["accountId"]) && isset($_GET["token"])) && (!empty(trim($_GET["accountId"])) && !empty(trim($_GET["token"])))) {
    $account = $db->fetchRecords("account", ["accountId" => $_GET["accountId"], "recovery_token" => $_GET["token"]]);
    if ($account == null) {
        $_SESSION["m"] = "Token Not Found!";
        header("Location: ../page/");
        exit();
    }
} else {
    $_SESSION["m"] = "Parameter Not Found!";
    header("Location: ../page/");
    exit();
}
?>

<?php $title = "Reset Password" ?>
<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/reset.password.css">
<?php $styles = ob_get_clean() ?>

<?php ob_start() ?>

<div class="container">
    <section class="row">
        <section class="col">
            <div class="container">
                <div class="row justify-content-center pt-20">
                    <div class="col-md-6 rp-container bg-bubble-gum p-4 rounded w-form mb-20 shadow-sm">
                        <h2 class="text-center mb-4 fuchsia">Reset Password</h2>
                        <form action="../logic/reset-password.php" method="post">
                            <input type="hidden" name="accountId" id="accountId">
                            <input type="hidden" name="token" id="token">
                            <p class="form-group">
                                <label for="password" class="fuchsia">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your Password">
                            </p>
                            <p class="form-group">
                                <label for="re-password" class="fuchsia">Confirm Password</label>
                                <input type="password" class="form-control" id="re-password" name="re-password"
                                    placeholder="Re-Enter your Password">
                            </p>
                            <p class="form-group pt-1">
                                <button type="submit" name="submit" class="btn bg-fuchsia text-white"
                                    style="width: 100%">Submit</button>
                            <p class="text-muted text-center">Back To <a href="./login.php" class="fuchsia"
                                    style="text-decoration:none">Login</a></p>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- Logo -->
        <section class="col">
            <div class="d-flex justify-content-center align-items-center text-center pt-40">
                <a href="./"><img src="../assets/img/logo/ElevateHer_Logo_Bold_Shadow.png" alt="ElevateHer"></a>
            </div>
            <p class="text-center fs-4 fuchsia pt-4">
                Empower, Educate, Elevate...
            </p>
        </section>
    </section>
</div>

<?php $content = ob_get_clean() ?>

<?php ob_start() ?>

<?php if (isset($_GET["accountId"]) && isset($_GET["token"])): ?>
    <script>
        document.getElementById("accountId").value = "<?php echo $_GET["accountId"] ?>";
        document.getElementById("token").value = "<?php echo $_GET["token"] ?>";
    </script>
<?php endif; ?>

<?php $scripts = ob_get_clean() ?>

<?php require_once "../shared/layout.php" ?>