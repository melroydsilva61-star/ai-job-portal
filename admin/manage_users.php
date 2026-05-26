<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('admin');

$current_admin = $_SESSION['user_id'];

/* DELETE USER */
if(isset($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];

    if($delete_id != $current_admin){ // prevent self delete
        mysqli_query($conn,"DELETE FROM users WHERE id='$delete_id'");
    }

    header("Location: manage_users.php");
    exit;
}

/* CHANGE ROLE */
if(isset($_GET['make_admin'])){
    $id = (int)$_GET['make_admin'];
    mysqli_query($conn,"UPDATE users SET role='admin' WHERE id='$id'");
    header("Location: manage_users.php");
    exit;
}

if(isset($_GET['make_employer'])){
    $id = (int)$_GET['make_employer'];
    mysqli_query($conn,"UPDATE users SET role='employer' WHERE id='$id'");
    header("Location: manage_users.php");
    exit;
}

if(isset($_GET['make_jobseeker'])){
    $id = (int)$_GET['make_jobseeker'];
    mysqli_query($conn,"UPDATE users SET role='jobseeker' WHERE id='$id'");
    header("Location: manage_users.php");
    exit;
}

/* FETCH USERS */
$res = mysqli_query($conn,"SELECT id,name,email,role,created_at FROM users ORDER BY id DESC");

$page_title="Manage Users";
include("../includes/header.php");
include("../includes/navbar.php");
?>

<main class="container card">
  <h2>Manage Users</h2>

  <table class="table">
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Created</th>
      <th>Actions</th>
    </tr>

    <?php while($r=mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?php echo e($r['id']); ?></td>
        <td><?php echo e($r['name']); ?></td>
        <td><?php echo e($r['email']); ?></td>

        <td>
          <?php if($r['role']=="admin"): ?>
            <span class="status accepted">Admin</span>
          <?php elseif($r['role']=="employer"): ?>
            <span class="status pending">Employer</span>
          <?php else: ?>
            <span class="status rejected">Jobseeker</span>
          <?php endif; ?>
        </td>

        <td><?php echo e($r['created_at']); ?></td>

        <td>
          <?php if($r['id'] != $current_admin): ?>

            <!-- Role Buttons -->
            <a class="btn small" 
               href="?make_admin=<?php echo $r['id']; ?>">
               Make Admin
            </a>

            <a class="btn ghost small" 
               href="?make_employer=<?php echo $r['id']; ?>">
               Employer
            </a>

            <a class="btn ghost small" 
               href="?make_jobseeker=<?php echo $r['id']; ?>">
               Jobseeker
            </a>

            <!-- Delete -->
            <a class="btn danger small"
               onclick="return confirm('Are you sure you want to delete this user?')"
               href="?delete=<?php echo $r['id']; ?>">
               Delete
            </a>

          <?php else: ?>
            <span class="muted">You</span>
          <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>

  </table>
</main>

<?php include("../includes/footer.php"); ?>