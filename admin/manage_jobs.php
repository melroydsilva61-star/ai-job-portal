<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('admin');

$q = "SELECT j.*, u.name AS employer_name, c.name AS category_name
      FROM jobs j
      JOIN users u ON j.employer_id=u.id
      LEFT JOIN categories c ON j.category_id=c.id
      ORDER BY j.id DESC";
$res = mysqli_query($conn,$q);

$page_title="Manage Jobs";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container card">
  <h2>All Jobs</h2>
  <table class="table">
    <tr><th>ID</th><th>Employer</th><th>Category</th><th>Title</th><th>Location</th><th>Salary</th><th>Date</th></tr>
    <?php while($r=mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?php echo e($r['id']); ?></td>
        <td><?php echo e($r['employer_name']); ?></td>
        <td><?php echo e($r['category_name']); ?></td>
        <td><?php echo e($r['title']); ?></td>
        <td><?php echo e($r['location']); ?></td>
        <td><?php echo e($r['salary']); ?></td>
        <td><?php echo e($r['created_at']); ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</main>
<?php include("../includes/footer.php"); ?>