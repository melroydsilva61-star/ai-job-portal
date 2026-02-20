<?php
session_start();
include("../includes/auth.php");
require_role('admin');

$page_title="Admin Dashboard";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container">
  <h2>Admin Dashboard</h2>
  <div class="grid">
    <a class="card link" href="manage_users.php">Manage Users</a>
    <a class="card link" href="manage_jobs.php">Manage Jobs</a>
    <a class="card link" href="manage_categories.php">Manage Categories</a>
    <a class="card link" href="settings.php">Settings</a>
  </div>
</main>
<?php include("../includes/footer.php"); ?>