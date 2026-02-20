<?php
session_start();
include("../includes/auth.php");
require_role('employer');

$page_title="Employer Dashboard";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container">
  <h2>Employer Dashboard</h2>
  <div class="grid">
    <a class="card link" href="post_job.php">Post New Job</a>
    <a class="card link" href="manage_jobs.php">Manage My Jobs</a>
    <a class="card link" href="view_applications.php">View Applications</a>
    <a class="card link" href="profile.php">My Profile</a>
  </div>
</main>
<?php include("../includes/footer.php"); ?>