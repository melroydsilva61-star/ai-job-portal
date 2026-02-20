<?php
session_start();
include("includes/db.php");

$msg=""; $err="";

if(isset($_POST['register'])){
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,$_POST['password']);
  $role = mysqli_real_escape_string($conn,$_POST['role']);

  if(!in_array($role, ['employer','jobseeker'])) $role='jobseeker';

  $check = mysqli_query($conn,"SELECT id FROM users WHERE email='$email' LIMIT 1");
  if($check && mysqli_num_rows($check)>0){
    $err="Email already registered!";
  } else {
    mysqli_query($conn,"INSERT INTO users(name,email,password,role) 
                        VALUES('$name','$email','$password','$role')");
    $msg="Registered successfully! Now login.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register - AI Job Portal</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="auth-page">

<div class="auth-container">
  <div class="auth-box">
      <h2>Create Account 🚀</h2>
      <p class="auth-sub">Join our AI Job Portal</p>

      <?php if($msg) echo "<p class='success'>$msg</p>"; ?>
      <?php if($err) echo "<p class='error'>$err</p>"; ?>

      <form method="POST">

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role" required>
          <option value="">Select Role</option>
          <option value="jobseeker">Job Seeker</option>
          <option value="employer">Employer</option>
        </select>

        <button class="btn full-btn" type="submit" name="register">
          Create Account
        </button>
      </form>

      <p class="muted small-text">
        Already have an account?
        <a href="login.php">Login</a>
      </p>

  </div>
</div>

</body>
</html>