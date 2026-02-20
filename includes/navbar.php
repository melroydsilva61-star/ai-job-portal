<?php
$role = $_SESSION['role'] ?? null;
$current = basename($_SERVER['PHP_SELF']);
?>

<header class="topbar">
  <div class="brand">
      <a href="/ai_job_portal/index.php">AI Job Portal</a>
  </div>

  <nav class="navlinks">

    <a class="<?= ($current=='index.php') ? 'active' : '' ?>" href="/ai_job_portal/index.php">Home</a>
    <a class="<?= ($current=='about.php') ? 'active' : '' ?>" href="/ai_job_portal/about.php">About</a>
    <a class="<?= ($current=='contact.php') ? 'active' : '' ?>" href="/ai_job_portal/contact.php">Contact</a>

    <?php if(!$role): ?>
      <a class="btn small" href="/ai_job_portal/login.php">Login</a>
      <a class="btn ghost small" href="/ai_job_portal/register.php">Register</a>
    <?php else: ?>

      <?php if($role==='admin'): ?>
        <a class="btn small" href="/ai_job_portal/admin/dashboard.php">Dashboard</a>
      <?php elseif($role==='employer'): ?>
        <a class="btn small" href="/ai_job_portal/employer/dashboard.php">Dashboard</a>
      <?php else: ?>
        <a class="btn small" href="/ai_job_portal/jobseeker/dashboard.php">Dashboard</a>
      <?php endif; ?>

      <a class="btn danger small" href="/ai_job_portal/logout.php">Logout</a>

    <?php endif; ?>

  </nav>
</header>