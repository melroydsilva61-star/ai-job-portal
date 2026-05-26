<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('jobseeker');

$jobseeker_id = $_SESSION['user_id'];

$q = "SELECT a.*, j.title, j.location, j.salary
      FROM applications a
      JOIN jobs j ON a.job_id=j.id
      WHERE a.jobseeker_id='$jobseeker_id'
      ORDER BY a.id DESC";

$res = mysqli_query($conn,$q);

$page_title="My Applications";
include("../includes/header.php");
include("../includes/navbar.php");
?>

<main class="container card">
  <h2>My Applications</h2>

  <?php if(mysqli_num_rows($res)==0): ?>
      <p class="muted">You have not applied to any jobs yet.</p>
  <?php else: ?>

  <table class="table">
    <tr>
      <th>ID</th>
      <th>Job</th>
      <th>Location</th>
      <th>Salary</th>
      <th>Status</th>
      <th>Date</th>
    </tr>

    <?php while($r=mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?php echo e($r['id']); ?></td>
        <td><?php echo e($r['title']); ?></td>
        <td><?php echo e($r['location']); ?></td>
        <td><?php echo e($r['salary']); ?></td>

        <!-- STATUS BADGE -->
        <td>
          <?php if($r['status']=="Pending"): ?>
            <span class="status pending">Pending</span>
          <?php elseif($r['status']=="Accepted"): ?>
            <span class="status accepted">Accepted ✅</span>
          <?php elseif($r['status']=="Rejected"): ?>
            <span class="status rejected">Rejected ❌</span>
          <?php else: ?>
            <span class="muted"><?php echo e($r['status']); ?></span>
          <?php endif; ?>
        </td>

        <td><?php echo e($r['created_at']); ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <?php endif; ?>

</main>

<?php include("../includes/footer.php"); ?>