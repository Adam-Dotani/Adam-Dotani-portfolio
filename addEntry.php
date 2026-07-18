<?php
session_start();
/**
 * Blog entry form (only available when a user is logged in).
 * If no session exists, redirect to login page.
 */
if (empty($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$user_email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Entry — Adam Dotani</title>
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
          <li><a href="login.php">Login</a></li>
          <li><a href="addEntry.php">Add Entry</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <article>
      <section class="section">
        <div class="container">
          <h1>Add blog entry</h1>

          <!-- Session confirmation -->
          <p class="welcome-line">
            Welcome, <?php echo htmlspecialchars($user_email); ?> —
            <a href="logout.php">Log out</a>
          </p>

          <p>Form for posting a new blog entry.</p>

          <!-- FORM -->
          <div id="entry-form-panel">
            <form id="blog-form" class="form-add-entry" action="addPost.php" method="post" novalidate>

              <label for="entry-title">Title</label>
              <input 
                type="text" 
                id="entry-title" 
                name="title" 
                required
                placeholder="Enter a title"
              >

              <label for="entry-post">Blog post</label>
              <textarea 
                id="entry-post" 
                name="content" 
                rows="8" 
                required
                placeholder="Write your post here"
              ></textarea>

              <div class="form-buttons">
                <button type="submit">Post</button>
                <button type="button" id="clear-button">Clear</button>
                <button type="button" id="preview-button">Preview</button>
              </div>

            </form>
          </div>

          <!-- PREVIEW PANEL -->
          <div id="entry-preview-panel" class="entry-preview-panel" hidden>
            <h2 class="section-title">Preview</h2>

            <p class="preview-label">Title</p>
            <p id="preview-title-text" class="preview-title-text"></p>

            <p class="preview-label">Content</p>
            <div id="preview-content-text" class="preview-content-text"></div>

            <div class="form-buttons preview-actions">
              <button type="button" id="preview-confirm">Confirm</button>
              <button type="button" id="preview-edit">Edit</button>
            </div>
          </div>

          <p class="after-form-link">
            <a href="viewBlog.php">View blog</a>
          </p>

        </div>
      </section>
    </article>
  </main>

  <footer>
    <div class="container">
      <p class="footer-text">
        © Adam Dotani. <a href="viewBlog.php">Blog</a>
      </p>
    </div>
  </footer>

  <!-- External JS (required for marks) -->
  <script src="addEntry.js"></script>
</body>
</html>