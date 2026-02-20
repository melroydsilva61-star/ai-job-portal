<?php
session_start();
include("includes/db.php");

$error = "";

if(isset($_POST['login'])){
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  $q = "SELECT * FROM users WHERE email='$email' AND password='$password' LIMIT 1";
  $res = mysqli_query($conn,$q);

  if($res && mysqli_num_rows($res)===1){
    $u = mysqli_fetch_assoc($res);
    $_SESSION['user_id']=$u['id'];
    $_SESSION['role']=$u['role'];
    $_SESSION['name']=$u['name'];

    if($u['role']==='admin') header("Location: admin/dashboard.php");
    elseif($u['role']==='employer') header("Location: employer/dashboard.php");
    else header("Location: jobseeker/dashboard.php");
    exit;
  } else {
    $error="Invalid email or password!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - AI Job Portal</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="auth-page">

<div class="auth-container">
  <div class="auth-box">
      <h2>Welcome Back 👋</h2>
      <p class="auth-sub">Login to your account</p>

      <?php if($error) echo "<p class='error'>$error</p>"; ?>

      <form method="POST">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>

        <button class="btn full-btn" type="submit" name="login">
          Login
        </button>
      </form>

      <p class="muted small-text">
        Don't have an account?
        <a href="register.php">Register</a>
      </p>
  </div>
</div>

</body>
</html>