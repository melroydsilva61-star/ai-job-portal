<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('jobseeker');

$job_id = (int)($_GET['job_id'] ?? 0);
$jobseeker_id = $_SESSION['user_id'];
$msg=""; $err="";

$check = mysqli_query($conn,"SELECT id FROM applications WHERE job_id='$job_id' AND jobseeker_id='$jobseeker_id' LIMIT 1");
if($check && mysqli_num_rows($check)>0){
  $err="You already applied for this job.";
}

if(isset($_POST['apply']) && !$err){
  $resumeName = "";

  if(isset($_FILES['resume']) && $_FILES['resume']['error']===0){
    $ext = strtolower(pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION));
    if(!in_array($ext, ['pdf','doc','docx'])){
      $err="Only PDF/DOC/DOCX allowed.";
    } else {
      $resumeName = "resume_".$jobseeker_id."_".$job_id."_".time().".".$ext;
      move_uploaded_file($_FILES['resume']['tmp_name'], "../uploads/resumes/".$resumeName);
    }
  }

  if(!$err){
    mysqli_query($conn,"INSERT INTO applications(job_id,jobseeker_id,resume) VALUES('$job_id','$jobseeker_id','$resumeName')");
    $msg="✅ Applied Successfully!";
  }
}

$page_title="Apply Job";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container card">
  <h2>Apply Job</h2>
  <?php if($msg) echo "<p class='success'>$msg</p>"; ?>
  <?php if($err) echo "<p class='error'>$err</p>"; ?>

  <?php if(!$msg && !$err): ?>
    <form method="POST" enctype="multipart/form-data">
      <label class="muted">Upload Resume (PDF/DOC/DOCX)</label>
      <input type="file" name="resume" required>
      <button class="btn" name="apply">Submit Application</button>
    </form>
  <?php endif; ?>

  <a class="btn ghost" href="search_jobs.php">Back</a>
</main>
<?php include("../includes/footer.php"); ?>