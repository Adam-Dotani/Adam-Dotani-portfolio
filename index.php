<?php
session_start();
// Session lets us show "Welcome, [email]" when the user is already logged in.

$is_logged_in = !empty($_SESSION['email']);
$session_email = $is_logged_in ? $_SESSION['email'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adam Dotani — Portfolio</title>
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <div class="header-inner">
      <a href="index.php" class="logo">Adam Dotani<span class="logo-dot"></span></a>
      <nav>
        <ul class="nav-list">
          <li><a href="index.php">Home</a></li>
          <li><a href="skills.html">Skills</a></li>
          <li><a href="education.html">Education</a></li>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="viewBlog.php">Blog</a></li>
          <?php if ($is_logged_in) : ?>
            <li><a href="addEntry.php">Add Entry</a></li>
            <li><a href="logout.php">Logout</a></li>
          <?php else : ?>
            <li><a href="login.php">Login</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <article>
      <?php if ($is_logged_in) : ?>
        <div class="container session-welcome-wrap">
          <p class="welcome-line session-welcome">
            Welcome, <?php echo htmlspecialchars($session_email); ?> —
            <a href="logout.php">Log out</a>
          </p>
        </div>
      <?php endif; ?>

      <section class="hero">
        <div class="hero-inner">
          <figure class="hero-photo-wrap">
            <img src="images/portfolio-profile-photo.jpeg" alt="Adam Dotani" class="hero-photo" width="200" height="200">
          </figure>

          <p class="hero-greeting">Hi! I'm Adam Dotani 👋</p>
          <h1>First-year Computer Science student at Queen Mary University of London.</h1>
          <p class="hero-desc">Welcome to my portfolio. I'm an undergraduate building projects across web, AI, and games.</p>

          <div class="hero-actions">
            <a href="portfolio.html" class="btn btn-primary">View projects</a>
            <a href="education.html" class="btn">Education</a>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <h2 class="section-title">Short biography</h2>
          <p>
            I'm a first-year undergraduate studying
            <span class="highlight">Computer Science</span>
            at Queen Mary University of London. I enjoy learning by building.
            I speak <span class="highlight">English</span>,
            <span class="highlight">German</span>, and
            <span class="highlight">Pashto</span> fluently.
          </p>
        </div>
      </section>
    </article>
  </main>

  <footer>
    <div class="container">
      <p class="footer-text">© Adam Dotani. <a href="viewBlog.php">Blog</a></p>
    </div>
  </footer>
</body>
</html>