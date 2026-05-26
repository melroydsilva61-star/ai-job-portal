<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('employer');

$employer_id = $_SESSION['user_id'];

/* HANDLE ACCEPT / REJECT */
if(isset($_GET['action']) && isset($_GET['app_id'])){

    $app_id = (int)$_GET['app_id'];
    $action = $_GET['action'];

    if($action == "accept"){
        mysqli_query($conn,"UPDATE applications SET status='Accepted' WHERE id='$app_id'");
    }

    if($action == "reject"){
        mysqli_query($conn,"UPDATE applications SET status='Rejected' WHERE id='$app_id'");
    }

    header("Location: applications.php");
    exit;
}

/* FETCH APPLICATIONS */
$q = "SELECT a.*, j.title, u.name AS jobseeker_name, u.email AS jobseeker_email
      FROM applications a
      JOIN jobs j ON a.job_id=j.id
      JOIN users u ON a.jobseeker_id=u.id
      WHERE j.employer_id='$employer_id'
      ORDER BY a.id DESC";

$res = mysqli_query($conn,$q);

$page_title="Applications";
include("../includes/header.php");
include("../includes/navbar.php");
?>

<main class="container card">
  <h2>Applications Received</h2>

  <table class="table">
    <tr>
      <th>ID</th>
      <th>Job</th>
      <th>Applicant</th>
      <th>Email</th>
      <th>Resume</th>
      <th>Status</th>
      <th>Action</th>
      <th>Date</th>
    </tr>

    <?php while($r=mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?php echo e($r['id']); ?></td>
        <td><?php echo e($r['title']); ?></td>
        <td><?php echo e($r['jobseeker_name']); ?></td>
        <td><?php echo e($r['jobseeker_email']); ?></td>

        <td>
          <?php if($r['resume']): ?>
            <a class="btn small" 
               href="/ai_job_portal/uploads/resumes/<?php echo e($r['resume']); ?>" 
               target="_blank">View</a>
          <?php else: ?>
            -
          <?php endif; ?>
        </td>

        <!-- STATUS -->
        <td>
          <?php if($r['status']=="Pending"): ?>
            <span class="status pending">Pending</span>
          <?php elseif($r['status']=="Accepted"): ?>
            <span class="status accepted">Accepted</span>
          <?php else: ?>
            <span class="status rejected">Rejected</span>
          <?php endif; ?>
        </td>

        <!-- ACTION BUTTONS -->
        <td>
          <?php if($r['status']=="Pending"): ?>
            <a class="btn small"
               onclick="return confirm('Accept this candidate?')"
               href="?action=accept&app_id=<?php echo $r['id']; ?>">
               Accept
            </a>

            <a class="btn danger small"
               onclick="return confirm('Reject this candidate?')"
               href="?action=reject&app_id=<?php echo $r['id']; ?>">
               Reject
            </a>
          <?php else: ?>
            -
          <?php endif; ?>
        </td>

        <td><?php echo e($r['created_at']); ?></td>
      </tr>
    <?php endwhile; ?>

  </table>
</main>

<?php include("../includes/footer.php"); ?>