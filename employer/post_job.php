<?php
session_start();
include("../includes/db.php");
include("../includes/auth.php");
require_role('employer');

$msg="";

$cats = mysqli_query($conn,"SELECT * FROM categories ORDER BY name ASC");

if(isset($_POST['post'])){
  $title = mysqli_real_escape_string($conn,$_POST['title']);
  $description = mysqli_real_escape_string($conn,$_POST['description']);
  $location = mysqli_real_escape_string($conn,$_POST['location']);
  $salary = mysqli_real_escape_string($conn,$_POST['salary']);
  $category_id = (int)($_POST['category_id'] ?? 0);
  if($category_id<=0) $category_id = "NULL";

  $employer_id = $_SESSION['user_id'];
  mysqli_query($conn,"INSERT INTO jobs(employer_id,category_id,title,description,location,salary)
              VALUES('$employer_id',$category_id,'$title','$description','$location','$salary')");
  $msg="✅ Job Posted Successfully!";
}

$page_title="Post Job";
include("../includes/header.php");
include("../includes/navbar.php");
?>
<main class="container card">
  <h2>Post New Job</h2>
  <?php if($msg) echo "<p class='success'>$msg</p>"; ?>

  <form method="POST">
    <input type="text" name="title" placeholder="Job Title" required>
    <textarea name="description" placeholder="Job Description" required></textarea>
    <input type="text" name="location" placeholder="Location" required>
    <input type="text" name="salary" placeholder="Salary (e.g. 20k-30k)" required>

    <select name="category_id">
      <option value="0">Select Category</option>
      <?php while($c=mysqli_fetch_assoc($cats)): ?>
        <option value="<?php echo e($c['id']); ?>"><?php echo e($c['name']); ?></option>
      <?php endwhile; ?>
    </select>

    <button class="btn" name="post">Post Job</button>
  </form>
</main>
<?php include("../includes/footer.php"); ?>