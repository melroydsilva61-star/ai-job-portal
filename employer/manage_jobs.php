<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('employer');

$employer_id = $_SESSION['user_id'];

if(isset($_GET['delete'])){
  $id = (int)$_GET['delete'];
  mysqli_query($conn,"DELETE FROM jobs WHERE id='$id' AND employer_id='$employer_id'");
  header("Location: manage_jobs.php"); exit;
}

$res = mysqli_query($conn,"SELECT j.*, c.name AS category_name
                           FROM jobs j
                           LEFT JOIN categories c ON j.category_id=c.id
                           WHERE j.employer_id='$employer_id'
                           ORDER BY j.id DESC");

$page_title="My Jobs";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container card">
  <h2>My Posted Jobs</h2>
  <table class="table">
    <tr><th>ID</th><th>Category</th><th>Title</th><th>Location</th><th>Salary</th><th>Date</th><th>Action</th></tr>
    <?php while($r=mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?php echo e($r['id']); ?></td>
        <td><?php echo e($r['category_name']); ?></td>
        <td><?php echo e($r['title']); ?></td>
        <td><?php echo e($r['location']); ?></td>
        <td><?php echo e($r['salary']); ?></td>
        <td><?php echo e($r['created_at']); ?></td>
        <td><a class="btn danger small" href="?delete=<?php echo e($r['id']); ?>" onclick="return confirm('Delete this job?')">Delete</a></td>
      </tr>
    <?php endwhile; ?>
  </table>
</main>
<?php include("../includes/footer.php"); ?>