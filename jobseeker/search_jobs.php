<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('jobseeker');

$kw = mysqli_real_escape_string($conn, $_GET['q'] ?? "");

$q = "SELECT j.*, u.name AS employer_name, c.name AS category_name
      FROM jobs j
      JOIN users u ON j.employer_id=u.id
      LEFT JOIN categories c ON j.category_id=c.id";

if($kw!=""){
  $q .= " WHERE j.title LIKE '%$kw%' OR j.location LIKE '%$kw%'";
}
$q .= " ORDER BY j.id DESC";

$res = mysqli_query($conn,$q);

$page_title="Search Jobs";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container">
  <div class="card">
    <h2>Search Jobs</h2>
    <form method="GET" class="row">
      <input type="text" name="q" placeholder="Search by title/location" value="<?php echo e($kw); ?>">
      <button class="btn">Search</button>
    </form>
  </div>

  <div class="list">
    <?php while($r=mysqli_fetch_assoc($res)): ?>
      <div class="card">
        <h3><?php echo e($r['title']); ?></h3>
        <p class="muted"><?php echo e($r['category_name']); ?> • <?php echo e($r['location']); ?> • <?php echo e($r['salary']); ?></p>
        <p><?php echo nl2br(e($r['description'])); ?></p>
        <a class="btn" href="apply_job.php?job_id=<?php echo e($r['id']); ?>">Apply</a>
      </div>
    <?php endwhile; ?>
  </div>
</main>
<?php include("../includes/footer.php"); ?>