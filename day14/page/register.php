<?php
session_start();
ob_start();
?>
<link rel="stylesheet" href="../assets/css/register.css">
<?php $styles = ob_get_clean(); ?>

<?php ob_start(); ?>
<div class="container" role="main">
  <h1 class="title-top">Applicant Training Guide</h1>
  <h2 class="title-bottom">SYSTEM</h2>

  <form action="../controller/signup.php" method="POST">

    <section>
      <h3>Basic Information</h3>

      <label for="fname">First Name</label>
      <input type="text" id="fname" name="fname" placeholder="Enter first name" autocomplete="off" required />

      <label for="lname">Last Name</label>
      <input type="text" id="lname" name="lname" placeholder="Enter last name" autocomplete="off" required />

      <label for="contact">Contact No.</label>
      <input type="text" id="contact" name="contact" placeholder="Enter contact number" autocomplete="off" required />

      <label for="address">Address</label>
      <input type="text" id="address" name="address" placeholder="Enter address" autocomplete="off" required />

      <label for="email">Email</label>
      <input type="text" id="email" name="email" placeholder="Enter email address" autocomplete="off" required />

      <label for="user_type">User Type</label>
      <select id="user_type" name="user_type" aria-label="User Type" required>
        <option value="users" selected>users</option>
        <option value="admin">Admin</option>
      </select>
    </section>

    <section style="margin-top: 20px;">
      <h3>Login Credential</h3>

      <label for="username">Username</label>
      <input type="text" id="username" name="username" placeholder="Enter username" autocomplete="off" required />

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter password" autocomplete="off" required />

      <label for="con_password">Confirm Password</label>
      <input type="password" id="con_password" name="con_password" placeholder="Confirm password" autocomplete="off" required />
    </section>

    <button type="submit" name="signup">Sign Up</button>
    <p style="margin-top: 20px; text-align: center; font-size: 14px;">
          Do you have already account?
            <a href="../page/" style="color: #007bff; text-decoration: none;">
             Login here
            </a>
        </p>


  </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php require_once "../viewer/layout.php"; ?>