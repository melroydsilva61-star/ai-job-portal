<?php
session_start();
include("../includes/auth.php");
require_role('jobseeker');

$page_title="Jobseeker Dashboard";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container">
  <h2>Jobseeker Dashboard</h2>
  <div class="grid">
    <a class="card link" href="search_jobs.php">Search Jobs</a>
    <a class="card link" href="my_applications.php">My Applications</a>
    <a class="card link" href="profile.php">My Profile</a>
  </div>
</main>
<?php include("../includes/footer.php"); ?>