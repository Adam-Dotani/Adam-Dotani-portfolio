<?php
session_start();

$show_error = isset($_GET['error']) && $_GET['error'] === '1';
$is_logged_in = !empty($_SESSION['email']);
$session_email = $is_logged_in ? $_SESSION['email'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Adam Dotani</title>
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
      <section class="section">
        <div class="container">
          <h1>Login</h1>

          <?php if ($is_logged_in) : ?>
            <p class="welcome-line">
              Welcome, <?php echo htmlspecialchars($session_email); ?>
            </p>
            <p>
              You are already logged in.
              <a href="addEntry.php">Add a blog post</a>
              or <a href="logout.php">log out</a>.
            </p>
          <?php else : ?>
            <p>Log in to add a new blog post.</p>

            <?php if ($show_error) : ?>
              <p class="form-error">That email or password was not found. Please try again.</p>
            <?php endif; ?>

            <form class="form-login" action="loginProcess.php" method="post">
              <label for="login-email">Email</label>
              <input
                type="email"
                id="login-email"
                name="email"
                required
                autocomplete="username"
                placeholder="Enter your email"
              >

              <label for="login-password">Password</label>
              <input
                type="password"
                id="login-password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
              >

              <button type="submit">Submit</button>
            </form>
          <?php endif; ?>
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