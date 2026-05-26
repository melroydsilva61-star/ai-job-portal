<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('admin');

/* Stats */
$total_users = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM users"))['total'];
$total_jobs = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM jobs"))['total'];
$total_apps = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM applications"))['total'];

$page_title="Admin Dashboard";
include("../includes/header.php");
include("../includes/navbar.php");
?>

<main class="container admin-dashboard">

  <div class="admin-header">
      <h2>Welcome Admin</h2>
      <p>System overview and quick management panel</p>
  </div>

  <!-- Stats Section -->
  <div class="admin-stats">
      <div class="stat-box">
          <h3><?php echo $total_users; ?></h3>
          <p>Total Users</p>
      </div>

      <div class="stat-box">
          <h3><?php echo $total_jobs; ?></h3>
          <p>Total Jobs</p>
      </div>

      <div class="stat-box">
          <h3><?php echo $total_apps; ?></h3>
          <p>Total Applications</p>
      </div>
  </div>

  <!-- Quick Actions -->
  <div class="admin-actions">
      <a href="manage_users.php" class="admin-card">
          <h4>Manage Users</h4>
          <span>View & control all users</span>
      </a>

      <a href="manage_jobs.php" class="admin-card">
          <h4>Manage Jobs</h4>
          <span>Monitor job postings</span>
      </a>

      <a href="manage_categories.php" class="admin-card">
          <h4>Manage Categories</h4>
          <span>Edit job categories</span>
      </a>

      <a href="settings.php" class="admin-card">
          <h4>System Settings</h4>
          <span>Update portal settings</span>
      </a>
  </div>

</main>

<?php include("../includes/footer.php"); ?>