<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('admin');

$msg=""; $err="";

if(isset($_POST['add'])){
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  if($name!=""){
    $ok = mysqli_query($conn,"INSERT IGNORE INTO categories(name) VALUES('$name')");
    $msg = $ok ? "✅ Category added (or already exists)." : "❌ Error!";
  }
}

$cats = mysqli_query($conn,"SELECT * FROM categories ORDER BY name ASC");

$page_title="Manage Categories";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container">
  <div class="card">
    <h2>Categories</h2>
    <?php if($msg) echo "<p class='success'>$msg</p>"; ?>
    <form method="POST" class="row">
      <input type="text" name="name" placeholder="New Category (e.g. Design)" required>
      <button class="btn" name="add">Add</button>
    </form>

    <table class="table">
      <tr><th>ID</th><th>Name</th></tr>
      <?php while($c=mysqli_fetch_assoc($cats)): ?>
        <tr><td><?php echo e($c['id']); ?></td><td><?php echo e($c['name']); ?></td></tr>
      <?php endwhile; ?>
    </table>
  </div>
</main>
<?php include("../includes/footer.php"); ?>