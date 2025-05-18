<?php session_start() ?>
<?php $title = "Forgot Password" ?>
<?php ob_start() ?>
<link rel="stylesheet" href="../assets/css/forgot.password.css">
<?php $styles = ob_get_clean() ?>
<?php ob_start() ?>

<div class="container">
    <section class="row">
        <section class="col">
            <div class="container">
                <div class="row justify-content-center pt-20">
                    <div class="col-md-6 fp-container bg-bubble-gum p-4 rounded w-form mb-20 shadow-sm">
                        <h2 class="text-center mb-4 fuchsia">Forgot Password</h2>
                        <form action="../logic/forgot-password.php" method="post">
                            <p class="form-group">
                                <label for="email" class="fuchsia">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your Email">
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
<?php require_once "../shared/layout.php" ?>