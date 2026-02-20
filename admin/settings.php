<?php
session_start();
include("../includes/auth.php");
require_role('admin');

$page_title="Settings";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container card">
  <h2>Settings</h2>
  <p>Yahan future me password change, site settings add kar sakte ho.</p>
</main>
<?php include("../includes/footer.php"); ?>