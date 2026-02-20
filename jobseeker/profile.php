<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('jobseeker');

$id = $_SESSION['user_id'];
$res = mysqli_query($conn,"SELECT * FROM users WHERE id='$id' LIMIT 1");
$u = mysqli_fetch_assoc($res);

$page_title="Jobseeker Profile";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container card">
  <h2>My Profile</h2>
  <p><b>Name:</b> <?php echo e($u['name']); ?></p>
  <p><b>Email:</b> <?php echo e($u['email']); ?></p>
  <p><b>Role:</b> <?php echo e($u['role']); ?></p>
</main>
<?php include("../includes/footer.php"); ?>