<?php
session_start();

/**
 * Blog listing page.
 * Posts are sorted using PHP bubble sort, not SQL ORDER BY.
 */

require_once __DIR__ . '/db_connect.php';

// Fetch all posts without SQL sorting
$sql = 'SELECT id, title, content, created_at FROM posts';
$result = $db->query($sql);

$posts = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

/**
 * Bubble sort: newest posts first.
 *
 * Each post is compared with the next post.
 * If the left post is older than the right post, they swap places.
 * This moves newer posts towards the start of the array.
 */
$post_count = count($posts);

for ($pass = 0; $pass < $post_count - 1; $pass++) {
    $swapped = false;

    for ($i = 0; $i < $post_count - 1 - $pass; $i++) {
        $left_date = $posts[$i]['created_at'];
        $right_date = $posts[$i + 1]['created_at'];

        if ($left_date < $right_date) {
            $temp = $posts[$i];
            $posts[$i] = $posts[$i + 1];
            $posts[$i + 1] = $temp;
            $swapped = true;
        }
    }

    if (!$swapped) {
        break;
    }
}

$is_logged_in = !empty($_SESSION['email']);
$session_email = $is_logged_in ? $_SESSION['email'] : '';
$add_post_href = $is_logged_in ? 'addEntry.php' : 'login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog — Adam Dotani</title>
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
      <section class="section blog-page">
        <div class="container">
          <h1>Blog</h1>

          <?php if ($is_logged_in) : ?>
            <p class="welcome-line session-welcome">
              Welcome, <?php echo htmlspecialchars($session_email); ?> —
              <a href="logout.php">Log out</a>
            </p>
          <?php endif; ?>

          <p class="blog-actions-top">
            <a href="<?php echo htmlspecialchars($add_post_href); ?>">Add Post</a>
          </p>

          <?php if (count($posts) === 0) : ?>
            <p>No posts yet.</p>
          <?php else : ?>
            <?php for ($i = 0; $i < count($posts); $i++) : ?>
              <?php
              $post = $posts[$i];
              $timestamp = strtotime($post['created_at']);
              $formatted_date = date('j F Y, H:i', $timestamp);
              ?>

              <article class="blog-post">
                <p class="blog-post-date">
                  <?php echo htmlspecialchars($formatted_date); ?>
                </p>

                <h2 class="blog-post-title">
                  <?php echo htmlspecialchars($post['title']); ?>
                </h2>

                <div class="blog-post-content">
                  <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                </div>
              </article>

              <?php if ($i < count($posts) - 1) : ?>
                <hr class="blog-divider">
              <?php endif; ?>
            <?php endfor; ?>
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