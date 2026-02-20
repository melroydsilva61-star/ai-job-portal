<?php
$page_title="Home - AI Job Portal";
include("includes/header.php");
include("includes/navbar.php");
?>

<main>

<!-- HERO SECTION -->
<section class="hero-advanced">
    <div class="hero-overlay"></div>

    <div class="hero-content container">
        <h1>Hire Smarter. Work Better.</h1>
        <p>
            AI-powered job portal designed to connect top talent with leading companies.
            Fast hiring. Secure applications. Modern experience.
        </p>

        <div class="hero-buttons">
            <a href="register.php" class="btn">Get Started</a>
            <a href="login.php" class="btn ghost">Login</a>
        </div>
    </div>
</section>


<!-- FEATURES -->
<section class="features-section container">
    <div class="feature-box">
        <h3>⚡ Fast Recruitment</h3>
        <p>Post jobs and hire candidates in minutes with a streamlined dashboard.</p>
    </div>

    <div class="feature-box">
        <h3>🔐 Secure System</h3>
        <p>Advanced authentication and protected resume uploads.</p>
    </div>

    <div class="feature-box">
        <h3>📊 Smart Management</h3>
        <p>Track applications, manage jobs and monitor activity easily.</p>
    </div>
</section>


<!-- CTA SECTION -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Start Your Journey?</h2>
        <p>Join thousands of professionals using our AI Job Portal.</p>
        <a href="register.php" class="btn">Create Free Account</a>
    </div>
</section>

</main>

<?php include("includes/footer.php"); ?>