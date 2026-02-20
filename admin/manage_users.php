<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('admin');

$res = mysqli_query($conn,"SELECT id,name,email,role,created_at FROM users ORDER BY id DESC");

$page_title="Manage Users";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container card">
  <h2>All Users</h2>
  <table class="table">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Created</th></tr>
    <?php while($r=mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?php echo e($r['id']); ?></td>
        <td><?php echo e($r['name']); ?></td>
        <td><?php echo e($r['email']); ?></td>
        <td><?php echo e($r['role']); ?></td>
        <td><?php echo e($r['created_at']); ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
</main>
<?php include("../includes/footer.php"); ?>