<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($page_title) ? $page_title : "AI Job Portal"; ?></title>

  <!-- CSS FILES -->
  <link rel="stylesheet" href="/ai_job_portal/assets/css/style.css">
  <link rel="stylesheet" href="/ai_job_portal/assets/css/dashboard.css">
  <link rel="stylesheet" href="/ai_job_portal/assets/css/responsive.css">
</head>
<body>